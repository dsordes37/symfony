<?php

namespace App\Entity;

use App\Repository\SingerRepository;
use Doctrine\ORM\Mapping as ORM;

//Validações
use Symfony\Component\Validator\Constraints as Assert;
//importação da api resource
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: SingerRepository::class)]
#[ApiResource]
class Singer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $style = null;

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

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(string $style): static
    {
        $this->style = $style;

        return $this;
    }
}
