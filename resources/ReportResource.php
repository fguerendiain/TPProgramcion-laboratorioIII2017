<?php
/*****************************************/
/*                  REPORT                */
/*****************************************/

    require_once dirname(__FILE__)."/../dal/ReportDal.php";

    class ReportResource{

        public static function reportUserLogin($req, $resp){
            $id = $req->getAttribute("id");
            $usersLogin = ReportDal::reportUserLogin($id);
            return $resp->getBody()->write(json_encode($usersLogin));
        } 


        public static function reportUserOperations($req, $resp){
            $id = $req->getAttribute("id");
            $usersLogin = ReportDal::reportUserOperations($id);
            return $resp->getBody()->write(json_encode($usersLogin));
        } 


        public static function reportPlaceUse($req, $resp){
            $placeMaxLessAndNever = ReportDal::reportPlaceUse();
            return $resp->getBody()->write(json_encode($placeMaxLessAndNever));
        } 


        public static function reportParked($req, $resp){
            $parkedVehicles = ReportDal::reportParked();
            return $resp->getBody()->write(json_encode($parkedVehicles));
        } 
    }
?>