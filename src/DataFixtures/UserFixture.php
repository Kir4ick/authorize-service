<?php

namespace App\DataFixtures;

use App\Model\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    )
    {}

    public function load(ObjectManager $manager): void
    {
        $password = $this->passwordHasher
            ->hashPassword(new \App\Entity\User(), 'GhI89ZZ0-');

        $user = (new User())
            ->setLogin('kir4ick')
            ->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
