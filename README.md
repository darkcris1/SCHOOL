## Laradock setup

```bash
cd laradock
docker-compose up -d nginx mysql phpmyadmin
docker compose exec workspace bash
composer install
php artisan migrate
php artisan db:seed 
```

## vue setup
```bash
cd my_vue_app
npm install
npm run start
```