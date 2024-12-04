<?php

namespace App\Service\Session\Data;

use App\Model\User;

class UpsertSessionInput
{

    protected string $fingerprint;

    protected string $userAgent;

    protected bool $isBlocked;

    protected string $ip;

    protected User $user;

    /**
     * @param string $fingerprint
     * @param string $userAgent
     * @param string $ip
     * @param User $user
     */
    public function __construct(
        string $fingerprint,
        string $userAgent,
        string $ip,
        User $user
    ) {
        $this->fingerprint = $fingerprint;
        $this->userAgent = $userAgent;
        $this->ip = $ip;
        $this->user = $user;
    }

    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function isBlocked(): bool
    {
        return $this->isBlocked;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getUser(): User
    {
        return $this->user;
    }

}
