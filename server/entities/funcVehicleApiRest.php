<?php
/*******************************************/
/*                  VEHICLE                */
/*******************************************/

    require_once 'class/vehicle.php';

    class funcVehicleApiRest{

        public static function BringThemAllVehicle($req, $resp){
            $resp->getBody()->write(Vehicle::BringVehicles());
            return $resp;
        }

        public static function BringOneByIdVehicle($req, $resp){
            $filter = $req->getQueryParam('id');
            $resp->getBody()->write(Vehicle::InfoSalidaVehiculo($filter));
            return $resp;
        }

        public static function ModifyOneByIdVehicle($req, $resp){
            $filter = $req->getAttribute('filter');
            $resp->getBody()->write(/*funcionDeClase($filter)*/);
            return $resp;
        }

        public static function AddNewVehicle($req, $resp){
            $respArray = array();
            $respArray->push($req->getAttribute(/*'atributo'*/));
            $respArray->push($req->getAttribute(/*'atributo'*/));
            $respArray->push($req->getAttribute(/*'atributo'*/));
            $respArray->push($req->getAttribute(/*'atributo'*/));
            $resp->getBody()->write(/*funcionDeClase($respArray)*/);
            return $resp;
        }

    }

?>