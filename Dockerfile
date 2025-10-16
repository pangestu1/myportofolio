FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite sqlite3 zip

WORKDIR /var/www/html

COPY . .

# Install composer dari image resmi
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set repo composer normal (bukan mirrors aliyun)
RUN composer config -g --unset repos.packagist && \
    composer config -g repo.packagist composer https://repo.packagist.org

RUN composer install --no-dev --optimize-autoloader

# Siapkan file database SQLite dan perizinannya
RUN mkdir -p database && touch database/database.sqlite && \
    chmod -R 775 storage bootstrap/cache database

EXPOSE 8080

# Jalankan Laravel tanpa migrasi (tidak menggunakan database eksternal)
CMD php artisan serve --host=0.0.0.0 --port=8080

