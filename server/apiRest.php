<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once '../vendor/autoload.php';
require_once 'funcPlaceApiRest.php';
require_once 'funcVehicleApiRest.php';
require_once 'funcParkApiRest.php';


    $app = new \Slim\App;

    //CONFIGURACION DE CORS PARA LA API
    $app->add(function($req, $res, $next){
        $response = $next($req, $res);
        return $response
                ->withHeader('Access-Control-Allow-Origin','*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type. Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Content-Type','application/json; charset=utf-8');
    });

    $app->get('/place',funcPlaceApiRest::BringThemAll($req, $resp));
    $app->get('/place?onlyinuse=true',funcPlaceApiRest::BringThemAllByFilter($req, $resp));
    $app->get('/place/:id',funcPlaceApiRest::BringOneById($req, $resp));
    $app->put('/place/:id',funcPlaceApiRest::ModifyOneById($req, $resp));
    $app->post('/place',funcPlaceApiRest::AddNew($req, $resp));
    $app->delete('/place/:id',funcPlaceApiRest::SetOneDeleteById($req, $resp));
    
    $app->get('/vehicle',funcVehicleApiRest::BringThemAll($req, $resp));
    $app->get('/vehicle/:id',funcVehicleApiRest::BringOneById($req, $resp));
    $app->put('/vehicle/:id',funcVehicleApiRest::ModifyOneById($req, $resp));
    $app->post('/vehicle',funcVehicleApiRest::AddNew($req, $resp));

    $app->get('/park',funcParkApiRest::BringThemAll($req, $resp));
    $app->get('/park?active=true',funcParkApiRest::BringThemAllByFilter($req, $resp));
    $app->post('/park',funcParkApiRest::AddNew($req, $resp));
    $app->put('/park/:id',funcParkApiRest::ModifyOneById($req, $resp));


?>