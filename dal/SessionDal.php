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
            $query = "select s.id sessionis, s.token, s.owner, u.username, s.intime from session s left join users u on s.owner = u.id where s.id = ? and s.deleted = false";
            $params = [$id];
            $session = DalTools::queryForOne($query,$params);
            return $session;
        }

        public static function getByToken($token){
            $query = "select s.id sessionis, s.token, s.owner, u.username, s.intime from session s left join users u on s.owner = u.id where s.token = ? and s.deleted = false";
            $params = [$token];
            $session = DalTools::queryForOne($query,$params);
            return $session;
        }

        public static function Update($token){
            $config = json_decode(file_get_contents(dirname(__FILE__)."/../config.json"));
            $timeOut = $config->time->sessionExpireTimeOut;
            $elapsedTime = time();
            $session = JWTHandler::verifyJWTToken($token);
            if($session == NULL)return NULL;
            $query = "select s.id sessionis, s.token, s.owner, u.username, s.intime from session s left join users u on s.owner = u.id where s.token = ? and s.deleted = false";
            $params = [$token[0]];
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
            return NULL;
        }
    }
?>

