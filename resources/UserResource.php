<?php
/*****************************************/
/*                  USER                 */
/*****************************************/

    require_once dirname(__FILE__)."/../dal/UserDal.php";

    class UserResource{

        public static function create($req, $resp){
            $data = $req->getParsedBody();
            $userName = $data['username'];
            $password = $data['password'];
            $createdUser = UserDal::create($userName, $password);
            return $resp->getBody()->write(json_encode($createdUser));
        }


        public static function get($req, $resp){
            $id = $req->getAttribute("id");
            $user = UserDal::get($id); 
            if ($user==NULL){
                return $resp->withStatus(404);
            }else{
                return $resp->getBody()->write(json_encode($user));
            }
        }

        public static function find($req, $resp){
            $includeInactive = $req->getQueryParams()['includeinactive'];

            $active = TRUE;
            if ($includeInactive){
                $active = NULL;
            }

            $users = UserDal::findAll($active);
            return $resp->getBody()->write(json_encode($users));
        }

        public static function update($req, $resp){
            $id = $req->getAttribute("id");
            $user = UserDal::get($id);
            if ($user==NULL){
                return $resp->withStatus(404);
            }else{
                $data = $req->getParsedBody();
                $userName = $data['username'];
                $password = $data['password'];
                $active = strtolower($data['active']) == 'true';
                $admin = strtolower($data['admin']) == 'true';
                $updateduser = UserDal::update($id, $userName, $password, $active, $admin);
                return $resp->getBody()->write(json_encode($updateduser));
            }
        }

        public static function delete($req, $resp){
            $id = $req->getAttribute("id");
            $user = UserDal::get($id);
            if ($user==NULL){
                return $resp->withStatus(404);
            }else{
                UserDal::delete($id);
                return $resp->getBody()->write(json_encode(['mensaje'=>"Se elimino el indice ".$id]));
            }            
        }

    }
?>