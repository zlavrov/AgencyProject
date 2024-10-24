<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\EntityInterface;
use App\Entity\User;
use App\Enum\FamilySituationType;
use App\Enum\SexType;
use App\Model\ModelList\ModelListInterface;
use App\Model\ModelList\UserModelList;
use App\Security\AccessGroup;
use App\Validator\Constraints\PasswordStrength;
use App\Validator\Constraints\Unique;
use DateTimeImmutable;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Attribute\Ignore;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

#[Unique('email', message: '', groups: [AccessGroup::USER_SIGN, AccessGroup::USER_WRITE_EMAIL])]
class UserModel implements ModelInterface
{
    #[Groups(groups: [
        AccessGroup::USER_READ,
        AccessGroup::USER_SIGN_RESPONSE,
    ])]
    public int $id;

    #[Groups(groups: [
        AccessGroup::USER_READ,
        AccessGroup::USER_SIGN_RESPONSE,
        AccessGroup::USER_SIGN,
        AccessGroup::USER_WRITE_EMAIL,
        AccessGroup::USER_FORGOT_PASSWORD,
        AccessGroup::USER_EMAIL_VERIFY,
        AccessGroup::USER_CONFIRM_EMAIL,
    ])]
    #[Property(example: 'apple@gamil.com')]
    #[NotBlank(groups: [AccessGroup::USER_SIGN, AccessGroup::USER_CONFIRM_EMAIL])]
    #[Email(groups: [AccessGroup::USER_SIGN, AccessGroup::USER_CONFIRM_EMAIL])]
    public ?string $email;

    #[Groups(groups: [
        AccessGroup::USER_READ,
    ])]
    #[Property(
        type: 'array',
        items: new Items(type: 'string', example: ['ROLE_USER'])
    )]
    public array $roles;

    #[Groups(groups: [
        AccessGroup::USER_SIGN,
        AccessGroup::USER_WRITE_PASSWORD,
        AccessGroup::USER_CHANGE_PASSWORD,
    ])]
    #[Property(example: 'apple36')]
    #[NotBlank(groups: [AccessGroup::USER_SIGN, AccessGroup::USER_WRITE_PASSWORD])]
    #[PasswordStrength(groups: [AccessGroup::USER_SIGN, AccessGroup::USER_WRITE_PASSWORD])]
    public string $password;

    #[Groups(groups: [
        AccessGroup::USER_WRITE_PASSWORD,
    ])]
    #[Property(example: 'pear36')]
    #[PasswordStrength(groups: [AccessGroup::USER_WRITE_PASSWORD])]
    public ?string $plainPassword;

    #[Groups(groups: [
        AccessGroup::USER_SIGN,
        AccessGroup::USER_READ,
        AccessGroup::USER_WRITE,
    ])]
    #[Property(example: 'First Name')]
    #[NotBlank(groups: [AccessGroup::USER_SIGN, AccessGroup::USER_WRITE])]
    public string $firstName;

    #[Groups(groups: [
        AccessGroup::USER_SIGN,
        AccessGroup::USER_READ,
        AccessGroup::USER_WRITE,
    ])]
    #[Property(example: 'Last Name')]
    #[NotBlank(groups: [AccessGroup::USER_SIGN, AccessGroup::USER_WRITE])]
    public string $lastName;

    #[Groups(groups: [
        AccessGroup::USER_READ,
        AccessGroup::USER_VERIFY_ADMIN_READ,
        AccessGroup::USER_VERIFY_ADMIN_WRITE,
    ])]
    public bool $emailVerified;

    #[Groups(groups: [
        AccessGroup::USER_READ,
        AccessGroup::USER_ACTIVE_READ,
        AccessGroup::USER_ACTIVE_WRITE,
    ])]
    public bool $active;

    #[Groups(groups: [
        AccessGroup::USER_SIGN,
        AccessGroup::USER_READ,
    ])]
    public ?bool $professional;

    #[Groups(groups: [
        AccessGroup::USER_SIGN,
        AccessGroup::USER_WRITE,
        AccessGroup::USER_READ,
    ])]
    #[Property(example: '2000-10-25T00:00:00.000Z')]
    #[NotBlank(groups: [AccessGroup::USER_SIGN, AccessGroup::USER_WRITE])]
    public DateTimeImmutable $dateOfBirth;

    #[Groups(groups: [
        AccessGroup::USER_READ,
        AccessGroup::USER_VERIFY_ADMIN_READ,
    ])]
    #[Property(example: '2000-10-25T00:00:00.000Z')]
    public ?DateTimeImmutable $emailVerifiedAt;

    #[Groups(groups: [
        AccessGroup::USER_READ,
        AccessGroup::USER_WRITE,
    ])]
    public ?FamilySituationType $familySituation;

    #[Groups(groups: [
        AccessGroup::USER_SIGN,
        AccessGroup::USER_WRITE,
        AccessGroup::USER_READ,
    ])]
    #[NotBlank(groups: [AccessGroup::USER_SIGN])]
    public ?SexType $sex;

    #[Groups(groups: [
        AccessGroup::USER_SIGN,
        AccessGroup::USER_WRITE,
        AccessGroup::USER_READ,
    ])]
    public ?string $company;












    #[Groups(groups: [
        AccessGroup::USER_READ,
    ])]
    public DateTimeImmutable $createdAt;

    #[Groups(groups: [
        AccessGroup::USER_READ,
    ])]
    public ?DateTimeImmutable $updatedAt;

    #[Ignore]
    public function getEntity(): EntityInterface
    {
        return new User();
    }

    #[Ignore]
    public function getModelList(): ModelListInterface
    {
        return new UserModelList();
    }
}
