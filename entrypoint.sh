#!/bin/bash
echo "CARGANDO CONFIGURACIONES..."
sleep 20s
mysql -h mysql_db -uroot -proot -e "CREATE DATABASE laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
php artisan config:clear
php artisan migrate:install
php artisan migrate
php artisan serve --host=0.0.0.0
