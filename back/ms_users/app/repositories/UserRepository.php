<?php
namespace App\Repositories;

use App\Controllers\UsersController; // se necesita acceder al UserController para acceder a la lógica de los usuarios
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserRepository
{
// diccionario de errores sirve para traducir los códigos de error que lanza el controlador (Execption) a códigos HTTP reales
    private $codesError = [
        1 => 401,
        'default' => 400
    ];

    public function login(Request $request, Response $response) //Este método se activa cuando el cliente hace un POST/login (según lo que este en el router)
    {
        try {
            $body = $request->getBody()->getContents();
            $data = json_decode($body, true);// se toma el JSON que envía el cliente 
            //ejemplo { "user": "Ana", "pwd": "1234" } y se convierte en un arreglo PHP que se pueda usar
            $controller = new UsersController();
            $user = $controller->login($data['user'], $data['pwd']); //Se llama al controlador y es quien valida si el usuario existe en la base de datos
            $response
                ->withHeader('Content-Type', 'application/json')
                ->getBody()
                ->write($user);
            return $response; // devolver respuesta al cliente, será en formato JSON 
            // y luego escribe el contenido del usuario encontrado (ya viene convertido en JSON desde el modelo)
        } catch (Exception $ex) {
            $status =  $this->codesError[$ex->getCode()] ?? $this->codesError['default'];
            return $response->withStatus($status); //manejo de errores
        }
    }

    public function queryAllUsers(Request $request, Response $response){ // se ejecuta cuenado se hace una petición GET/users
        try {
            $controller = new UsersController(); // crea un controlador de ususarios
            $users = $controller->getUsers(); // llama al método que obtiene todos los registros
            if(empty($users)){
                return $response->withStatus(204);
            }
            $response
                ->withHeader('Content-Type', 'application/json')
                ->getBody()
                ->write($users);
            return $response;
        } catch (Exception $ex) {
            $status =  $this->codesError[$ex->getCode()] ?? $this->codesError['default'];
            return $response->withStatus($status);
        }
    }

}
