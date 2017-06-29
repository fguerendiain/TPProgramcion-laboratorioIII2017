<?php
    require_once dirname(__FILE__)."/../libs/DalTools.php";

    class UserDal{

        public static function create($userName,$password){
            $query = "insert into users (username,password) values (?,?)";
            $params = [$userName,$password];
            $createdUser = DalTools::query($query,$params);
            return UserDal::get($createdUser);
        }

        public static function get($id){
            $query = "select id, username, password, active, admin from users where id = ? and deleted = false";
            $params = [$id];
            $user = DalTools::queryForOne($query,$params);
            return $user;
        } 

        public static function findAll($active=NULL){
            $query = "select id, username, password, active, admin from users where deleted = false";

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

        public static function update($id, $userName, $password, $active, $admin){
            $query = "update users set username = ?, password = ?, active = ?, admin = ? where id = ?";
            $params = [$userName, $password, $active, $admin, $id];
            DalTools::query($query, $params);
            return UserDal::get($id);
        }

        public static function getIdByNameAndPassword($userName, $password){
            $query = "select id, username, password, active, admin from users where userName = ? and password = ? and deleted = false";
            $params = [$userName, $password];
            $existingUser = DalTools::queryForOne($query,$params);
            if($existingUser !== NULL){
                return $existingUser;
            }
            return $NULL;
        }

    }
?>