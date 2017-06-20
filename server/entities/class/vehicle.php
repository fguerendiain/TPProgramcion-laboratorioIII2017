<?php
    class Vehicle{

        public static function BringVehicles(){
            $db = DataBaseMan::Connect();
            $datos = $db->Query(
                                "SELECT * FROM movimientos m 
                                LEFT JOIN cocheras c ON m.idcochera = c.id 
                                WHERE m.egresofechahora is null;");
            return json_encode($datos);
        }


        public static function InfoSalidaVehiculo($id){
            $db = DataBaseMan::Connect();
            $datos = $db->Query(
                                "SELECT *
                                FROM movimientos m
                                LEFT JOIN cocheras c ON m.idcochera = c.id
                                WHERE m.id = ".$id.";");
            return json_encode($datos);
        }
    }
?>