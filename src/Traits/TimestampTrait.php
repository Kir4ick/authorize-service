<?php

namespace App\Traits;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

trait TimestampTrait
{

    #[ORM\Column(type: 'datetimetz')]
    private ?DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetimetz')]
    private ?DateTimeInterface $updatedAt;

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
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
