<?php

namespace App\Service\Session;

use App\Service\Session\Data\CreateSessionInput;
use App\Service\Session\Data\CreateSessionOutput;

interface SessionServiceInterface
{
    public function createSession(CreateSessionInput $input): CreateSessionOutput;

}
