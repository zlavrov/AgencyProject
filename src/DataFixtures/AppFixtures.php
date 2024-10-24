<?php

declare(strict_types=1);

namespace App\DataFixtures;


use App\DataFixtures\UsersData;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private UserRepository $userRepository,
    ) {

    }

    public function load(ObjectManager $manager): void
    {
        foreach(UsersData::DATA as $row) {
            $user = new User();
            $user->setFirstName($row['firstName']);
            $user->setLastName($row['lastName']);
            $user->setEmail($row['email']);
            $user->setRoles(roles: [$row['roles']]);
            $user->setPassword($this->passwordHasher->hashPassword(user: $user, plainPassword: 'Aa_12345'));

            $manager->persist($user);
        }
        $manager->flush();
    }
}
