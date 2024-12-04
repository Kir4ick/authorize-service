<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User extends \App\Model\User implements UserInterface, PasswordAuthenticatedUserInterface
{

    public function setUUID(string $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials(): void
    {}

    public function getUserIdentifier(): string
    {
        return $this->getUUID();
    }
}
