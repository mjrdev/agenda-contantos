cp .env.example .env &&
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app chmod 777 -Rf ./storage ./bootstrap
docker compose exec app composer install
docker compose exec app php artisan migrate --seed
docker compose exec app npm install
docker compose exec app npm run build
