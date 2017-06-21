<?php
    require_once dirname(__FILE__)."/../libs/DalTools.php";

    class SessionDal{

        public static function create($token, $owner, $intime){
            $query = "insert into session (token, owner, intime) values (?,?,?)";
            $params = [$token, $owner, $intime];
            $createdSessionId = DalTools::query($query,$params);
            return SessionDal::get($createdSessionId);
        }

        public static function get($id){
            $query = "select id,token,owner,intime from session where id = ? and deleted = false";
            $params = [$id];
            $session = DalTools::queryForOne($query,$params);
            return $session;
        }

    }
?>