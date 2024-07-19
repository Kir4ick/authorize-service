<?php

namespace App\Service\Session\Data;

use App\Entity\Session;

class GetSessionOutput
{
    private ?Session $session;

    public function __construct(?Session $session)
    {
        $this->session = $session;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

}
