<?php

namespace App\Service\Session;

use App\Service\Session\Data\CreateSessionInput;
use App\Service\Session\Data\CreateSessionOutput;
use App\Service\Session\Data\GetSessionInput;
use App\Service\Session\Data\GetSessionOutput;

interface SessionServiceInterface
{
    public function createSession(CreateSessionInput $input): CreateSessionOutput;

    public function getSession(GetSessionInput $input): GetSessionOutput;
}
