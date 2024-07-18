<?php

namespace App\Repository\Session;

use App\Model\Session;
use App\Repository\RepositoryInterface;
use Doctrine\Persistence\ObjectRepository;

interface SessionRepositoryInterface extends ObjectRepository, RepositoryInterface
{

}
