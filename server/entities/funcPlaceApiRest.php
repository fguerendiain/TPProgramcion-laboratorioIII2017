<?php
/*****************************************/
/*                  PLACE                */
/*****************************************/

    require_once '../../vendor/autoload.php';
    require_once 'class/place.php';


    function BringThemAllPlace($req, $resp){
        $resp->getBody()->write(VehiculosEnPlaya());
        return $resp;
    }

    function BringThemAllByFilterPlace($req, $resp){
        $filter = $req->getQueryParam('filter');
        $resp->getBody()->write(/*funcionDeClase($filter)*/);
        return $resp;
    }

    function BringOneByIdPlace($req, $resp){
        $filter = $req->getQueryParam('filter');
        $resp->getBody()->write(/*funcionDeClase($filter)*/);
        return $resp;
    }

    function ModifyOneByIdPlace($req, $resp){
        $filter = $req->getAttribute('filter');
        $resp->getBody()->write(/*funcionDeClase($filter)*/);
        return $resp;
    }

    function AddNewPlace($req, $resp){
        $respArray = array();
        $respArray->push($req->getAttribute(/*'atributo'*/));
        $respArray->push($req->getAttribute(/*'atributo'*/));
        $respArray->push($req->getAttribute(/*'atributo'*/));
        $respArray->push($req->getAttribute(/*'atributo'*/));
        $resp->getBody()->write(/*funcionDeClase($respArray)*/);
        return $resp;
    }

    function SetOneDeleteByIdPlace($req, $resp){
        $filter = $req->getAttribute('filter');
        $resp->getBody()->write(/*funcionDeClase($filter)*/);
        return $resp;
    }



/*

$app->get('/place',BringThemAll);
Trae todas las cocheras que no estén marcadas como borradas


$app->get('/place?onlyinuse=true',BringThemAllByFilter);
Trae todas las cocheras que en este momento tengan
un vehículo estacionado y que no estén marcadas como borradas.


$app->get('/place/:id',BringOneById);
Trae la chochera con id o número ":id"


$app->put('/place/:id',ModifyOneById);
Recibe por el cuerpo del mensaje los datos de la cochera
que son los que van a ser modificados en la cochera con
id o número ":id"


$app->post('/place',AddNew);
Recibe por el cuerpo del mensaje los datos de una cochera
para crear con estos una nueva cochera. Devuelve la cochera
creada.


$app->delete('/place/:id',SetOneDeleteById);
Marca como borrada la cochera con id ":id"

*/

?>