cp .env.example .env

docker-compose up -d --build

docker exec laravel-docker_app_1 composer install --prefer-dist --optimize-autoloader

docker exec laravel-docker_app_1 php artisan config:cache

docker exec laravel-docker_app_1 php artisan migrate:fresh

Recommended
docker-compose exec app chown -R www-data:www-data storage

docker exec laravel-docker_app_1  chmod -R 755 /var/www/public
