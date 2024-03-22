### Projeto de sistema de agenda de contatos

Será necessário ter o docker instalado localmente para build da aplicaçãp

A aplicação consiste em um CRUD para cadastrar contatos em uma agenda, uso como
tecnologias, php/laravel e vue para as interfaces.

#### como rodar o projeto
``` bash
git clone http
``` 
``` bash
docker compose up -d --build
``` 
``` bash
docker compose exec app chmod 777 -Rf ./storage ./bootstrap
``` 
``` bash
docker compose exec app php artisan migrate --seed
```

** pode acontecer que em seu caso tenha que usar ```docker-composer ...```