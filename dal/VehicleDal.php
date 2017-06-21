<?php
    require_once dirname(__FILE__)."/../libs/DalTools.php";

    class VehicleDal{

        public static function findAll(){
            $query = "select id,license,alien,colour,model,brand from vehicle where deleted = false";
            $vehicles = DalTools::query($query,null);
            return $vehicles;
        }

        public static function get($id){
            $query = "select id,license,alien,colour,model,brand from vehicle where id = ? and deleted = false";
            $params = [$id];
            $vehicle = DalTools::queryForOne($query,$params);
            return $vehicle;
        }

    }
?>