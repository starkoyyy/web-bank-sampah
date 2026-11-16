# Base image resmi PHP 8.2 dengan Apache
FROM php:8.2-apache

# Tentukan direktori kerja di dalam container
WORKDIR /var/www/html

# 1. Install dependensi sistem Linux dan ekstensi PHP yang diperlukan Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Aktifkan modul Apache (rewrite untuk routing Laravel dan headers untuk keamanan)
RUN a2enmod rewrite headers

# 3. Ubah Apache DocumentRoot ke folder /public Laravel (Penting untuk keamanan)
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Ambil binary Composer resmi
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 5. Salin kode aplikasi ke dalam container
COPY . /var/www/html

# 6. Install dependensi composer untuk mode produksi (tanpa dev package)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 7. Konfigurasi izin hak akses file (storage & cache) untuk user web server (www-data)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Buka port 80 untuk lalu lintas web HTTP
EXPOSE 80

# 9. Jalankan optimasi Laravel dan hidupkan Apache saat container berjalan
CMD ["/bin/sh", "-c", "php artisan config:clear && php artisan route:cache && php artisan view:cache && apache2-foreground"]
