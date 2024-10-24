<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\FamilySituationType;
use App\Enum\SexType;
use App\Model\ModelInterface;
use App\Model\UserModel;
use App\Repository\UserRepository;
use App\Security\Roles;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface, EntityInterface
{
    use TimeTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::STRING, length: 180, unique: true)]
    private string $email;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $roles;

    #[ORM\Column(type: Types::STRING)]
    private string $password;

    private ?string $plainPassword = null;

    #[ORM\Column(type: Types::STRING)]
    private string $firstName;

    #[ORM\Column(type: Types::STRING)]
    private string $lastName;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $emailVerified = false;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $active = true;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $professional = false;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeInterface $dateOfBirth;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $emailVerifiedAt;

    #[ORM\Column(type: Types::STRING, nullable: true, enumType: FamilySituationType::class)]
    private ?FamilySituationType $familySituation;

    #[ORM\Column(type: Types::STRING, nullable: true, enumType: SexType::class)]
    private ?SexType $sex = SexType::MALE;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $company;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = Roles::ROLE_USER;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFullName(): string
    {
        return \trim(\sprintf('%s %s.', $this->firstName, $this->lastName));
    }

    public function getShortFullName(): string
    {
        return \trim(\sprintf('%s %s.', $this->firstName, ucfirst($this->lastName[0]) ?? ''));
    }

    public function isEmailVerified(): bool
    {
        return $this->emailVerified;
    }

    public function setEmailVerified(bool $emailVerified): self
    {
        $this->emailVerified = $emailVerified;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function isProfessional(): bool
    {
        return $this->professional;
    }

    public function setProfessional(bool $professional): self
    {
        $this->professional = $professional;

        return $this;
    }

    public function getDateOfBirth(): \DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getEmailVerifiedAt(): ?\DateTimeImmutable
    {
        return $this->emailVerifiedAt;
    }

    public function setEmailVerifiedAt(?\DateTimeImmutable $emailVerifiedAt): self
    {
        $this->emailVerifiedAt = $emailVerifiedAt;

        return $this;
    }

    public function getFamilySituation(): ?FamilySituationType
    {
        return $this->familySituation;
    }

    public function setFamilySituation(?FamilySituationType $familySituation): self
    {
        $this->familySituation = $familySituation;

        return $this;
    }

    public function getSex(): ?SexType
    {
        return $this->sex;
    }

    public function setSex(?SexType $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getModel(): ModelInterface
    {
        return new UserModel();
    }
}
