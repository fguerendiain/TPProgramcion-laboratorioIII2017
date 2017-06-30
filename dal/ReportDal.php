<?php

    require_once dirname(__FILE__)."/../libs/DalTools.php";

    class ReportDal{

        public static function reportUserLogin($id){
            $query = "select s.id, u.username, s.intime from session s left join users u on s.owner = u.id where s.owner = ? and s.deleted=false and u.deleted=false order by s.intime asc;";
            $params=[$id];
            $usersLogin = DalTools::query($query,$params);
            return $usersLogin;
        } 


        public static function reportUserOperations($id){
            $query = "select p.id parkingid,p.inuser,p.outuser, u.username, p.intime, p.outtime, p.price, p.vehicle vehicleid,v.license, v.colour, v.model, v.brand from parking p left join users u on p.inuser = u.id or p.outuser = u.id left join vehicle v on p.vehicle = v.id where p.inuser = ? or p.outuser = ? and u.id = ? and u.deleted=false order by p.intime asc, p.outtime asc;";
            $params=[$id,$id,$id];
            $usersOperations = DalTools::query($query,$params);
            return $usersOperations;
        } 


        public static function reportPlaceUse(){
            $query ="select p.place, count(*) maxused from parking p left join place pl on p.place = pl.id where pl.deleted = false and pl.active = true group by p.place order by maxused desc limit 1;";
            $placeMaxUse = DalTools::query($query);

            $query ="select p.place, count(*) minused from parking p left join place pl on p.place = pl.id where pl.deleted = false and pl.active = true group by p.place order by minused asc limit 1;";
            $PlaceMinUse = DalTools::query($query);

            $query ="select pla.id neverusedplace from place pla where pla.id not in (select p.place places from parking p left join place pl on p.place = pl.id where pl.deleted = false and pl.active = true group by p.place) and pla.deleted = false and pla.active = true group by pla.id;";
            $PlaceNeverUse = DalTools::query($query);

            return array($placeMaxUse, $PlaceMinUse, $PlaceNeverUse);
        } 


        public static function reportParked(){
            $query ="select p.id parkingid, p.vehicle vehicleid, v.license, v.colour, v.model, v.brand, p.place placeid, pl.name placename, pl.floor, p.inuser userid, u.username, p.intime from parking p left join vehicle v on p.vehicle = v.id left join place pl on p.place = pl.id left join users u on p.inuser = u.id where p.outtime is null";
            $parkedVehicles = DalTools::query($query);
            return array($parkedVehicles);

        } 

    }

?>

