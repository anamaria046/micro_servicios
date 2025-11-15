<?php
use App\Repositories\UserRepository; //es el encargado de hablar con la base de datos del usuario
use Psr\Http\Message\ResponseInterface as Response; //Peticion y respuesta
use Psr\Http\Message\ServerRequestInterface as Request; //Peticion y respuesta
use Slim\App; //motor del micro que maneja las rutas
use Slim\Routing\RouteCollectorProxy; // ayuda a agrupar varias rutas bajo un mismo "camino"

return function (App $app) {  //se le dicce al slim que se le va a devolver una función con todas las rutas de la app
    //bloque que sirve para comprobar de que el servidor funciona
    $app->get('/', function (Request $request, Response $response, $args) {
        $response->getBody()->write("Hello world!");
        return $response;
    });

    //actua como una segunda puerta donde esta ruta escucha peticiones POST (cuando alguien envía datos, como usuario y contraseña)
    $app->post('/login', [UserRepository::class, 'login']);

    //actua como tercera puerta  donde probablemente devuleva todos los usuarios registrados en la base de datos
    $app->group('/users', function (RouteCollectorProxy $group) {
        $group->get('/', [UserRepository::class, 'queryAllUsers']);
    });
};