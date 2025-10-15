# Gunakan image PHP + Apache
FROM php:8.2-apache

# Install ekstensi PHP yang dibutuhkan Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Copy semua file project ke container
COPY . /var/www/html

# Ubah DocumentRoot Apache agar ke folder public/
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Aktifkan mod_rewrite (wajib buat Laravel route)
RUN a2enmod rewrite

# Tambahkan konfigurasi AllowOverride agar .htaccess bisa jalan
RUN echo "<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" > /etc/apache2/conf-available/laravel.conf && \
    a2enconf laravel

# Beri izin untuk storage dan cache Laravel
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Jalankan Apache
CMD ["apache2-foreground"]
