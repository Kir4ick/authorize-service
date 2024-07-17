<?php

namespace App\Service\Auth;

use App\Service\Auth\Data\LoginInput;
use App\Service\Auth\Data\LoginOutput;
use App\Service\Session\Data\CreateSessionInput;
use App\Service\Session\SessionServiceInterface;
use App\Service\User\Data\GetUserInput;
use App\Service\User\UserServiceInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthService implements AuthServiceInterface
{

    public function __construct(
        private readonly UserServiceInterface $userService,
        private readonly SessionServiceInterface $sessionService,
        private readonly UserPasswordHasherInterface $passwordHasher
    )
    {}

    public function login(LoginInput $input): LoginOutput
    {
        $result = $this->userService->getUser(new GetUserInput(null, $input->getLogin()));
        if ($result->getUser() === null) {
            throw new NotFoundHttpException('User not found');
        }

        if (!$this->passwordHasher->isPasswordValid($result->getUser(), $input->getPassword())) {
            throw new UnauthorizedHttpException('Password not equal');
        }

        //$createdResult = $this->sessionService->createSession(
        //    new CreateSessionInput($input->getFingerprint(), $result->getUser()->getUUID())
        //);
        //if ($createdResult->getSession() === null) {
        //    throw new \Exception('Error when created session');
        //}

        //$result->getUser()->setSession($createdResult->getSession());

        return new LoginOutput($result->getUser());
    }
}
