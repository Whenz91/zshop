# PHP alapú Laravel környezethez
FROM php:8.1-fpm

# Munkakönyvtár beállítása
WORKDIR /var/www

# Szükséges kiterjesztések telepítése
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim unzip git curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Composer telepítése
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Laravel dependenciák telepítése
COPY . /var/www
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install

# Jogosultságok beállítása
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www

# Nginx vagy egyéb webszerver futtatásához
EXPOSE 9000
CMD ["php-fpm"]
