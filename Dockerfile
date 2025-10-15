# Gunakan image PHP
FROM php:8.2-apache

# Install dependency sistem
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip \
    && docker-php-ext-install pdo_mysql zip

# Set working directory
WORKDIR /var/www/html

# Copy semua file project Laravel
COPY . .

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install dependency Laravel
RUN composer install --no-dev --optimize-autoloader

# Tambahkan .env dari contoh
RUN cp .env.example .env

# Tambahkan environment variable agar dibaca dari Render
ARG APP_KEY
ENV APP_KEY=${APP_KEY}

# Cache konfigurasi Laravel
RUN php artisan config:cache && php artisan route:cache

# Atur permission storage dan cache
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 8080

# Jalankan aplikasi Laravel
CMD php artisan serve --host=0.0.0.0 --port=8080
