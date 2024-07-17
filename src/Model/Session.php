<?php

namespace App\Model;

use App\Repository\User\UserRepository;
use App\Traits\Timestamp;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;

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

    #[ORM\ManyToOne(User::class)]
    #[ORM\JoinColumn('user_uuid', referencedColumnName: 'uuid')]
    protected ?User $user;

}
