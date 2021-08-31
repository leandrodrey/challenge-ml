# Challenge MELI, Fuego de Quasar

# Construcción
El proyecto fue realizado utilizando PHP sobre el framework [Laravel](https://laravel.com/), también se utilizó [Composer](https://getcomposer.org/) y [MySQL](https://www.mysql.com/).

# Swagger Documentation
Se utilizó [Swagger](https://swagger.io/) con la librería [L5 Swagger](https://github.com/DarkaOnLine/L5-Swagger) para Laravel.
> http://localhost:8000/api/doc

# End Points

> [POST] localhost:8080/api/v1/topsecret

> [GET] localhost:8080/api/v2/topsecret_split

> [POST] localhost:8080/api/v2/topsecret_split/{satellite_name}

# Docker

* Generar el archivo ".env" renombrando o compilando el archivo ".env.example".

```bash
docker build . -t satellite
```

```bash
docker-compose up
```

```bash
docker-compose rup app
```

## Instalar

### Requerimientos
* PHP 8.0.6
* MySql 15 
* Composer

### Pasos
* Clonar el repositorio
```bash
git clone https://github.com/leandrodrey/challenge.git
```

* Entrar a la carpeta del proyecto y actualizar
```bash
cd challenge
```
```bash
composer update
```

* Generar el archivo ".env" renombrando o compilando el archivo ".env.example".

* Generar la key del proyecto.
```bash
php artisan key:generate
```
  
* Inicializar el server
```bash
php artisan serve
```
                                                                                           
# Problemas a resolver

## Recomponer el mensaje tal cual lo envió el Emisor del Mensaje
Dado el mensaje recibido por cada uno de los satélites, los cuales estaban incompletos y tenían un desfasaje, se debía retornar el mensaje original.

Para resolver este problema se tomó la premisa:
* El desfase del mensaje se originaba al principio del mismo.
 
### Resolución
1. Se obtienen los mensajes del post del endpoint **/api/v1/topsecret**.
2. Se cuentan los elementos de cada mensaje y se calcula el mínimo de elementos que se obtienen.
3. Tomando la premisa antes expuesta, se elimina el desfase de los mensajes según sea requerido. De esta forma todos los mensajes tendrán el mismo tamaño.
4. Se elimina de cada mensaje los elementos vacíos.
5. Se construye el mensaje utilizando los elementos obtenidos en los tres mensajes (y su posición).
6. Por último se ordena y se devuelve el mensaje reconstruido.


## Posición del Emisor del Mensaje
Dado el enunciado, sabiendo la localización de tres puntos (satélites) y la distancia del emisor del mensaje a cada satélite, 
se debía calcular la posición del cuarto punto (Emisor del Mensaje).
               
### Resolución

Para resolver este problema se utilizó el método [Trilateración](https://es.wikipedia.org/wiki/Trilateraci%C3%B3n) basado en https://www.101computing.net/cell-phone-trilateration-algorithm. También se utilizó [Desmos](https://www.desmos.com/calculator/vdy4hafwyb?lang=es) para comprobar la resolución.
