# Teste Engenheiro Júnior - Lucas Thiago Dávalos Ortiz

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

Rode docker-compose pela primeira vez e use docker exec para instalar as dependencias:

```bash
$ docker-compose up -d
$ docker exec -it laravel-luksApp-1 composer install
$ docker-compose down
```
