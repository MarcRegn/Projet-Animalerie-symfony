<?php

namespace App\Entity;

use App\Enum\AnimalStatus;
use App\Repository\AnimalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Component\Validator\Constraints as Assert;

#[Entity(repositoryClass: AnimalRepository::class)]
#[Table(name: 'animal')]
class Animal
{
    #[Id, Column(type: 'integer'), GeneratedValue]
    private ?int $id = null;

    #[Column(type: 'string', length: 100, nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $name;

    #[Column(type: 'string', length: 255, unique: true, nullable: false)]
    private ?string $slug = null;

    #[Column(type: 'text', nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $description;

    #[Column(type: 'integer', nullable: false)]
    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    private int $age;

    #[Column(
        type: Types::STRING,
        length: 30,
        nullable: false,
        enumType: AnimalStatus::class
    )]
    private AnimalStatus $status = AnimalStatus::Available;

    #[Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getStatus(): AnimalStatus
    {
        return $this->status;
    }

    public function setStatus(AnimalStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
