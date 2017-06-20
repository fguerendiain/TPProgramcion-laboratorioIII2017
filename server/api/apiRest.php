<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once '../../vendor/autoload.php';
    require_once '../entities/funcPlaceApiRest.php';
    require_once '../entities/funcVehicleApiRest.php';
    require_once '../entities/funcParkApiRest.php';

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(["settings" => $config]);

    //CONFIGURACION DE CORS PARA LA API
    $app->add(function($request, $response, $next){
        $response = $next($request, $response);
        return $response
                ->withHeader('Access-Control-Allow-Origin','*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type. Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Content-Type','application/json; charset=utf-8');
    });

 
    $app->group('/place', function () {
        $this->get('/', \funcPlaceApiRest::class . ':BringThemAllPlace');
        $this->get('/?onlyinuse=true', \funcPlaceApiRest::class . ':BringThemAllByFilterPlace');
        $this->get('/id', \funcPlaceApiRest::class . ':BringOneByIdPlace');
        $this->put('/id', \funcPlaceApiRest::class . ':ModifyOneByIdPlace');
        $this->post('/', \funcPlaceApiRest::class . ':AddNewPlace');
        $this->delete('/id', \funcPlaceApiRest::class . ':SetOneDeleteByIdPlace');
    });

    $app->group('/vehicle', function () {
        $this->get('/', \funcVehicleApiRest::class . ':BringThemAllVehicle');
        $this->get('/id', \funcVehicleApiRest::class . ':BringOneByIdVehicle');
        $this->put('/id', \funcVehicleApiRest::class . ':ModifyOneByIdVehicle');
        $this->post('/', \funcVehicleApiRest::class . ':AddNewVehicle');
    });

    $app->group('/park', function () {
        $this->get('/', \funcParkApiRest::class . ':BringThemAllPark');
        $this->get('/?active=true', \funcParkApiRest::class . ':BringThemAllByFilterPark');
        $this->post('/', \funcParkApiRest::class . ':AddNewPark');
        $this->put('/id', \funcParkApiRest::class . ':ModifyOneByIdPark');
    });

    $app->run();
    /*->add(Midelware)*/

?>