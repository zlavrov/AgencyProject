<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Model\UserModel;
use App\Security\Roles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class SecurityService {

    public function __construct(
        private EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly TranslatorInterface $translator
    ) {
    }
    
    public function register(UserModel $userModel): array
    {
        $user = new User();

        $user->setEmail(email: $userModel->email);
        $user->setFirstName(firstName: $userModel->firstName);
        $user->setLastName(lastName: $userModel->lastName);
        $user->setRoles(roles: [Roles::ROLE_USER]);
        $user->setPassword(password: $this->passwordHasher->hashPassword(user: $user, plainPassword: $userModel->password));

        // dd($user);
        $this->entityManager->persist(object: $user);
        $this->entityManager->flush();

        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            // 'avatar' => $user->getAvatar(),
        ];
    }
}


