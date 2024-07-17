<?php

namespace App\Model;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;

#[ORM\Embeddable]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`session`')]
class Session
{

    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?string $uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $fingerprint = null;

    #[ORM\Column(type: 'datetimetz')]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: 'datetimetz')]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(type: 'datetimetz')]
    private ?\DateTimeInterface $expiredAt = null;

    #[ORM\ManyToOne(User::class, inversedBy: 'user_uuid')]
    #[ORM\JoinColumn('user_uuid', referencedColumnName: 'uuid')]
    private ?User $user;

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function getFingerprint(): ?string
    {
        return $this->fingerprint;
    }

    public function setFingerprint(string $fingerprint): void
    {
        $this->fingerprint = $fingerprint;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getExpiredAt(): ?DateTime
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(?DateTime $expiredAt): void
    {
        $this->expiredAt = $expiredAt;
    }

}
