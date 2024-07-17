<?php

namespace App\Repository\Session;

use App\Model\Session;
use Doctrine\Persistence\ObjectRepository;

interface SessionRepositoryInterface extends ObjectRepository
{
    public function create(): Session;
}
