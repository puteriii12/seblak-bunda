FROM php:8.2-apache

# 1. Instal ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# 2. Aktifkan Apache rewrite module untuk Laravel route
RUN a2enmod rewrite

# 3. Atur Document Root Apache ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 4. Salin file proyek ke dalam server
WORKDIR /var/www/html
COPY . .

# 5. Instal Composer
RUN curl -sS https://getcomposer.org | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# 6. Atur izin folder agar bisa menulis database sqlite
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# 7. Jalankan migrasi database otomatis saat server menyala
CMD php artisan migrate --force && apache2-foreground
