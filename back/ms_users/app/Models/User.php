<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; //Eloquent es quein se encarga de conectarse a la base de datos y representar las tablas como objetos

class User extends Model //User es un modelo que herda las funciones de Eloquent
{
    protected $table = "users"; //la tabla de la base de datos que representa este modelo se llama "users
    public $timestamps = false; // el laravel espera tablas con columnas de crated_at y updated_at, pero su la tabla no las contiene se necesita desactivarlo
    protected $hidden = ['password']; // sirve para ocultar campos sencibles cuando se convierte el modelo a JSON
}
