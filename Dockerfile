# ... (kode sebelumnya)

# Salin file konfigurasi Nginx dan script start
COPY nginx.conf /etc/nginx/sites-available/default
COPY start.sh /start.sh

# --- TAMBAHKAN BARIS INI ---
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