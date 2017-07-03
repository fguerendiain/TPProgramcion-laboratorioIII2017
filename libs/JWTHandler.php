<?php
    
    require_once dirname(__FILE__)."/../vendor/autoload.php";
    use \Firebase\JWT\JWT;

    class JWTHandler{

        public static function createJWTToken($session, $intime){
            $config = json_decode(file_get_contents(dirname(__FILE__)."/../config.json"));
            $key = $config->JWT->passKey;
            $encryption = $config->JWT->encryption;

            $payLoad = array(
                'iat' => $intime,
                'data' => $session
                );

            $token = JWT::encode($payLoad, $key, $encryption);

            return $token;
        }

        public static function verifyJWTToken($session){
            $config = json_decode(file_get_contents(dirname(__FILE__)."/../config.json"));
            $key = $config->JWT->passKey;
            $encryption = array($config->JWT->encryption,'HS384');
            $decoded = JWT::decode($session[0], $key, $encryption);
            if($decoded){
                return $decoded;
            }
            return NULL;
        }

    }


?>