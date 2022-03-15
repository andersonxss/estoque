# EstoqueBackEnd

<br>

## Project setup

### Framework

```
Projeto desenvolvido com Laravel
```

### Banco de dados

```
MySQL
```

Nome do banco de dados

```
estoque
```

## Instalação

Abra o seu terminal selecione a pasta estoquebackend e rode o comando abaixo para instalar os pacotes via composer

```
composer install
```

## Banco de dados

Instalação das tabalas do banco de dados via migrations

```
php artisan migrate
```

## Insersão de alguns dados principais com Seeding

Inserindo dados na tabela de perfil

```
php artisan db:seed --class=PefilSeeder
```

Inserindo dados na tabela de status

```
php artisan db:seed --class=StatusSeeder
```

Inserindo dados na tabela de Desconto

```
php artisan db:seed --class=DescontoSeeder
```

Inserindo dados na tabela de Usuário

```
php artisan db:seed --class=UsersSeeder
```

Se caso preferir importar o banco de dados sem precisar realizar a configuração acima,
<br> escolha o seu SGDB de preferência e selecione o arquivo na pasta informada abaixo.

```
estoquebackend\database\estoque.sql
```

## Teste

Foi implementado dois simples testes na aplicação para cadastrar um produto e outro para validar o campo pro_nome

```
vendor/bin/phpunit
```
