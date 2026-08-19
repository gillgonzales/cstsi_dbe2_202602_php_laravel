FROM php:8.5.9-alpine3.24

ENV TERM=xterm
RUN apk update && apk add --no-cache \
    libpq-dev \
    bash \
    curl \
    vim \
    unzip

RUN docker-php-ext-install pdo_mysql pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html

COPY . .

EXPOSE $APP_PORT 