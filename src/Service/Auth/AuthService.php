<?php

namespace App\Service\Auth;

use App\Service\Auth\Data\LoginInput;
use App\Service\Auth\Data\LoginOutput;
use App\Service\Session\SessionService;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private readonly SessionService $sessionService
    )
    {}


    public function login(LoginInput $input): LoginOutput
    {
        return new LoginOutput();
    }
}
