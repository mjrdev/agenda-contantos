### Projeto de sistema de agenda de contatos

Será necessário ter o docker instalado localmente para build da aplicaçãp

A aplicação consiste em um CRUD para cadastrar contatos em uma agenda, uso como
tecnologias, php/laravel e vue para as interfaces.

#### como rodar o projeto LINUX/MAC - no windows faça os comandos equivalentes
``` bash
git clone https://github.com/mjrdev/agenda-contantos.git agenda

or 

git clone git@github.com:mjrdev/agenda-contantos.git agenda
```
``` bash
cd agenda
``` 

``` bash
docker compose up -d --build
``` 
``` bash
docker compose exec app cp .env.example .env
``` 
``` bash
docker compose exec app composer install
``` 
``` bash
docker compose exec app php artisan key:generate
``` 
``` bash
docker compose exec app chmod 777 -Rf ./storage ./bootstrap
``` 
``` bash
docker compose exec app php artisan migrate --seed
# selecione yes
```
``` bash
docker compose exec app npm install
```
``` bash
docker compose exec app npm run build
```

NOTA: pode acontecer que em seu caso tenha que usar ```docker-composer ...```

a aplicação ficara disponivel em ```http://localhost:8005```