<?php
/*****************************************/
/*                SESSION                */
/*****************************************/

    require_once dirname(__FILE__)."/../dal/SessionDal.php";

    class SessionResource{

        public static function create($req, $resp){
            $data = $req->getParsedBody();
            $token = $data['token'];
            $owner = $data['owner'];
            $intime = time();
            $createdSession = SessionDal::create($token, $owner, $intime);
            return $resp->getBody()->write(json_encode($createdSession));
        }

    }
?>