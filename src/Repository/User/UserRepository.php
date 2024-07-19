<?php

namespace App\Repository\User;

use App\Entity\User as UserEntity;
use App\Model\User;
use App\Repository\AbstractRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): object|null
    {
        $result = parent::findOneBy($criteria, $orderBy);

        return $this->mapToEntity($result);
    }

    /**
     * @param User|null $map
     * @return UserEntity|null
     */
    protected function mapToEntity(?object $map): ?UserEntity
    {
        if ($map === null) {
            return null;
        }

        $userEntity = new UserEntity();
        return $userEntity
            ->setUUID($map->getUUID())
            ->setLogin($map->getLogin())
            ->setPassword($map->getPassword())
            ->setDeletedAt($map->getDeletedAt())
            ->setDeletedBy($map->getDeletedBy())
            ->setCreatedAt($map->getCreatedAt())
            ->setUpdatedAt($map->getUpdatedAt());
    }

}
