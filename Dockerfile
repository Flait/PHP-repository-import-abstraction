FROM php:8.2-cli
WORKDIR /app
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
