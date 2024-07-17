<?php

namespace App\Service\Session\Data;

use App\Entity\Session;

class CreateSessionOutput
{
    private ?Session $session;

    private ?string $errorMessage;

    /**
     * @param Session|null $session
     * @param string|null $errorMessage
     */
    public function __construct(?Session $session, ?string $errorMessage = null)
    {
        $this->session = $session;
        $this->errorMessage = $errorMessage;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

}
