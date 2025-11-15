<?php

use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {
    $app->options('/{routes:.+}', fn($req, $res) => $res); //responder automaticamente a las peticiones que hace el navegador antes de enviar una petición real 

    $app->add(function (Request $request, $handler) {
        $origin = $request->getHeaderLine('Origin') ?: '*';
        $response = $handler->handle($request);
        $response = $response
            ->withHeader('Access-Control-Allow-Origin', $origin) // permite que ese dominio acceda (o todos si es*)
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization') //define qué cabeceras puede enviar el cliente
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS') //mÉTODOS http permitidos
            ->withHeader('Access-Control-Allow-Credentials', 'true'); // permite enviar cookies o tokens

        if ($request->getMethod() === 'OPTIONS') {
            return $response->withStatus(200);
        }

        return $response;
    });
};
