<?php

namespace App\Service\Session\Data;

class GetSessionInput
{
    private string $userUUID;

    /**
     * @param string $userUUID
     */
    public function __construct(string $userUUID)
    {
        $this->userUUID = $userUUID;
    }

    public function getUserUUID(): string
    {
        return $this->userUUID;
    }
}
