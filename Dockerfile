# Gunakan image PHP dengan ekstensi yang dibutuhkan
FROM php:8.2-apache

# Install dependencies sistem yang diperlukan
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip \
    && docker-php-ext-install pdo_mysql zip

# Set working directory
WORKDIR /var/www/html

# Copy semua file Laravel ke dalam container
COPY . .

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Pastikan direktori storage dan bootstrap/cache dapat ditulis
RUN chmod -R 775 storage bootstrap/cache

# Expose port 8080
EXPOSE 8080

# Jalankan Laravel (Render inject env saat runtime)
CMD php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan serve --host=0.0.0.0 --port=8080
