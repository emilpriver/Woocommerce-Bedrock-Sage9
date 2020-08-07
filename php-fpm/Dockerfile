# Pull image from DockerHub
FROM php:7.3.6-fpm-alpine3.9

# Copy PHP settings
COPY /config/php.ini-production /usr/local/etc/php/conf.d/php.ini

# Install GD
RUN apk add --update --no-cache freetype freetype-dev libpng libpng-dev libjpeg-turbo libjpeg-turbo-dev zlib-dev \
    && docker-php-ext-configure gd \
        --with-gd \
        --with-freetype-dir=/usr/include/ \
        --with-png-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
    && NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
    && docker-php-ext-install -j${NPROC} gd \
    && apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev

# Install ZIP
RUN apk add --update --no-cache libzip-dev \
    && docker-php-ext-configure zip --with-libzip=/usr/include \
    && docker-php-ext-install zip

# Install APCu and Redis
RUN apk add --update --no-cache \
    $PHPIZE_DEPS \
    && pecl install apcu redis \
    && docker-php-ext-enable apcu redis

# Install MySQLi, Exif, Sockets, OPcache and BC Math
RUN docker-php-ext-install mysqli exif sockets opcache bcmath