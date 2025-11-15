<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',             //la base de datos usa MySQL
    'host'      => '127.0.0.1',         //direccion de la base de datos (donde vive)
    'database'  => 'micro_s',           //nombre de la base de datos
    'username'  => 'root',              //usuario que entra a la base de datos
    'password'  => 'Ana1076650648',     // contraseña de usuario
    'charset'   => 'utf8',              //que tipo de letras puedde usar 
    'collation' => 'utf8_unicode_ci',   //forma específica de cómo comparar letras (mayúsculas/minúsculas...)
    'prefix'    => '',                  //si se quiere agregar un prefijo a los nombres de las tablas
]);

$capsule->setAsGlobal(); //hace que toda la aplicación pueda usar la conexión sin tener que crear otra
$capsule->bootEloquent();//se enciende Eloquent

//ELOQUEN es quien traduce las órdenes que tú escribes en PHP y MySQL
