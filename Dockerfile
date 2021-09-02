FROM php:8.0.5
RUN apt-get update -y && apt-get install -y openssl zip unzip git libonig-dev mariadb-client
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions gd xdebug
RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /app
COPY . /app
COPY ./.env.docker /app/.env

RUN composer install
RUN chmod +x artisan
RUN composer dump-autoload --optimize
RUN php artisan key:generate

RUN php artisan test
RUN chmod +x entrypoint.sh
