<?php

namespace App\Service\User\Data;

class GetUserInput
{

    private ?string $uuid;

    private ?string $login;

    /**
     * @param string|null $uuid
     * @param string|null $login
     */
    public function __construct(?string $uuid = null, ?string $login = null)
    {
        $this->uuid = $uuid;
        $this->login = $login;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

}
