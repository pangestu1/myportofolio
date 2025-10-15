FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip \
    && docker-php-ext-install pdo_mysql zip

WORKDIR /var/www/html

COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

# Tambahkan langkah ini:
RUN cp .env.example .env

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

# Jalankan key:generate sekarang sudah bisa karena ada .env
CMD php artisan key:generate --force && php artisan serve --host=0.0.0.0 --port=8080
