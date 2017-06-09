<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require 'funcDashboard.php';


    $app = new \Slim\App;

    //CONFIGURACION DE CORS PARA LA API
    $app->add(function($req, $res, $next){
        $response = $next($req, $res);
        return $response
                ->withHeader('Access-Control-Allow-Origin','*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type. Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS');
    });

    $app->get('/dashboard/fechahoraactual', function (Request $request, Response $response) {
        $response->getBody()->write(date("Ymdhi"));
        return $response;
    });

    //Traer listado de ptentes de vehiculos en playa y su n° de cochera
    $app->get('/dashboard/vehiculosenplaya', function (Request $request, Response $response) {
        $response->getBody()->write(VehiculosEnPlaya());
        return $response;
    });


    //Traer informacion necesaria para completar los campos de salida de vehiculo
    $app->get('/dashboard/infosalidavehiculo', function (Request $request, Response $response) {
        $id = $request->getQueryParam('id');
        $response->getBody()->write(InfoSalidaVehiculo($id));
        return $response;
    });

    //Agregar datos de vehiculo ingresado a la base como nuevo movimiento
    $app->post('/dashboard/ingresovehiculo', function (Request $request, Response $response) {
        $vehiculo = array();
        $vehiculo->push($request->getAttribute('patente'));     //    patente VARCHAR(15),
        $vehiculo->push($request->getAttribute('marca'));       //    marca VARCHAR(20),
        $vehiculo->push($request->getAttribute('user'));         //    idusuario INT,
        $vehiculo->push($request->getAttribute('cochera'));     //    idcochera INT,
        $vehiculo->push(date("Ymdhis"));                        //    ingresofechahora DATE,

        $response->getBody()->write(IngresoVehiculo($vehiculo));

        return $response;
    });

    //elimina datos de vehiculo de la base
    $app->get('/dashboard/salidavehiculo', function (Request $request, Response $response) {
        $name = $request->getAttribute('name');
        $response->getBody()->write("Hello, $name");

        return $response;
    });
   
    
    
    $app->run();

?>