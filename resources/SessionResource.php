<?php
/*****************************************/
/*                SESSION                */
/*****************************************/

    require_once dirname(__FILE__)."/../dal/SessionDal.php";
    require_once dirname(__FILE__)."/../dal/UserDal.php";
    require_once dirname(__FILE__)."/../libs/ValidatorHandler.php";


    class SessionResource{

        public static function create($req, $resp){
            $data = $req->getParsedBody();
            $userName = $data['username'];
            $password = $data['password'];
            $intime = time();
            $existingUser = UserDal::getIdByNameAndPassword($userName,$password);
            if($existingUser == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                $newSession = SessionDal::create($existingUser, $intime);
                if($newSession == NULL){
                    return $resp->withStatus(400); //error sintaxis
                }else{
                    return $resp->getBody()->write(json_encode($newSession));
                }
                return $resp->withStatus(404); //no encontrado
            }
        }

        public static function get($req, $resp){
            $token = $req->getHeader('token');
            $session = SessionDal::getByToken($token[0]);
            if ($session==NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($session));
            }
            return $resp->withStatus(404); //no encontrado
        }
    }
?>