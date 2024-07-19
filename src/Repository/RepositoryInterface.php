<?php

namespace App\Repository;

interface RepositoryInterface
{
    public function saveAndCommit(object $entity): object;
}
