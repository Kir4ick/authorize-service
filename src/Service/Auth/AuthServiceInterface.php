<?php

namespace App\Service\Auth;

use App\Service\Auth\Data\LoginInput;
use App\Service\Auth\Data\LoginOutput;

interface AuthServiceInterface
{
    public function login(LoginInput $input): LoginOutput;
}
