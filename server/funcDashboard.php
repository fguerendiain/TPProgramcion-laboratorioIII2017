<?php
    
require 'DataBaseMan.php';

    function VehiculosEnPlaya()
    {
        $db = new DataBaseMan();
        $datos = $db->query(
                            "SELECT 'm.id', 'm.patente', 'c.numero' 
                             FROM movimientos m 
                             LEFT JOIN cochera c ON m.idcochera = c.id 
                             WHERE m.fechasalida = null;"
                             );
        return json_encode($datos);

    }


    function InfoSalidaVehiculo($id){
        $db = new DataBaseMan();
        $datos = $db->query(
                            "SELECT 'm.id', 'm.patente', 'm.color', 'm.marca', 'm.ingresofechahora', 'c.numero', m.total 
                             FROM movimientos m 
                             LEFT JOIN cochera c ON m.idcochera = c.id 
                             WHERE m.id = ".$id.";"
                             );
        return json_encode($datos);
    }



     function IngresoVehiculo($vehiculo){
                



     }
?>