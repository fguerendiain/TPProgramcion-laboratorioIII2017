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
            $query = "select p.id, u.username, p.intime, p.outtime, p.price, p.vehicle from parking p left join users u on p.inuser = u.id or p.outuser = u.id where p.inuser = ? or p.outuser = ? and u.id = ? and u.deleted=false order by p.intime asc, p.outtime asc;";
            $params=[$id,$id,$id];
            $usersOperations = DalTools::query($query,$params);
            return $usersOperations;
        } 


        public static function reportPlaceUse(){
            $query ="select places.place, max(places.used) maxused from(select p.place, count(*) used from parking p left join place pl on p.place = pl.id where pl.deleted = false and pl.active = true group by p.place) places;";
            $placeMaxUse = DalTools::query($query,$params);

            $query ="select places.place, min(places.used) minused from(select p.place, count(*) used from parking p left join place pl on p.place = pl.id where pl.deleted = false and pl.active = true group by p.place) places;";
            $PlaceMinUse = DalTools::query($query,$params);

            $query =;
            $PlaceNeverUse = DalTools::query($query,$params);

            return array($placeMaxUse, $PlaceMinUse, $PlaceNeverUse);
        } 


        public static function reportParked(){

        } 

    }

?>
