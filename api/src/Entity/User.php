<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

enum Sex: string
{
    case MALE = "male";
    case FEMALE = "female";
}

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\Email]
    private ?string $email = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\Regex('/(\w|[А-Яа-я])+/')]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Regex('/^(male)|(female)$/')]
    private $sex = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(length: 20, unique: true)]
    #[Assert\Regex('/^\d+/')]
    private ?string $phone = null;

    #[Gedmo\Timestampable(on:"update")]
    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $created_at;

    #[Gedmo\Timestampable(on:"update")]
    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Assert\Type(\DateTimeInterface::class)]
    private ?\DateTimeInterface $updated_at;

    public function init($data) {
        $this->setEmail($data->email)
            ->setPhone($data->phone)
            ->setName($data->name)
            ->setBirthday(new \DateTime($data->birthday))
            ->setSex($data->sex)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isSex()
    {
        return $this->sex;
    }

    public function setSex($sex): static
    {
        $this->sex = $sex;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
