### Projeto de sistema de agenda

#### como rodar o projeto
``` bash
git clone http
``` 
docker compose up -d --build
docker compose exec app chmod 777 -Rf ./storage ./bootstrap
docker compose exec app php artisan migrate