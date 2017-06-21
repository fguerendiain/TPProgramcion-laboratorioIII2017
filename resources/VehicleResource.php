<?php
/*****************************************/
/*                  VEHICLE              */
/*****************************************/

    require_once dirname(__FILE__)."/../dal/VehicleDal.php";

    class VehicleResource{

        public static function find($req, $resp){
            $vehicles = VehicleDal::findAll();
            return $resp->getBody()->write(json_encode($vehicles));
        }

        public static function get($req, $resp){
            $id = $req->getAttribute("id");
            $vehicle = VehicleDal::get($id);
            if ($vehicle==NULL){
                return $resp->withStatus(404);
            }else{
                return $resp->getBody()->write(json_encode($vehicle));
            }
        }
    }

?>