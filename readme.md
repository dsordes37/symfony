# SYMFONY E API PLATFORM

## Ferramentas

### Symfony
Symfony é um framework fullstack feito para a linguagem PHP.
Embora seja um framework fullstack, trabalharemos apenas com a criação de apis.


### Doctrine
Doctrine é a ORM integrada ao symfony que traduz as estruturas relacionais de bancos de dados como MySql e postgree em estruturas orientadas a objetos. Que podem ser manipuladas de forma mais eficiente pelo synfony.

As estruturas no symfony correspondentes às tabelas mysql são entidades ou entitys.


### API platform
API platform é uma ferramenta que ajuda a criação de APIs com Symfony
Ela atua se baseando nas entidades Doctrine criadas no symfony para criar automaticamente os metodos e endpoints para fazer CRUD:
* GET
* POST
* PACTH
* DELETE.

Além de entregar uma documentação dos endpoints.


## Criação de projeto

### Criar um novo projeto
```
symfony new nome_do_projeto --api
```

### Entrar no diretório do projeto
```
cd nome_do_projeto
```

### Mudar o arquivo .env
Altere o seguinte trecho de código no arquivo .env do seu projeto.
```
DATABASE_URL="mysql://mysqlUser:senha@127.0.0.1:3306/nomeDatabase?serverVersion=8.0.32&charset=utf8mb4"
```
Essa configuração se altera a depender do banco de dados usado. nesse caso é o mysql. Ao fazer isso não é necessário que o banco seja previamente criado. Eles será iniciado junto ao projeto.


### Criar o banco de dados
```
symfony console doctrine:database:create
```
Cria o banco de dados, baseado na configuração anterior.

### Instalar o maker-bundle
```
composer require symfony/maker-bundle --dev
```
O maker-bundle torna mais eficiente a criação de entidades e outros componentes do sistema.

### Criar as entidades
```
symfony console make:entity NomeDaEntidade
```
Ao rodar esse comando o console lhe apresentará algumas opções para preencher e criar as colunas da tabela no banco de dados.

#### nome da entidade
```
New property name (press <return> to stop adding fields):
```
Recebe o nome da coluna.

#### Tipo de dado na tabela
```
Field type (enter ? to see all types) [string]:
```

#### Caso string - O tamanho a quantidade máxima de caracteres
```
Field length [255]:
```

#### O dado pode ser nulo ??
```
Can this field be null in the database (nullable) (yes/no) [no]:
```

#### Adicione mais colunas à entidades ou tecle enter pra encerrar
```
Add another property? Enter the property name (or press <return> to stop adding fields):
```

Ao finalizar essa etapa você terá um arquivo **nomeDaEntity.php** no caminho `/src/Etity/nomeDaEntity.php`, o **API platform** vai se basear nesse arquivo para criar os endpoints.

### Adicione as importações necessárias
Vá até o arquivo das entitys e adicione as seguintes linhas de código.
```PHP

use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
public string $name;
```
Caso a linha `#[ApiResource]` ou sua importação não seja adicionada, o API platform não conseguirá reconhecer a entidade e não criará os endoints.


### Fazer a migração
```
symfony console make:migration
symfony console doctrine:migrations:migrate
```
Serve para sincronizar as alterações nas entidades com as tabelas do banco de dados.


### Roda o projeto
```
symfony serve
```

### Acesse a api
```
http://localhost:8000/api/nomeDaEntity
```
Cada entity possui sua própria URL seguindo o padrão acima.