<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once '../../vendor/autoload.php';
require_once '../entities/funcPlaceApiRest.php';
require_once '../entities/funcVehicleApiRest.php';
require_once '../entities/funcParkApiRest.php';


    $app = new \Slim\App;

    //CONFIGURACION DE CORS PARA LA API
    $app->add(function($request, $response, $next){
        $response = $next($request, $response);
        return $response
                ->withHeader('Access-Control-Allow-Origin','*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type. Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Content-Type','application/json; charset=utf-8');
    });

    $app->get('/place',BringThemAllPlace);//($request, $response));
/*    $app->get('/place?onlyinuse=true',BringThemAllByFilterPlace);//($request, $response));
    $app->get('/place/:id',BringOneByIdPlace);//($request, $response));
    $app->put('/place/:id',ModifyOneByIdPlace);//($request, $response));
    $app->post('/place',AddNewPlace);//($request, $response));
    $app->delete('/place/:id',SetOneDeleteByIdPlace);//($request, $response));
    
    $app->get('/vehicle',BringThemAllVehicle);//($request, $response));
    $app->get('/vehicle/:id',BringOneByIdVehicle);//($request, $response));
    $app->put('/vehicle/:id',ModifyOneByIdVehicle);//($request, $response));
    $app->post('/vehicle',AddNewVehicle);//($request, $response));

    $app->get('/park',BringThemAllPark);//($request, $response));
    $app->get('/park?active=true',BringThemAllByFilterPark);//($request, $response));
    $app->post('/park',AddNewPark);//($request, $response));
    $app->put('/park/:id',ModifyOneByIdPark);//($request, $response));
*/

?>