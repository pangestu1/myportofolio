#!/bin/sh

# Jalankan PHP-FPM di background
php-fpm &

# Jalankan Nginx di foreground (ini adalah proses utama container)
nginx -g 'daemon off;'