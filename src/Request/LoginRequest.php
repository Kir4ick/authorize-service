<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginRequest
{

    #[NotBlank]
    #[Length(min: 3, max: 255)]
    private string $login;

    #[NotBlank]
    #[Length(min: 3, max: 255)]
    private string $password;

    #[NotBlank]
    #[Length(min: 3, max: 255)]
    private string $fingerprint;

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

    public function setFingerprint(string $fingerprint): void
    {
        $this->fingerprint = $fingerprint;
    }

}
