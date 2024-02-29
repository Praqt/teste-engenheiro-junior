# Teste Engenheiro Júnior - Lucas Thiago Dávalos Ortiz

## Detalhes

- Utilizou-se sqlite como banco de dados e react + inertia para o frontend.

- Seguiu-se os patterns DTO e Services para o back-end.

- As rotas de API não precisam de autenticação.

- O projeto originalmente foi feito [em outro repositório](https://github.com/Luks17/laravel)

## Requisitos

Docker e Docker-Compose instalados e inicializados.

Este projeto foi desenvolvido no sistema operacional Arch Linux, logo é recomendado utilizar WSL2 caso for rodar em windows.

## Comandos

Clone este repositório com:

```bash
$ git clone --branch "LucasThiagoDávalosOrtiz" https://github.com/Luks17/teste-engenheiro-junior.git
```

Navegue até a raíz do projeto com:

```bash
$ cd teste-engenheiro-junior/laravel
```

Crie o arquivo .env com:

```bash
$ cat .env.example > .env
```

REMOVE os seguintes campos:

```
DB_HOST=
DB_PORT=
DB_DATABASE=
```

Modifique os seguintes campos:

```
DB_CONNECTION=sqlite
DB_USERNAME=root
DB_PASSWORD=pass
```

Rode docker-compose pela primeira vez e use docker exec para instalar as dependencias:

```bash
$ docker-compose up -d
$ docker exec -it laravel-luksApp-1 composer install
$ docker exec -it laravel-luksApp-1 php artisan key:generate
$ docker exec -it laravel-luksApp-1 npm install
$ docker-compose down
```

Atualize as permissões:

```bash
$ sudo chmod -R 0777 ./node_modules
$ sudo chmod -R 0777 ./vendor
```

Rode sail e rode as migrações e seu seeder (confirme com sim caso perguntar algo):

```bash
$ ./vendor/bin/sail up -d
$ docker exec -it laravel-luksApp-1 php artisan migrate --seed
```

Atualize a permissão do arquivo sqlite:

```bash
$ sudo chmod 0777 ./database/database.sqlite
```

## Rode o projeto!

```bash
$ docker exec -it laravel-luksApp-1 npm run dev
```
