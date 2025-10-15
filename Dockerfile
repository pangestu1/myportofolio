FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip \
    && docker-php-ext-install pdo_mysql zip

WORKDIR /var/www/html

COPY . .

# Install composer dari image resmi
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set repo composer normal (bukan mirrors aliyun)
RUN composer config -g --unset repos.packagist && \
    composer config -g repo.packagist composer https://repo.packagist.org

RUN composer install --no-dev --optimize-autoloader

# Copy .env.example ke .env (Render akan override variabelnya)
RUN cp .env.example .env

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8080

# Jalankan migrasi sebelum serve
CMD php artisan key:generate --force && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080
