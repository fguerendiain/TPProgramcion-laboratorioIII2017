<?php
    require_once dirname(__FILE__)."/../libs/DalTools.php";
    require_once dirname(__FILE__)."/../libs/JWTHandler.php";

    class SessionDal{

        public static function create($existingUser, $intime){

            $token = JWTHandler::createJWTToken($existingUser, $intime);
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


        public static function Update($token){
            $config = json_decode(file_get_contents(dirname(__FILE__)."/../config.json"));
            $timeOut = $config->time->sessionExpireTimeOut;
            $elapsedTime = time();
            
            $session = JWTHandler::verifyJWTToken($token);
            if($session !== NULL){
                $query = "select id,token,owner,intime from session where token = ? and deleted = false";
                $params = [$token];
                $validSession = DalTools::queryForOne($query,$params);
                if($validSession !== NULL){
                    $sessionInTime = $validSession['intime'];
                    $sessionId = $validSession['id'];
                    $elapsedTime-=$sessionInTime;
                    if($elapsedTime > $timeOut){
                        $query = "update session set deleted = true where id = ?";
                        $params = [$sessionId];
                        DalTools::queryForOne($query,$params);
                        return true;
                    }else{
                        return $validSession;
                    }
                }
            }
            return NULL;
        }
    }
?>

