<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use App\Entity\User;
use App\Model\UserModel;
use App\Manager\UserManager;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RequestStack;

final class UniqueValidator extends UniqueEntityValidator
{
    public function __construct(
        ManagerRegistry $registry,
        private readonly UserManager $userManager,
        private readonly RequestStack $requestStack,
        private readonly Security $security

    ) {
        parent::__construct($registry);
    }

    public function validate(mixed $entity, Constraint $constraint): void
    {
        if(!$constraint instanceof Unique) {
            throw new UnexpectedTypeException($constraint, Unique::class);
        }

        if($entity instanceof UserModel) {
            if($this->requestStack->getCurrentRequest()->attributes->has('id')) {
                $id = $this->requestStack->getCurrentRequest()->attributes->get('id');
                $user = $this->userManager->findEntity($id);
            } else if($this->security->getUser()) {
                $user = $this->security->getUser();
            } else {
                $user = new User();
            }

            if(isset($entity->email)) {
                $user->setEmail($entity->email);
            }
            parent::validate($user, $constraint);
        }
    }
}
