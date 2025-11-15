<?php

namespace App\Controllers;  // este archivo vive en  la carpeta App/controllers, asi podra ser usado

use App\Models\User; //modelo que sabe hablar con la base de datos de usuarios
use Exception; //sirve para lanzar errores si algo sale mal 

class UsersController //contiene las acciones o funciones que puede realizar 
{

    public function login($username, $password)  //esta funcion sirve para ver si un usuario existe en la base de datos y si su nombre y contraseña son crorrectos
    {
        //busca al usuario y si lo encuentra lo va a guardar en $row
        $row = User::where('userName', $username)
            ->where('password', $password)
            ->first();
        if (empty($row)) { //si no se encuentra ningun usuario lanza la exepcion con su respectivo mensaje de error
            throw new Exception("User null", 1);
        }
        return $row->toJson(); //si lo encuentra lo devuleve el Json (texto legible para el navegador o el frontend)
    }

    public function getUsers()
    {
        //sirve para obtener la lista de todos los usuarios de la base de datos
        $rows = User::all();
        if (count($rows) == 0) {
            return null; // si no hay nada retorna nulo
        }
        return $rows->toJson(); // devuleve la lista completa
    }
}
