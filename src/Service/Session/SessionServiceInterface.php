<?php

namespace App\Service\Session;

use App\Service\Session\Data\UpsertSessionInput;
use App\Service\Session\Data\UpsertSessionOutput;
use App\Service\Session\Data\GetSessionInput;
use App\Service\Session\Data\GetSessionOutput;

interface SessionServiceInterface
{
    public function upsertSession(UpsertSessionInput $input): UpsertSessionOutput;

    public function getSession(GetSessionInput $input): GetSessionOutput;
}
