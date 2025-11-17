## 🧩 PLANO DE ESTUDO — Criação de APIs com Symfony + API Platform

### 🎯 Objetivo final

Estar pronto para:

* Entender a estrutura de um back-end com Symfony
* Criar APIs REST com o API Platform
* Trabalhar com entidades e banco de dados MySQL
* Entregar endpoints que um front-end Angular possa consumir

---

## **🚀 PROJETO 1 — Estrutura base do Symfony (1h)**

🎯 *Objetivo:* entender o funcionamento do framework sem ainda usar o API Platform.

**Nome do projeto:** `symfony_base_api`

1. Criar o projeto:

   ```bash
   symfony new symfony_base_api --webapp
   cd symfony_base_api
   ```

2. Criar um controller simples:

   ```bash
   symfony console make:controller ApiController
   ```

3. Edite o arquivo gerado em `src/Controller/ApiController.php`:

   ```php
   #[Route('/api/hello', name: 'api_hello')]
   public function index(): JsonResponse
   {
       return $this->json([
           'message' => 'API Symfony funcionando!',
           'status' => 'ok'
       ]);
   }
   ```

4. Rode o servidor:

   ```bash
   symfony serve -d
   symfony open:local
   ```

5. Acesse `/api/hello` e veja o retorno JSON.
   👉 **Conceito aprendido:** controladores + resposta JSON manual (base para APIs “puras”).

---

## **💾 PROJETO 2 — Symfony + MySQL + Doctrine (1h30)**

🎯 *Objetivo:* conectar o Symfony a um banco MySQL e gerar entidades.

**Nome do projeto:** `symfony_mysql_api`

1. Criar o projeto:

   ```bash
   symfony new symfony_mysql_api --webapp
   cd symfony_mysql_api
   ```

2. Configurar o `.env`:

   ```bash
   DATABASE_URL="mysql://root:senha@127.0.0.1:3306/symfony_mysql_api?serverVersion=8.0"
   ```

3. Criar e configurar o banco:

   ```bash
   symfony console doctrine:database:create
   symfony console make:entity Product
   # Campos: name (string), price (float)
   symfony console make:migration
   symfony console doctrine:migrations:migrate
   ```

4. Criar um endpoint que liste produtos:

   ```bash
   symfony console make:controller ProductController
   ```

   Dentro do controller:

   ```php
   #[Route('/api/products', name: 'api_products')]
   public function index(ProductRepository $repo): JsonResponse
   {
       return $this->json($repo->findAll());
   }
   ```

5. 👉 **Conceitos aprendidos:** integração com MySQL, ORM Doctrine, e retorno de dados via repositório.

---

## **🌐 PROJETO 3 — API Platform básica (2h)**

🎯 *Objetivo:* usar o API Platform para gerar endpoints automáticos a partir das entidades.

**Nome do projeto:** `api_platform_intro`

1. Criar o projeto:

   ```bash
   symfony new api_platform_intro --webapp
   cd api_platform_intro
   symfony composer require api
   ```

2. Criar a entidade:

   ```bash
   symfony console make:entity Product
   # name (string), price (float)
   symfony console make:migration
   symfony console doctrine:migrations:migrate
   ```

3. Adicionar o atributo `#[ApiResource]`:

   ```php
   use ApiPlatform\Metadata\ApiResource;

   #[ORM\Entity]
   #[ApiResource]
   class Product
   {
       ...
   }
   ```

4. Rode o servidor e acesse:

   ```bash
   symfony serve -d
   symfony open:local
   ```

   Vá até `/api` → explore a **documentação automática (Swagger UI)**.

5. 👉 **Conceitos aprendidos:** endpoints automáticos, documentação integrada e CRUD REST sem código manual.

---

## **🧩 PROJETO 4 — API Platform + MySQL real (2h)**

🎯 *Objetivo:* criar uma API mais completa com relacionamentos, validação e persistência.

**Nome do projeto:** `api_platform_mysql`

1. Criar o projeto e conectar ao banco:

   ```bash
   symfony new api_platform_mysql --webapp
   cd api_platform_mysql
   symfony composer require api
   composer require symfony/validator
   composer require symfony/security-bundle
   DATABASE_URL="mysql://root:senha@127.0.0.1:3306/api_platform_mysql?serverVersion=8.0"
   symfony console doctrine:database:create
   ```

2. Criar as entidades:

   ```bash
   symfony console make:entity Category
   # name (string)

   symfony console make:entity Product
   # name (string)
   # price (float)
   # category (relation: ManyToOne, Category)
   ```

3. Adicione validações:

   ```php
   use Symfony\Component\Validator\Constraints as Assert;

   #[ORM\Column(length: 255)]
   #[Assert\NotBlank]
   #[Assert\Length(min: 2)]
   public string $name;
   ```

4. Faça a migração:

   ```bash
   symfony console make:migration
   symfony console doctrine:migrations:migrate
   ```

5. Acesse `/api` e teste os endpoints `Product` e `Category` no Swagger.

   * Veja como o relacionamento aparece (campo `category` dentro de `product`).
   * Teste criar e listar via interface.

6. 👉 **Conceitos aprendidos:** relacionamentos, validação, persistência e fluxo completo de uma API real.

---

### 🧪 Dica extra

Se você quiser que o API Platform **também aceite JSON comum**, pode configurar isso no arquivo `config/packages/api_platform.yaml`:

```yaml
api_platform:
    formats:
        jsonld: ['application/ld+json']
        json: ['application/json']
```

Depois disso, `application/json` passará a ser aceito normalmente.

---

Quer que eu te mostre também como listar as rotas disponíveis para confirmar o endpoint `/api/musics`?
