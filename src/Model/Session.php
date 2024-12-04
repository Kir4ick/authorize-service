<?php

namespace App\Model;

use App\Repository\User\UserRepository;
use App\Traits\Timestamp;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Validator\Constraints\Cascade;

#[ORM\Embeddable]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`session`')]
#[ORM\HasLifecycleCallbacks]
class Session
{

    use Timestamp;

    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    protected ?string $uuid = null;

    #[ORM\Column(type: 'text')]
    protected ?string $fingerprint = null;

    #[ORM\Column(type: 'text')]
    protected ?string $userAgent = null;

    #[ORM\Column(type: 'boolean')]
    protected ?bool $isActive = null;

    #[ORM\Column(type: 'boolean')]
    protected ?bool $isBlocked = null;

    #[ORM\Column(type: 'text')]
    protected ?string $ip = null;

    #[ORM\ManyToOne(User::class, cascade: ['persist'])]
    #[ORM\JoinColumn('user_uuid', referencedColumnName: 'uuid')]
    protected ?User $user;

    public function getUUID(): ?string
    {
        return $this->uuid;
    }

    public function getFingerprint(): ?string
    {
        return $this->fingerprint;
    }

    public function setFingerprint(?string $fingerprint): Session
    {
        $this->fingerprint = $fingerprint;
        return $this;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function setUserAgent(?string $userAgent): Session
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): Session
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function getIsBlocked(): ?bool
    {
        return $this->isBlocked;
    }

    public function setIsBlocked(?bool $isBlocked): Session
    {
        $this->isBlocked = $isBlocked;
        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): Session
    {
        $this->ip = $ip;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): Session
    {
        $this->user = $user;
        return $this;
    }

    public function __toString(): string
    {
        return $this->getUUID();
    }
}
