<?php

namespace App\Repository\User;

use App\Repository\RepositoryInterface;
use Doctrine\Persistence\ObjectRepository;

interface UserRepositoryInterface extends ObjectRepository, RepositoryInterface
{

}
