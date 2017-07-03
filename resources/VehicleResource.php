<?php
/*****************************************/
/*                  VEHICLE              */
/*****************************************/

    require_once dirname(__FILE__)."/../dal/VehicleDal.php";

    class VehicleResource{

        public static function find($req, $resp){
            $vehicles = VehicleDal::findAll();
            if ($vehicles==NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($vehicles));
            }
            return $resp->withStatus(404); //no encontrado
        }

        public static function get($req, $resp){
            $id = $req->getAttribute("id");
            $vehicle = VehicleDal::get($id);
            if ($vehicle==NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($vehicle));
            }
            return $resp->withStatus(404); //no encontrado
        }
    }

?>