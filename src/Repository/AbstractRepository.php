<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractRepository extends ServiceEntityRepository implements RepositoryInterface
{
    public function saveAndCommit(object $entity): object
    {
        $entityManager = $this->getEntityManager();

        $entityManager->persist($entity);
        $entityManager->flush();

        return $this->mapToEntity($entity);
    }

    #[\Override]
    abstract protected function mapToEntity(?object $map): ?object;
}
