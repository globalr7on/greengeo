FROM php:8.0-fpm
WORKDIR /var/www
RUN docker-php-ext-install bcmath
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    --no-install-recommends \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql -j$(nproc) gd
ADD . /var/www
RUN chown -R www-data:www-data /var/www
