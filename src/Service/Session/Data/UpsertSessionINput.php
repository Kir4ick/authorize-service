<?php

namespace App\Service\Session\Data;

class CreateSessionInput
{
    private string $fingerprint;

    private string $userUUID;

    /**
     * @param string $fingerprint
     * @param string $userUUID
     */
    public function __construct(string $fingerprint, string $userUUID)
    {
        $this->fingerprint = $fingerprint;
        $this->userUUID = $userUUID;
    }

    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

    public function getUserUUID(): string
    {
        return $this->userUUID;
    }

}
