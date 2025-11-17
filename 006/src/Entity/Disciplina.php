<?php

namespace App\Entity;

use App\Repository\DisciplinaRepository;
use Doctrine\ORM\Mapping as ORM;

use ApiPlatform\Metadata\ApiResource;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ApiResource]

#[ORM\Entity(repositoryClass: DisciplinaRepository::class)]

class Disciplina
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $maxAbsenceCount = null;

    //Relacionamentos=============================================================================================================

    #[ORM\OneToMany(mappedBy: 'disciplina', targetEntity: Absence::class, orphanRemoval: true)]
    // Define a coleção de faltas
    
    private Collection $absences;

    #[ORM\OneToMany(mappedBy: 'disciplina', targetEntity: Presence::class, orphanRemoval: true)]
    private Collection $presences;
    // Define a coleção de presenças

    public function __construct()
    {
        $this->absences = new ArrayCollection();
        $this->presences = new ArrayCollection();
    }

    //=========================================================================================================



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

    public function getMaxAbsenceCount(): ?int
    {
        return $this->maxAbsenceCount;
    }

    public function setMaxAbsenceCount(?int $maxAbsenceCount): static
    {
        $this->maxAbsenceCount = $maxAbsenceCount;

        return $this;
    }


    //gets e sets relacionamentos========================================================================
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
