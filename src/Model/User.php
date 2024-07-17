<?php

namespace App\Model;

use App\Repository\User\UserRepository;
use App\Traits\Timestamp;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\HasLifecycleCallbacks]
class User
{

    use Timestamp;

    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    protected ?string $uuid = null;

    #[ORM\Column(length: 255)]
    protected ?string $login = null;

    #[ORM\Column(length: 255)]
    protected ?string $password = null;

    #[ORM\Column(type: 'datetimetz', nullable: true)]
    protected ?DateTimeInterface $deletedAt;

    #[ORM\OneToOne(self::class, inversedBy: 'deleted_by')]
    #[ORM\JoinColumn('deleted_by', referencedColumnName: 'uuid')]
    protected ?User $deletedBy;

    #[ORM\OneToOne(self::class, inversedBy: 'updated_by')]
    #[ORM\JoinColumn('updated_by', referencedColumnName: 'uuid')]
    protected ?User $updatedBy;

    public function getUUID(): ?string
    {
        return $this->uuid;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getDeletedBy(): ?User
    {
        return $this->deletedBy;
    }

    public function setDeletedBy(?User $deletedBy): static
    {
        $this->deletedBy = $deletedBy;

        return $this;
    }

    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?DateTimeInterface $deletedAt): static
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }

    public function setUpdatedBy(?User $updatedBy): static
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }
}
