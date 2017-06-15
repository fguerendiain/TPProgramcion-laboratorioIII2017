<?php
/*******************************************/
/*                  VEHICLE                */
/*******************************************/

    require_once './vendor/autoload.php';
    require_once './server/entities/class/vehicle.php';

    function BringThemAll($req, $resp){
        $resp->getBody()->write(/*funcionDeClase()*/);
        return $resp;
    }

    function BringOneById($req, $resp){
        $filter = $req->getQueryParam('filter');
        $resp->getBody()->write(/*funcionDeClase($filter)*/);
        return $resp;
    }

    function ModifyOneById($req, $resp){
        $filter = $req->getAttribute('filter');
        $resp->getBody()->write(/*funcionDeClase($filter)*/);
        return $resp;
    }

    function AddNew($req, $resp){
        $respArray = array();
        $respArray->push($req->getAttribute(/*'atributo'*/));
        $respArray->push($req->getAttribute(/*'atributo'*/));
        $respArray->push($req->getAttribute(/*'atributo'*/));
        $respArray->push($req->getAttribute(/*'atributo'*/));
        $resp->getBody()->write(/*funcionDeClase($respArray)*/);
        return $resp;
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