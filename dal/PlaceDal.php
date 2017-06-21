<?php
    require_once dirname(__FILE__)."/../libs/DalTools.php";

    class PlaceDal{

        public static function findAll($active=NULL){
            $query = "select id,name,floor,handicap from place where deleted = false";

            if ($active !== NULL){
                $query.= " and active = ";
                if ($active){
                    $query.="true";
                }else{
                    $query.="false";
                }
            }

            $places = DalTools::query($query,null);
            return $places;
        }

        public static function create($name, $floor){
            $query = "insert into place (name, floor) values (?,?)";
            $params = [$name, $floor];
            $createdPlaceId = DalTools::query($query,$params);
            return PlaceDal::get($createdPlaceId);
        }

        public static function get($id){
            $query = "select id,name,floor,handicap,active from place where id = ? and deleted = false";
            $params = [$id];
            $place = DalTools::queryForOne($query,$params);
            return $place;
        }

        public static function delete($id){
            $query = "update place set deleted = true where id = ?";
            $params = [$id];
            DalTools::query($query,$params);
            return;
        }

        public static function update($id, $name, $floor, $handicap, $active){
            $query = "update place set name = ?, floor = ?, handicap = ?, active = ? where id = ?";
            $params = [$name, $floor, $handicap, $active, $id];
            DalTools::query($query, $params);
            return PlaceDal::get($id);
        }
    }
?>