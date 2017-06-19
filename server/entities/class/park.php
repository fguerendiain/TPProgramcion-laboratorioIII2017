<?php

    require_once '../res/DataBaseMan.php';

    function VehiculosEnPlaya(){
        $db = DataBaseMan::Connect();
        $datos = $db->Query("SELECT m.id, m.patente, c.numero 
                             FROM movimientos m 
                             LEFT JOIN cocheras c ON m.idcochera = c.id 
                             WHERE m.egresofechahora is null;");
        return json_encode($datos);
    }


    function InfoSalidaVehiculo($id){
        $db = DataBaseMan::Connect();
        $datos = $db->Query(
                            "SELECT m.id, m.patente, m.color, m.marca, m.ingresofechahora, c.numero
                             FROM movimientos m
                             LEFT JOIN cocheras c ON m.idcochera = c.id
                             WHERE m.id = ".$id.";");
        return json_encode($datos);
    }


?>


<!--

    function BringThemAll($req, $resp){
        $resp->getBody()->write(/*funcionDeClase()*/);
        return $resp;
    }

    function BringThemAllByFilter($req, $resp){
        $filter = $req->getQueryParam('filter');
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

    function ModifyOneById($req, $resp){
        $filter = $req->getAttribute('filter');
        $resp->getBody()->write(/*funcionDeClase($filter)*/);
        return $resp;
    }

-->
