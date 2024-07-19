<?php

namespace App\Service\User\Data;

use App\Entity\User;

class GetUserOutput
{
    private ?User $user;

    public function __construct(?User $user)
    {
        $this->user = $user;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
}
