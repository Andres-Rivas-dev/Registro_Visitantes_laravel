<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Descripción
Sistema Base con autenticación JWT.

## Consideraciones Previas

Versión de PHP: 8.1.10+

Abrir una terminal y ejecutar:

Ejecute **composer update**

**php artisan serve** 

Vaya a su navegador preferido (google Chrome, Firefox u otros) y escriba la siguiente dirección url:
**http://localhost:8000/**

Para el manejo de Json Web Token (JWT) es necesario tener en el archivo .env una variable llamada JWT_SECRET, para generarla hacer lo siguiente:
**php artisan jwt:secret**, 
Luego un:
**php artisan cache:clear**

Para actualizar los archivos necesarios para que swagger se ejecute es necesario correr los siguientes 2 comandos (esto cada vez hayan cambios en las api)

**php artisan swagger-lume:publish**

**php artisan swagger-lume:generate**

Para poder ver la documentación de swagger visitar la url siguiente:

**http://localhost:8000/api/documentation**


## Contributing

* Mario Andres Rivas Bonilla <marioandres.mx@gmail.com>


## License

Este proyecto Laravel esta bajo la licencia GNU General Public License v3.0.
