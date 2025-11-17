# RELACIONAMENTOS

O relacionamento entre tabelas é um dos aspectos mais importantes de um banco de dados robusto. O doctrine se propões também a simplificar essas relações.

No doctrine, assim como no mysql, utlizam-se chaves estrangeiras para relacionar uma entidade (equivlente a uma tabela) com outra, podendo ser uma relação um para um, um para muitos ou muitos para muitos. Porém, dierente do mysql, a chave estrangeira no doctrine é a localização da entidade, represenrada por "api/nome_da_entity/id".

## Passo a passo

Primeiro, crie o projeto e as entidades no processo descrito em Primeiros passos. Com elas funcionando siga adiante.

### No arquivo que importa a chave

#### Importe as entidades

Aqui importamos as entidades forasteiras que serão usadas
```php
use App\Entity\Disciplina;
```

#### Adicione os marcadores antes da chave estrangeira
```php
#[ORM\ManyToOne(inversedBy: 'disciplina')]
//Define o relacionamento com o lado "Um" (disciplina)

#[ORM\JoinColumn(nullable: false)]
//Garante que toda falta DEVE ter um Funcionário

#[Groups(['disciplina:read', 'disciplina:write'])]
//Permite que a API Platform serialize/deserialize este campo


private ?Disciplina $disciplina = null;
//O atributo que vai receber a identificador da dsciplina
```

### No arquivo que exporta a chave

#### Iporte o as collections

```php
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
//Servem para organizar os registros que possuem uma chave estrangeira daqui em arrays. O que facilita a pesquisa.
```

#### Adicione o marcador e crie a coleção

```php
#[ORM\OneToMany(mappedBy: 'disciplina', targetEntity: Absence::class, orphanRemoval: true)]
// Define a coleção de faltas

private Collection $absences;
```

#### Crie uma função construct e adicione a coleção

```php
public function __construct()
{
    $this->absences = new ArrayCollection();
}
```

Em seguida, adicione os getters e setters para as coleções

### Teste
Com esse processo finaizado, basta rodar o servidor e testar

```bash
symfony serve
```

Para passar um registro na entidade utilizamos seu caminho com id.

exemplo:
```bash

curl -X POST "http://localhost:8000/api/absences" \
-H "Content-Type: application/json" \
-d '{ "disciplina":"api/disciplinas/2", "aluno":"api/alunos/3" }'

```

Aqui registramos uma falta do aluno de id número 3 na aula de id número 4.

## Pesquisas relacionais

Como pesquisar faltas pelo nome ou id do aluno por exemplo.
Para isso utilizamos os filters.

### Importamos
```php
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
```

### Adicionamos o marcador

Antes da declaração da classe
```php
#[ApiFilter(SearchFilter::class, properties: ['aluno.id'=>'exact', 'aluno.name'=>'partial', 'disciplina.id'=>'exact'])]
/*
O marcador adiciona a pesquisa por:

"id do aluno", o id tem que ser exatamente igual

"nome do aluno", o nome não presica ser 100% igual (parcial)

"id da disciplina", o id tem que ser exatamente igual
*/
```

Importante dizer que para isso funcionar os campos precisam existir na entidade. por exemplo o campo "name" tem que existir com esse nome em "alunos".

### Requisição

Para pesquisar pelo nome do aluno usamos
```
http://localhost:8000/api/absences?aluno.name=Jorge
```

Para pesquisar por disciplina utilizamos
```
http://localhost:8000/api/absences?disciplina.id=5
```

E Para vermos as faltas de um aluno em uma disciplina, usamos
```
http://localhost:8000/api/absences?aluno.name=Jorge&disciplina.id=5
```