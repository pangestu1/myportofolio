# Gunakan image PHP 8.2 FPM resmi
FROM php:8.2-fpm

# Install dependensi sistem dan ekstensi PHP
RUN apt-get update && apt-get install -y nginx git curl libpng-dev libonig-dev libxml2-dev zip unzip libzip-dev
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set direktori kerja
WORKDIR /var/www/html

# Salin SELURUH kode aplikasi terlebih dahulu
COPY . .

# Install dependensi PHP. Sekarang semua file (bootstrap, config, artisan) sudah ada.
RUN composer install --no-dev --optimize-autoloader

# Jalankan perintah artisan dan atur permission
RUN php artisan storage:link && php artisan config:cache && php artisan route:cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Salin file konfigurasi Nginx dan script start
COPY nginx.conf /etc/nginx/sites-available/default
COPY start.sh /start.sh

# Ubah lokasi file PID di konfigurasi utama Nginx
RUN sed -i 's/pid \/run\/nginx.pid;/pid \/var\/www\/html\/nginx.pid;/g' /etc/nginx/nginx.conf

# Berikan izin eksekusi pada script start
RUN chmod +x /start.sh

# Berikan kepemilikan folder nginx kepada user www-data
RUN chown -R www-data:www-data /var/lib/nginx /var/log/nginx

# Gunakan user www-data untuk proses running
USER www-data

# Jalankan script start untuk memulai Nginx dan PHP-FPM
CMD ["/start.sh"]