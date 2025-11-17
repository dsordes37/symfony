<?php

namespace App\Entity;

use App\Repository\PresenceRepository;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Disciplina;
use App\Entity\Aluno;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

use ApiPlatform\Metadata\ApiResource;
#[ApiResource]

#[ApiFilter(SearchFilter::class, properties: ['aluno.id'=>'exact', 'aluno.name'=>'partial', 'disciplina.id'=>'exact'])]

#[ORM\Entity(repositoryClass: PresenceRepository::class)]
class Presence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'disciplina')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['disciplina:read', 'disciplina:write'])]

    private ?Disciplina $disciplina = null;

    #[ORM\ManyToOne(inversedBy: 'aluno')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['aluno:read', 'aluno:write'])]
 
    private ?Aluno $aluno = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    


    public function getDisciplina(): ?Disciplina
    {
        return $this->disciplina;
    }

    public function setDisciplina(?Disciplina $disciplina): static
    {
        $this->disciplina = $disciplina;
        return $this;
    }

    public function getAluno(): ?Aluno
    {
        return $this->aluno;
    }

    public function setAluno(?Aluno $aluno): static
    {
        $this->aluno = $aluno;
        return $this;
    }
}
