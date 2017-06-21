<?php
    require_once dirname(__FILE__)."/../libs/DalTools.php";

    class UserDal{

        public static function get($id){
            $query = "select id,googleid,email,displayname,avatar,active,admin from users where id = ? and deleted = false";
            $params = [$id];
            $user = DalTools::queryForOne($query,$params);
            return $user;
        }

        public static function findAll($active=NULL){
            $query = "select id,googleid,email,displayname,avatar,active,admin from users where deleted = false";

            if ($active !== NULL){
                $query.= " and active = ";
                if ($active){
                    $query.="true";
                }else{
                    $query.="false";
                }
            }
            $users = DalTools::query($query,null);
            return $users;
        }

        public static function delete($id){
            $query = "update users set deleted = true where id = ?";
            $params = [$id];
            DalTools::query($query,$params);
            return;
        }

        public static function update($id, $googleid, $email, $displayname, $avatar, $active, $admin){
            $query = "update users set googleid = ?, email = ?, displayname = ?, avatar = ?, active = ?, admin = ? where id = ?";
            $params = [$googleid, $email, $displayname, $avatar, $active, $admin, $id];
            DalTools::query($query, $params);
            return UserDal::get($id);
        }

    }
?>