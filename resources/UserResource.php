<?php
/*****************************************/
/*                  USER                 */
/*****************************************/

    require_once dirname(__FILE__)."/../dal/UserDal.php";

    class UserResource{

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
                $displayname = $data['displayname'];
                $avatar = $data['avatar'];
                $active = strtolower($data['active']) == 'true';
                $admin = strtolower($data['admin']) == 'true';
                $updateduser = UserDal::update($id, $displayname, $avatar, $active, $admin);
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
                return $resp->getBody()->write(json_encode("Se elimino el indice ".$id));
            }            
        }

    }
?>