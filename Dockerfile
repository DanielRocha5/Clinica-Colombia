FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring zip bcmath curl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-interaction

RUN mkdir -p database && touch database/database.sqlite
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD sh -c "php artisan migrate --force && php artisan db:seed --class=RolesSeeder --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"