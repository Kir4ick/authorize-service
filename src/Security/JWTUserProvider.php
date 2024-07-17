<?php

namespace App\Security;

use App\Entity\User;
use App\Service\User\Data\GetUserInput;
use App\Service\User\UserServiceInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\PayloadAwareUserProviderInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

class JWTUserProvider implements PayloadAwareUserProviderInterface
{

    public function __construct(
        private readonly UserServiceInterface $userService
    )
    {}

    /**
     * @deprecated
     */
    public function loadUserByUsernameAndPayload(string $username, array $payload): ?UserInterface
    {
        return null;
    }

    public function refreshUser(UserInterface $user): ?UserInterface
    {
        return null;
    }

    public function supportsClass(string $class): bool
    {
        return $class === User::class;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        $user = $this->userService->getUser(new GetUserInput($identifier))->getUser();
        if ($user === null) {
            throw new UserNotFoundException('User not found');
        }

        return $user;
    }

    public function loadUserByIdentifierAndPayload(string $identifier, array $payload): UserInterface
    {

    }

}
