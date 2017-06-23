<?php
/*****************************************/
/*                SESSION                */
/*****************************************/

    require_once dirname(__FILE__)."/../dal/SessionDal.php";
    require_once dirname(__FILE__)."/../dal/UserDal.php";
    require_once dirname(__FILE__)."/../libs/JWTHandler.php";

    class SessionResource{

        public static function create($req, $resp){
            $data = $req->getParsedBody();
            $token = $data['token'];
            $googleid = $data['googleid'];
            $email = $data['email'];
            $displayname = $data['displayname'];
            $avatar = $data['avatar'];
            $intime = time();
            if(SessionResource::validateSessionToken($token)){
                $session = SessionDal::getIdByToken($token);
                return $resp->getBody()->write(json_encode($session));
            }
            $user = SessionResource::validateUser($googleid,$email,$displayname,$avatar);
            $createdSession = SessionDal::create($token, $user, $intime);
            return $resp->getBody()->write(json_encode($createdSession));
        }

        public static function validateSessionToken($token){
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
        }
    }
?>