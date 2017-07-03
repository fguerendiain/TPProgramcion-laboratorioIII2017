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
            if ($createdUser==NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($createdUser));
            }
            return $resp->withStatus(404); //no encontrado
        }


        public static function get($req, $resp){
            $id = $req->getAttribute("id");
            $user = UserDal::get($id); 
            if ($user==NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($user));
            }
            return $resp->withStatus(404); //no encontrado
        }

        public static function find($req, $resp){
            $includeInactive = $req->getQueryParams()['includeinactive'];
            $active = TRUE;
            if ($includeInactive){
                $active = NULL;
            }
            $users = UserDal::findAll($active);
            if ($users==NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($users));
            }
            return $resp->withStatus(404); //no encontrado
        }

        public static function update($req, $resp){
            $id = $req->getAttribute("id");
            $user = UserDal::get($id);
            if ($user==NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                $data = $req->getParsedBody();
                $userName = $data['username'];
                $password = $data['password'];
                $active = strtolower($data['active']) == 'true';
                $admin = strtolower($data['admin']) == 'true';
                $updateduser = UserDal::update($id, $userName, $password, $active, $admin);
                if($updateduser == NULL){
                    return $resp->withStatus(400); //error sintaxis
                }else{
                    return $resp->getBody()->write(json_encode($updateduser));
                }
                return $resp->withStatus(404); //no encontrado
            }
        }

        public static function delete($req, $resp){
            $id = $req->getAttribute("id");
            $user = UserDal::get($id);
            if($user == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                UserDal::delete($id);
                return $resp->withStatus(200); //ok
            }
            return $resp->withStatus(404); //no encontrado
        }
    }
?>