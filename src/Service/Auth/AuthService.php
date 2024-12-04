<?php

namespace App\Service\Auth;

use App\Adapter\Transaction\TransactionAdapter;
use App\Adapter\Transaction\TransactionAdapterInterface;
use App\Service\Auth\Data\LoginInput;
use App\Service\Auth\Data\LoginOutput;
use App\Service\Session\Data\UpsertSessionInput;
use App\Service\Session\Data\UpsertSessionOutput;
use App\Service\Session\SessionServiceInterface;
use App\Service\User\Data\GetUserInput;
use App\Service\User\Data\GetUserOutput;
use App\Service\User\UserServiceInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthService implements AuthServiceInterface
{

    public function __construct(
        private readonly UserServiceInterface $userService,
        private readonly SessionServiceInterface $sessionService,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly JWTTokenManagerInterface $JWTManager,
        private readonly TransactionAdapterInterface $transactionAdapter
    )
    {}

    public function login(LoginInput $input): LoginOutput
    {
        /** @var GetUserOutput $userResult */
        /** @var UpsertSessionOutput $sessionResult */
        list($userResult, $sessionResult) = $this->transactionAdapter->run(
            function () use ($input) {
                return $this->getUserAndUpsertSession($input);
            }
        );

        $accessToken = $this->JWTManager->createFromPayload($userResult->getUser(), [
            'access' => true,
            'session_uuid' => $sessionResult->getSession()->getUUID(),
            'ip' => $sessionResult->getSession()->getIp(),
            'fingerprint' => $sessionResult->getSession()->getFingerprint()
        ]);

        $refreshToken = $this->JWTManager->createFromPayload($userResult->getUser(), [
            'refresh' => true,
            'session_uuid' => $sessionResult->getSession()->getUUID(),
            'ip' => $sessionResult->getSession()->getIp(),
            'fingerprint' => $sessionResult->getSession()->getFingerprint()
        ]);

        return new LoginOutput($accessToken, $refreshToken);
    }

    private function getUserAndUpsertSession(
        LoginInput $loginInput
    ): array {
        $result = $this->userService->getUser(new GetUserInput(null, $loginInput->getLogin()));
        if ($result->getUser() === null) {
            throw new NotFoundHttpException('User not found');
        }

        if (!$this->passwordHasher->isPasswordValid($result->getUser(), $loginInput->getPassword())) {
            throw new UnauthorizedHttpException('Password not equal');
        }

        $upsertSessionResult = $this->sessionService->upsertSession(
            new UpsertSessionInput(
                $loginInput->getFingerprint(),
                'Agent',
                '',
                $result->getUser()
            )
        );
        if ($upsertSessionResult->isBlocked()) {
            throw new AccessDeniedHttpException('This session is blocked');
        }

        return [$result, $upsertSessionResult];
    }
}
