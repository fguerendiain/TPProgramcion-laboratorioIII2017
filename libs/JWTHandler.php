<?php
    use \Firebase\JWT\JWT;
    define("KEY",json_decode(file_get_contents(dirname(__FILE__)."/../config.json"))->JWT->passKey);
    define("ENCRYPTION",json_decode(file_get_contents(dirname(__FILE__)."/../config.json"))->JWT->encryption);

    class JWTHandler{


        public static function createJWTToken($session){
//            $config = json_decode(file_get_contents(dirname(__FILE__)."/../config.json"));
//            $key = $config->JWT->passKey;
//            $encryption = $config->JWT->encryption;

            $now = time();
            $payLoad = array(
                'iat' => $now,
                'exp' => $now + 10800,
                'data' => $session,
                );

            $token = JWT::encode(
                $payLoad,
                self::KEY,
                self::ENCRYPTION
                ); 
            return $token;
        }

        public static function verifyJWTToken($session){

            $decoded = JWT::decode(
                $session,
                self::KEY,
                self::ENCRYPTION
            );

            if($decoded){
                return $session;
            }
            return false;
        }

    }
?>