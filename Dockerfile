# Gunakan image PHP dengan Apache
FROM php:8.2-apache

# Install ekstensi yang dibutuhkan Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Copy semua file project ke dalam container
COPY . /var/www/html

# Set working directory ke folder public Laravel
WORKDIR /var/www/html

# Ubah konfigurasi Apache agar mengarah ke folder public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Beri permission agar Laravel bisa menulis storage
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Aktifkan mod_rewrite (dibutuhkan oleh Laravel)
RUN a2enmod rewrite

# Tambahkan rule AllowOverride
RUN echo "<Directory /var/www/html/public>\n\
    AllowOverride All\n\
</Directory>" > /etc/apache2/conf-available/laravel.conf && \
    a2enconf laravel

# Jalankan Apache
CMD ["apache2-foreground"]
