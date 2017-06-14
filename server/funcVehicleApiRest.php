<?php
/*******************************************/
/*                  VEHICLE                */
/*******************************************/
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once '../vendor/autoload.php';
    require_once 'class/vehicle.php';

    function BringThemAll($req, $resp){

    }

    function BringOneById($req, $resp){

    }

    function ModifyOneById($req, $resp){

    }

    function AddNew($req, $resp){

    }

/*

$app->get('/vehicle',funcVehicleApiRest::BringThemAll($req, $resp));
Trae todos los vehiculos


$app->get('/vehicle/:id',funcVehicleApiRest::BringOneById($req, $resp));
Trae el vehículo con id ":id"


$app->put('/vehicle/:id',funcVehicleApiRest::ModifyOneById($req, $resp));
Recibe por el cuerpo del mensaje un vehículo y lo utiliza
para actualizar el vehículo con id ":id"


$app->post('/vehicle',funcVehicleApiRest::AddNew($req, $resp));
Recibe por el cuerpo del mensaje un vehículo y lo crea
en el sistema.

*/
?>