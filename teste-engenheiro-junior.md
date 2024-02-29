# Configurando o projeto

Siga a instalação passo-a-passo

Configure o .env primeiramente.

```bash
cp .env.example .env
```

Adicione as permissões para a pasta docker

```bash
sudo chmod -R 777 docker
```

Remova a pasta database dentro de storage
```bash
cd storage/
sudo rm -rf database/
```

Com o docker e o docker-compose já instalados na máquina, ergua os conteineres:

```bash
docker-compose up -d
```


Utilize o comando dcomposer para instalar as depêndencias do projeto:

```bash
./dcomposer install
```

Após instalar as dependências, gere a key do laravel:

```bash
./dartisan key:generate
```

Gere o secret jwt:

```bash
./dartisan jwt:secret
```

Rode as migrations:

```bash
./dartisan migrate
```

Rode os seeders para popular os produtos:

```bash
./dartisan db:seed --class=ProductSeeder
```



### Acessando projeto:
Se a configuração foi feita corretamente as rotas do projeto ficaram disponíveis a partir da url:
  http://localhost:8000/api

Caso deseje se conectar ao banco de dados utilizando o DBeaver configure os paramêtros para realizar a conexão:
  db: postgres
  host: localhost
  port: 25432
  user: postgres
  password: postgres

As rotas para a Api Rest implementada no projeto estaram numa collection anexada ao repositório. (Basta importar o arquivo "praqt-teste.postman_collection.json" no Postman)

### Observações Gerais:

  Por falta de tempo, não consegui implementar a parte de descontos. Além disso, o front-end não foi implementado, tendo sido implementado apenas o Api Rest, fazendo uso da biblioteca tymon/jwt, para lidar com a autenticação de usuários.
  Gostaria de ter usado os patterns de Repositories e Services(tanto que até tentei usar), mas de alguma forma o Laravel não conseguia reconhecer os arquivos nos Services ou nos Repositories, novamente por falta de tempo, optei por utilizar apenas pelo Controller já chamando diretamente a camada de Model e executando a lógica de negócio na mesma. Validações nas requisiçoes também acabaram por não serem implementadas por falta de tempo.
  A pasta storage do projeto possui um problema ao realizar o comando "git add .", toda vez antes de realizar o comando é necessário conceder permissão para a mesma sento utilizado o comando "sudo chmod -R 777 storage/database".