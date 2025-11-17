<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
#[ORM\Entity(repositoryClass: CharacterRepository::class)]
#[ORM\Table(name: '`character`')]
class Character
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fruit = null;

    #[ORM\Column(nullable: true)]
    private ?int $crewId = null;

    #[ORM\Column(length: 255)]
    private ?string $origin = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFruit(): ?string
    {
        return $this->fruit;
    }

    public function setFruit(?string $fruit): static
    {
        $this->fruit = $fruit;

        return $this;
    }

    public function getCrewId(): ?int
    {
        return $this->crewId;
    }

    public function setCrewId(?int $crewId): static
    {
        $this->crewId = $crewId;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): static
    {
        $this->origin = $origin;

        return $this;
    }
}
