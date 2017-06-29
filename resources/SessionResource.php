<?php
/*****************************************/
/*                SESSION                */
/*****************************************/

    require_once dirname(__FILE__)."/../dal/SessionDal.php";
    require_once dirname(__FILE__)."/../dal/UserDal.php";

    class SessionResource{

        public static function create($req, $resp){
            $data = $req->getParsedBody();
            $userName = $data['username'];
            $password = $data['password'];
            $intime = time();
            $existingUser = UserDal::getIdByNameAndPassword($userName,$password);
            if($existingUser !== NULL){
                $newSession = SessionDal::create($existingUser, $intime);
                return $resp->getBody()->write(json_encode($newSession));
            }
            return $resp->getBody()->write(json_encode(['error'=>"El usuario no existe"]));
        }
    }
?>