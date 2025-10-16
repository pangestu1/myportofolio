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

# Berikan izin eksekusi pada script start
RUN chmod +x /start.sh

# Buat user www-data dan gunakan user tersebut untuk proses running
# User www-data sudah ada di image php-fpm
USER www-data

# Jalankan script start untuk memulai Nginx dan PHP-FPM
CMD ["/start.sh"]



#16 [stage-0  8/12] RUN php artisan storage:link && php artisan config:cache && php artisan route:cache
#16 0.270 
#16 0.270    INFO  The [public/storage] link has been connected to [storage/app/public].  
#16 0.270 
#16 0.411 
#16 0.411    INFO  Configuration cached successfully.  
#16 0.411 
#16 0.543 
#16 0.543    INFO  Routes cached successfully.  
#16 0.543 
#16 DONE 0.6s
#17 [stage-0  9/12] RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
#17 DONE 0.2s
#18 [stage-0 10/12] COPY nginx.conf /etc/nginx/sites-available/default
#18 DONE 0.0s
#19 [stage-0 11/12] COPY start.sh /start.sh
#19 DONE 0.0s
#20 [stage-0 12/12] RUN chmod +x /start.sh
#20 DONE 0.1s
#21 exporting to docker image format
#21 exporting layers
#21 exporting layers 4.7s done
#21 exporting manifest sha256:00f1f92a44be7d0814d14575ce40a065021ad962bee83e6bb5cb0d7aa52213ee 0.0s done
#21 exporting config sha256:8960470b00259c30f9e3f8693eb8cfb697518fe07a4740f0240b481e5ef6604a 0.0s done
#21 DONE 7.5s
#22 exporting cache to client directory
#22 preparing build cache for export
#22 writing cache manifest sha256:8383fe5cc4faf72b842111ca59d648233cae6d1d73ab1803b5b246fa16d22de5 done
#22 DONE 4.5s
Pushing image to registry...
Upload succeeded
==> Deploying...
2025/10/16 04:22:02 [warn] 8#8: the "user" directive makes sense only if the master process runs with super-user privileges, ignored in /etc/nginx/nginx.conf:1
2025/10/16 04:22:02 [emerg] 8#8: mkdir() "/var/lib/nginx/body" failed (13: Permission denied)
==> Exited with status 1
==> Common ways to troubleshoot your deploy: https://render.com/docs/troubleshooting-deploys
2025/10/16 04:22:20 [warn] 8#8: the "user" directive makes sense only if the master process runs with super-user privileges, ignored in /etc/nginx/nginx.conf:1
2025/10/16 04:22:20 [emerg] 8#8: mkdir() "/var/lib/nginx/body" failed (13: Permission denied)