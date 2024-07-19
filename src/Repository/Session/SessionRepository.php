<?php

namespace App\Repository\Session;

use App\Model\Session;
use App\Entity\Session as SessionEntity;
use App\Repository\AbstractRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\LockMode;
use Doctrine\Persistence\ManagerRegistry;

class SessionRepository extends AbstractRepository implements SessionRepositoryInterface
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): object|null
    {
        return $this->mapToEntity(parent::findOneBy($criteria, $orderBy));
    }

    /**
     * @param Session|null $map
     * @return SessionEntity|null
     */
    #[\Override] protected function mapToEntity(?object $map): ?SessionEntity
    {
        if ($map === null) {
            return null;
        }

        return (new SessionEntity())
            ->setUUID($map->getUUID())
            ->setUser($map->getUser())
            ->setIp($map->getIp())
            ->setFingerprint($map->getFingerprint())
            ->setIsActive($map->getIsActive())
            ->setIsBlocked($map->getIsBlocked())
            ->setUserAgent($map->getUserAgent());

    }
}
