<?php

namespace App\Entity;

class Session extends \App\Model\Session
{
    public function setUUID(string $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }
}
