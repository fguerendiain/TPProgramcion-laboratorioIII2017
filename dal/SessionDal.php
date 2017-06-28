<?php
    require_once dirname(__FILE__)."/../libs/DalTools.php";
    require_once dirname(__FILE__)."/../libs/JWTHandler.php";

    class SessionDal{

        public static function create($existingUser, $intime){

            $token = JWTHandler::createJWTToken($existingUser);
            $query = "insert into session (token, owner, intime) values (?,?,?)";
            $params = [$token, $existingUser['id'], $intime];
            $createdSessionId = DalTools::query($query,$params);
            return SessionDal::get($createdSessionId);
        }

        public static function get($id){
            $query = "select id,token,owner,intime from session where id = ? and deleted = false";
            $params = [$id];
            $session = DalTools::queryForOne($query,$params);
            return $session;
        }


        public static function getIdByToken($token){
            $query = "select id,token,owner,intime from session where token = ? and deleted = false";
            $params = [$token];
            $session = DalTools::queryForOne($query,$params);
            return $session;
        }
    }
?>

