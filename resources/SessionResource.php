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
                $session = SessionDal::create($existingUser, $intime);
                return $session;
            }
            return "El usuario no existe";
        }
    }
?>