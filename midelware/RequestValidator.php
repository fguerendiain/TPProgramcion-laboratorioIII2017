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
            if($validatedData == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $next($req, $resp);
            }
            return $resp->withStatus(404); //no encontrado
        }

        public static function PlaceRequestValues($req, $resp, $next){

            $data = $req->getParsedBody();
            
            $name = $data['name'];
            $floor = $data['floor'];

            $validatedData = ValidatorHandler::ValidateInteger($name);
            $validatedData = ValidatorHandler::ValidateInteger($floor);
            if($validatedData == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $next($req, $resp);
            }
            return $resp->withStatus(404); //no encontrado
        }

        public static function SessionUserRequestValues($req, $resp, $next){

            $data = $req->getParsedBody();

            $userName = $data['username'];
            $password = $data['password'];

            $validatedData = ValidatorHandler::ValidateUserCredentials($userName);
            $validatedData = ValidatorHandler::ValidateOnlyLetters($password);
            if($validatedData == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $next($req, $resp);
            }
            return $resp->withStatus(404); //no encontrado
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
            if($validatedData == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $next($req, $resp);
            }
            return $resp->withStatus(404); //no encontrado
        }

        public static function SessionTokenRequestValue($req, $resp, $next){

            $token = $req->getHeader('token');
            if($token == NULL)return $resp->withStatus(400); //error sintaxis
            $validatedData = ValidatorHandler::ValidateSession($token);
            if($validatedData == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $next($req, $resp);
            }
            return $resp->withStatus(401); //session vencida
        }


        public static function ValidateUserPermissions($req, $resp, $next){

            $token = $req->getHeader('token');
            $validatedData = ValidatorHandler::ValidateUserPermission($token);
            if($validatedData == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $next($req, $resp);
            }
            return $resp->withStatus(403); //el usaurio no tiene permisos
        }
    }
?>