<?php

    require_once dirname(__FILE__)."/../libs/ValidatorHandler.php";


    class RequestValidator{

        public static function ParkingRequestValues($req, $resp, $next){

            $data = $req->getParsedBody();
            $license = $data['license'];
            $colour = $data['colour'];
            $model = $data['model'];
            $brand = $data['brand'];
            $place = $data['place'];

            $validatedData = ValidatorHandler::ValidateUserCredentials($license);
            $validatedData = ValidatorHandler::ValidateUserCredentials($colour);
            $validatedData = ValidatorHandler::ValidateUserCredentials($model);
            $validatedData = ValidatorHandler::ValidateUserCredentials($brand);

            $validatedData = ValidatorHandler::ValidateInteger($place);
            if($validatedData){
                return $next($req, $resp);
            }
            $resp->getBody()->write(json_encode(['mensaje'=>"Caracteres invalidos"]));
            return $resp;

        }

        public static function PlaceRequestValues($req, $resp, $next){

            $data = $req->getParsedBody();
            
            $name = $data['name'];
            $floor = $data['floor'];

            $validatedData = ValidatorHandler::ValidateInteger($name);
            $validatedData = ValidatorHandler::ValidateInteger($floor);
            if($validatedData){
                return $next($req, $resp);
            }
            $resp->getBody()->write(json_encode(['mensaje'=>"Caracteres invalidos"]));
            return $resp;


        }

        public static function SessionUserRequestValues($req, $resp, $next){

            $data = $req->getParsedBody();

            $userName = $data['username'];
            $password = $data['password'];

            $validatedData = ValidatorHandler::ValidateUserCredentials($userName);
            $validatedData = ValidatorHandler::ValidateOnlyLetters($password);
            if($validatedData){
                return $next($req, $resp);
            }
            $resp->getBody()->write(json_encode(['mensaje'=>"Caracteres invalidos"]));
            return $resp;
            
        }

        public static function VehicleRequestValues($req, $resp, $next){
            
            $data = $req->getParsedBody();

            $license = $data['license'];
            $colour = $data['colour'];
            $model = $data['model'];
            $brand = $data['brand'];

            $validatedData = ValidatorHandler::ValidateUserCredentials($license);
            $validatedData = ValidatorHandler::ValidateUserCredentials($colour);
            $validatedData = ValidatorHandler::ValidateUserCredentials($model);
            $validatedData = ValidatorHandler::ValidateUserCredentials($brand);
            if($validatedData){
                return $next($req, $resp);
            }
            $resp->getBody()->write(json_encode(['mensaje'=>"Caracteres invalidos"]));
            return $resp;
            
        }

        public static function SessionTokenRequestValue($req, $resp, $next){

            $token = $req->getHeader('token');
            $validatedData = ValidatorHandler::ValidateSession($token[0]);
            if($validatedData !== NULL){
                if($validatedData !== true){
                    return $next($req, $resp);
                }else{
                    $resp->getBody()->write(json_encode(['mensaje'=>"La sesion expiro"]));
                }
            }else{
                    $resp->getBody()->write(json_encode(['mensaje'=>"La sesion no existe"]));
            }

            return $resp;
        }


        public static function ValidateUserPermissions($req, $resp, $next){
            $token = $req->getHeader('token');
            $validatedData = ValidatorHandler::ValidateUserPermission($token[0]);
            if($validatedData !== NULL){
                if($validatedData !== false){
                    return $next($req, $resp);
                }
            }
            $resp->getBody()->write(json_encode(['mensaje'=>"El usuario no tiene permisos"]));
            return $resp;
        }
    }
?>