<?php
/*****************************************/
/*                  PLACE                */
/*****************************************/
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once '../vendor/autoload.php';
    require_once 'class/place.php';


    function BringThemAll($req, $resp){
        
    }

    function BringThemAllByFilter($req, $resp){

    }

    function BringOneById($req, $resp){

    }

    function ModifyOneById($req, $resp){

    }

    function AddNew($req, $resp){

    }

    function SetOneDeleteById($req, $resp){

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