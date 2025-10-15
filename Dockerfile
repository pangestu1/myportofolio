# Gunakan image PHP dengan Apache
FROM php:8.2-apache

# Install dependencies dan ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git zip unzip libpq-dev libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Salin semua file ke dalam container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Set permission storage & bootstrap
RUN chmod -R 775 storage bootstrap/cache

# Jalankan artisan key generate saat pertama kali build
# RUN php artisan key:generate

# Expose port 80
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
