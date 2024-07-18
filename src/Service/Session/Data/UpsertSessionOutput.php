<?php

namespace App\Service\Session\Data;

use App\Entity\Session;

class UpsertSessionOutput
{
    private ?Session $session;

    private bool $isBlocked;

    public function __construct(?Session $session, bool $isBlocked)
    {
        $this->session = $session;
        $this->isBlocked = $isBlocked;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function isBlocked(): bool
    {
        return $this->isBlocked;
    }

}
