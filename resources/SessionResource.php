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

/*        public static function validateSessionToken($token){
            $validSession = SessionDal::getIdByToken($token);
            if($validSession !== NULL){
                $resp = TRUE;
                if(JWTHandler::verifyJWTToken($token)){
                    $resp = TRUE;
                }else{
                    $resp = FALSE;
                }
            }else{
                $resp = FALSE;
            }
            return $resp;
        }

        public static function validateUser($googleid,$email,$displayname,$avatar){
            $id = UserDal::findByGoogleAndMail($googleid, $email);
            if($id !== NULL){
                return $id['id'];
            }else{
                $id = UserDal::create($googleid,$email,$displayname,$avatar);
                return $id['id'];
            }
        }*/
    }
?>