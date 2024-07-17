<?php

namespace App\Service\Auth\Data;

class LoginInput
{

    private string $login;

    private string $password;

    private string $fingerprint;

    public function __construct(string $login, string $password, string $fingerprint)
    {
        $this->login = $login;
        $this->password = $password;
        $this->fingerprint = $fingerprint;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

}
