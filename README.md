# Teste para vaga de Engenheiro full stack Junior

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes requisitos instalados em sua máquina:

- Docker: [Instalação do Docker](https://docs.docker.com/get-docker/)
- Docker Compose: [Instalação do Docker Compose](https://docs.docker.com/compose/install/)
- Sail: [Instalação do Sail](https://laravel.com/docs/10.x/sail)
- Breeze (React) [Instalação do Breeze](https://laravel.com/docs/10.x/starter-kits#breeze-and-inertia)

## Instalação

Siga estas etapas para configurar e executar o projeto:

1. Clone este repositório em sua máquina local:

```bash
git clone https://github.com/EstherWI/teste-engenheiro-junior/tree/EstherDeSantanaAraujo
```
2. Acesse o diretório do projeto:
```bash
cd teste-junior-app
```
3. Inicie o Sail:
```bash
./vendor/bin/sail up

```
4. Migrações do Banco de dados:
```bash
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

4. Rodar aplicação:
```bash
npm run dev
```

### Dashboard
- Rota: /dashboard

### Cadastro
- Rota: /register

### Login
- Rota: /login
