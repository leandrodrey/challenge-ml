FROM php:8.0.5
RUN apt-get update -y && apt-get install -y openssl zip unzip git libonig-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
COPY . /app

RUN composer install
RUN chmod +x artisan
RUN composer dump-autoload --optimize
RUN php artisan key:generate

RUN php artisan test

ENTRYPOINT php artisan serve --host=0.0.0.0
