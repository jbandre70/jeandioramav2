ARG PHP_VERSION
FROM php:$PHP_VERSION-cli

RUN apt-get update && apt-get install -y curl && apt-get clean -y
RUN docker-php-ext-install mysqli \
    && curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp