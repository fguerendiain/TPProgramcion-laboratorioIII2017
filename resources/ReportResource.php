<?php
/*****************************************/
/*                  REPORT                */
/*****************************************/

    require_once dirname(__FILE__)."/../dal/ReportDal.php";

    class ReportResource{

        public static function reportUserLogin($req, $resp){
            $id = $req->getAttribute("id");
            $usersLogin = ReportDal::reportUserLogin($id);
            if($usersLogin == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($usersLogin));
            }
            return $resp->withStatus(404); //no encontrado
        } 


        public static function reportUserOperations($req, $resp){
            $id = $req->getAttribute("id");
            $usersOperations = ReportDal::reportUserOperations($id);
            if($usersOperations == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($usersOperations));
            }
            return $resp->withStatus(404); //no encontrado
        } 


        public static function reportPlaceUse($req, $resp){
            $placeMaxLessAndNever = ReportDal::reportPlaceUse();
            if($placeMaxLessAndNever == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($placeMaxLessAndNever));
            }
            return $resp->withStatus(404); //no encontrado
        } 


        public static function reportParked($req, $resp){
            $parkedVehicles = ReportDal::reportParked();
            if($parkedVehicles == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($parkedVehicles));
            }
            return $resp->withStatus(404); //no encontrado
            
        } 
    }
?>