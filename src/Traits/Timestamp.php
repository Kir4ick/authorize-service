<?php

namespace App\Traits;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait Timestamp
{

    #[ORM\Column(type: 'datetimetz')]
    private ?DateTimeInterface $createdAt = null;

    #[ORM\Column(type: 'datetimetz')]
    private ?DateTimeInterface $updatedAt = null;

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    #[ORM\PreUpdate()]
    #[ORM\PrePersist()]
    public function updatedTimestamps(): void
    {
        $this->setUpdatedAt(new \DateTime('now'));
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

}
