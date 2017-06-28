<?php

    require_once dirname(__FILE__)."/../libs/ValidatorHandler.php";


    class RequestValidator{

        public static function ParkingRequestValues($req, $resp, $next){

            $data = $req->getParsedBody();
            $place = $data['place'];

            $validatedData = ValidatorHandler::ValidateInteger($place);
            if($validatedData){
                return $next;
            }
            $resp = "Datos incorrectos"; //poner algo mas piola
            return $resp;

        }

        public static function PlaceRequestValues($req, $resp, $next){

            $data = $req->getParsedBody();
            
            $name = $data['name'];
            $floor = $data['floor'];

            $validatedData = ValidatorHandler::ValidateInteger($name);
            $validatedData = ValidatorHandler::ValidateInteger($floor);
            if($validatedData){
                return $next;
            }
            $resp = "Datos incorrectos"; //poner algo mas piola
            return $resp;


        }

        public static function SessionUserRequestValues($req, $resp, $next){

            $data = $req->getParsedBody();
            
            $userName = $data['username'];
            $password = $data['password'];

            $validatedData = ValidatorHandler::ValidateUserCredentials($userName);
            $validatedData = ValidatorHandler::ValidateUserCredentials($password);
            if($validatedData){
                return $next;
            }
            $resp = "Datos incorrectos"; //poner algo mas piola
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
                return $next;
            }
            $resp = "Datos incorrectos"; //poner algo mas piola
            return $resp;
            
        }


    }
?>