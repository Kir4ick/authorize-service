<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User extends \App\Model\User implements UserInterface, PasswordAuthenticatedUserInterface
{

    private ?Session $session;

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): void
    {
        $this->session = $session;
    }

    public function setUUID(string $uuid): self
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
