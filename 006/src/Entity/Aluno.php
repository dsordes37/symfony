<?php

namespace App\Entity;

use App\Repository\AlunoRepository;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use ApiPlatform\Metadata\ApiResource;
#[ORM\Table(name: '`aluno`')]
#[ApiResource]

#[ORM\Entity(repositoryClass: AlunoRepository::class)]
class Aluno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    //Relacionamento========================================================================================
    
    #[ORM\OneToMany(mappedBy: 'aluno', targetEntity: Absence::class, orphanRemoval: true)]
    // Define a coleção de faltas
    
    private Collection $absences;

    #[ORM\OneToMany(mappedBy: 'aluno', targetEntity: Presence::class, orphanRemoval: true)]
    private Collection $presences;
    // Define a coleção de presenças

    public function __construct()
    {
        $this->absences = new ArrayCollection();
        $this->presences = new ArrayCollection();
    }


    //========================================================================================================

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


    //gets e sets relacionamentos=========================================================================
    // public function getAbsences(): ?int
    // {
    //     return $this->absences;
    // }

    // public function setAbsences(?int $absences): static
    // {
    //     $this->absences = $absences;

    //     return $this;
    // }

    // public function getPresences(): ?int
    // {
    //     return $this->presences;
    // }

    // public function setPresences(?int $presences): static
    // {
    //     $this->presences = $presences;

    //     return $this;
    // }
}
