<?php
    
    require_once 'DataBaseMan.php';

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


//

/*
     function IngresoVehiculo($vehiculo){

     }
*/
?>