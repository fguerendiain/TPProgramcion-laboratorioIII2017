<?php
/*****************************************/
/*                  PLACE                */
/*****************************************/

    require_once 'class/place.php';

class funcPlaceApiRest{

     public static function BringThemAllPlace($req, $resp){
        $resp->getBody()->write(Place::VehiculosEnPlaya());
        return $resp;
    }

    function BringThemAllByFilterPlace($req, $resp){
        $filter = $req->getQueryParam('onlyinuse');
        $resp->getBody()->write();
        return $resp;
    }

    function BringOneByIdPlace($req, $resp){
        $filter = $req->getQueryParam('id');
        $resp->getBody()->write(Place::InfoSalidaVehiculo($filter));
        return $resp;
    }

    function ModifyOneByIdPlace($req, $resp){
        $filter = $req->getAttribute('filter');
        $resp->getBody()->write();
        return $resp;
    }

    function AddNewPlace($req, $resp){
        $respArray = array();
        $respArray->push($req->getAttribute());
        $respArray->push($req->getAttribute());
        $respArray->push($req->getAttribute());
        $respArray->push($req->getAttribute());
        $resp->getBody()->write();
        return $resp;
    }

    function SetOneDeleteByIdPlace($req, $resp){
        $filter = $req->getAttribute('filter');
        $resp->getBody()->write();
        return $resp;
    }

}
?>