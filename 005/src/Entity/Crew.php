<?php

namespace App\Entity;

use App\Repository\CrewRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
#[ORM\Entity(repositoryClass: CrewRepository::class)]
#[ORM\Table(name: '`crew`')]
class Crew
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $memberCount = null;

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

    public function getMemberCount(): ?int
    {
        return $this->memberCount;
    }

    public function setMemberCount(int $memberCount): static
    {
        $this->memberCount = $memberCount;

        return $this;
    }
}
