<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginRequest
{

    #[NotBlank]
    #[Length(min: 3, max: 255)]
    private ?string $login;

    #[NotBlank]
    #[Length(min: 3, max: 255)]
    private ?string $password;

    #[NotBlank]
    #[Length(min: 3, max: 255)]
    private ?string $fingerprint;

}
