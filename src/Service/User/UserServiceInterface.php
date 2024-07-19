<?php

namespace App\Service\User;

use App\Service\User\Data\GetUserInput;
use App\Service\User\Data\GetUserOutput;

interface UserServiceInterface
{
    public function getUser(GetUserInput $input): GetUserOutput;
}
