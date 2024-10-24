<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Manager\UserManager;
use App\Model\UserModel;
use App\Security\Roles;
use Random\RandomException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

readonly class SecurityService {

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly TranslatorInterface $translator,
        private UserManager $userManager
    ) {
    }
    
    public function register(UserModel $userModel): User
    {
        $user = $this->createUser($userModel);

        return $user;
    }

    /**
     * @throws RandomException
     */
    private function createUser(UserModel $userModel): User
    {
        $user = (new User())
            ->setEmail(strtolower($userModel->email))
            ->setFirstName($userModel->firstName)
            ->setLastName($userModel->lastName)
            ->setDateOfBirth($userModel->dateOfBirth)
            ->setSex($userModel->sex);

        if(isset($userModel->professional)) {
            $user->setProfessional($userModel->professional);
            if($userModel->plainPassword) {
                $user->setRoles([Roles::ROLE_HEAD]);
            }
        }

        if(isset($userModel->company)) {
            $user->setCompany($userModel->company);
        }

        $user->setPassword($this->passwordHasher->hashPassword($user, $userModel->password));

        $this->userManager->save($user);

        return $user;
    }
}


