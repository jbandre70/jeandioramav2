ARG PHP_VERSION
FROM php:$PHP_VERSION

RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
    libwebp-dev \
     libzip-dev \
             && docker-php-ext-install zip \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
	&& docker-php-ext-install -j$(nproc) gd
RUN apt-get install -y libicu-dev
RUN docker-php-ext-install intl
RUN docker-php-ext-configure intl
RUN apt-get install curl \
    bash
RUN apt-get update && apt-get install -y libmemcached-dev libssl-dev zlib1g-dev \
	&& pecl install memcached-3.2.0 \
	&& docker-php-ext-enable memcached

WORKDIR /var/www
