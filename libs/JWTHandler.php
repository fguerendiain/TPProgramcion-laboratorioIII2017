<?php
    
    require_once dirname(__FILE__)."/../vendor/autoload.php";
    use \Firebase\JWT\JWT;

    class JWTHandler{

        public static function createJWTToken($session){
            $config = json_decode(file_get_contents(dirname(__FILE__)."/../config.json"));
            $key = $config->JWT->passKey;
            $encryption = $config->JWT->encryption;

            $now = time();
            $payLoad = array(
                'iat' => $now,
                'exp' => $now + 10800,
                'data' => $session,
                );

            $token = JWT::encode($payLoad, $key, $encryption);

            return $token;
        }

        public static function verifyJWTToken($session){
            $config = json_decode(file_get_contents(dirname(__FILE__)."/../config.json"));
            $key = $config->JWT->passKey;
            $encryption = $config->JWT->encryption;

            $decoded = JWT::decode($session, $key, $encryption);

            if($decoded){
                return $session;
            }
            return NULL;
        }

    }


?>