<?php
    
    require_once 'DataBaseMan.php';

    function VehiculosEnPlaya(){
        $db = DataBaseMan::Connect();
        $datos = $db->Query("SELECT * FROM movimientos");
            //"SELECT 'm.id', 'm.patente', 'c.numero' FROM movimientos m LEFT JOIN cochera c ON m.idcochera = c.id WHERE m.fechasalida = null");
        return $datos;
    }

    VehiculosEnPlaya();

/*
    function InfoSalidaVehiculo($id){
        $db = new DataBaseMan();
        $datos = $db->Query(
                            "SELECT 'm.id', 'm.patente', 'm.color', 'm.marca', 'm.ingresofechahora', 'c.numero', m.total 
                             FROM movimientos m 
                             LEFT JOIN cochera c ON m.idcochera = c.id 
                             WHERE m.id = ".$id.";"
                             );
        return json_encode($datos);
    }


     function IngresoVehiculo($vehiculo){
                



     }
*/
?>