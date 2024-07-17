<?php

namespace App\Repository\User;

use App\Entity\User as UserEntity;
use App\Model\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): object|null
    {
        $result = parent::findOneBy($criteria, $orderBy);

        return $this->mapModelToEntity($result);
    }

    private function mapModelToEntity(?User $user): ?UserEntity
    {
        if ($user === null) {
            return null;
        }

        $userEntity = new UserEntity();
        return $userEntity
            ->setUUID($user->getUUID())
            ->setLogin($user->getLogin())
            ->setPassword($user->getPassword())
            ->setDeletedAt($user->getDeletedAt())
            ->setDeletedBy($user->getDeletedBy())
            ->setCreatedAt($user->getCreatedAt())
            ->setUpdatedAt($user->getUpdatedAt());
    }

}
