<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
/*TENGO QUE DEFINIR SI VOY A INCLUIR CLASES ESPECIFICAS CON LOS METODOS NECESARIOS
PARA REALIZAR LAS QUERYS O DIRECTAMENTE ASIGNE DISTINTAS RUTAS*/

    $app = new \Slim\App;

    
    $app->get('/hello/{name}', function (Request $request, Response $response) {
        $name = $request->getAttribute('name');
        $response->getBody()->write("Hello, $name");

        return $response;
    });
    
    
    
    
    $app->run();

?>