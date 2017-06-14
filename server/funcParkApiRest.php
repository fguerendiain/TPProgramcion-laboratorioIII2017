<?php
/****************************************/
/*                  PARK                */
/****************************************/
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once '../vendor/autoload.php';
    require_once 'class/park.php';


    function BringThemAll($req, $resp){

    }

    function BringThemAllByFilter($req, $resp){

    }

    function AddNew($req, $resp){

    }

    function ModifyOneById($req, $resp){

    }

/*

$app->get('/park',funcParkApiRest::BringThemAll($req, $resp));
Trae todas las instancias de estacionado


$app->get('/park?active=true',funcParkApiRest::BringThemAllByFilter($req, $resp));
Trae todas las instancias de estacionado que no
tengan fecha de salida.


$app->post('/park',funcParkApiRest::AddNew($req, $resp));
Recibe por el cuerpo del mensaje la referencia a una
cochera y todos los datos de un vehículo. Con esta
información crea una instancia de estacionado agregando
la fecha y hora actual como hora de entrada. Si el
vehículo referenciado en los datos enviados no existe
en el sistema, entonces es creado con estos.


$app->put('/park/:id',funcParkApiRest::ModifyOneById($req, $resp));
Si no se recibe nada por cuerpo agrega a la instancia de
estacionado con id ":id" la fecha de salida. Además calcula
el precio a pagar por esta instancia y lo persiste
en el sistema. Devuelve la instancia de estacionado editada
que debe incluir de una u otra forma el precio calculado.

*/
?>