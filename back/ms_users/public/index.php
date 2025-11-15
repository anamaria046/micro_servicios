<?php

use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php'; // es el archivo que carga automaticamente todas las librerias instaladas con Composer
require __DIR__ . '/../app/Config/database.php'; //se está incluyendo el archivo de conexión a la base de datos 

//Dos archivos que devuelven funciones
$cors = require __DIR__.'/../app/Middleware/Cors.php'; //Se encarga de permitir que otros sistemas como el frontend pueda conectarse sin bloqueos
$endpoints = require __DIR__ . '/../app/Config/routers.php'; // donde se define que pasa cuando el cliente pide /login, /users...
// en este apartado solo se guardan como variables pero aun no se ejecutan

$app = AppFactory::create(); // se crea la instancia principal del microservicio, el objeto que servirá para 
/*
Registar rutas
Agregar Middleware
Finalmente correr la aplicación 
*/
$endpoints($app); // le dice el micro que rutas existen y que metodos debe ejecutar cuando alguien acceda a ellas
$cors($app); // agrega el middleware CORS para que el micro pueda recibir peticiones desde otros dominios 

$app->run(); // enciende el micro