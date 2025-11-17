<?php

namespace App\Entity;

use App\Repository\MusicRepository;
use Doctrine\ORM\Mapping as ORM;

//Validações
use Symfony\Component\Validator\Constraints as Assert;
//importação da api resource
use ApiPlatform\Metadata\ApiResource;

//filtros de busca
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;


#[ORM\Entity(repositoryClass: MusicRepository::class)]

#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['singerId'=>'exact'])]
class Music
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $singerId = null;

    #[ORM\Column]
    private ?int $year = null;

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

    public function getSingerId(): ?int
    {
        return $this->singerId;
    }

    public function setSingerId(int $singerId): static
    {
        $this->singerId = $singerId;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }
}
