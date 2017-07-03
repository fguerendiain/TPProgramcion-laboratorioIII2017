<?php
/*****************************************/
/*                PARKING                */
/*****************************************/

    require_once dirname(__FILE__)."/../dal/ParkingDal.php";
    require_once dirname(__FILE__)."/../libs/ValidatorHandler.php";

    class ParkingResource{

        public static function find($req, $resp){
            $parkings = ParkingDal::findAll();
            if($parkings == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($parkings));
            }
            return $resp->withStatus(404); //no encontrado
        }

        public static function create($req, $resp){

            $token = $req->getHeader('token');
            $session = ValidatorHandler::ValidateSession($token[0]);

            $data = $req->getParsedBody();
            $license = $data['license'];
            $alien = strtolower($data['alien']) == 'true';
            $colour = $data['colour'];
            $model = $data['model'];
            $brand = $data['brand'];
            $vehicle = ParkingDal::getVehicle($license, $alien, $colour, $model, $brand);
            $place = $data['place'];
            $inuser = $session['owner'];
            $intime = time();
            $createdParking = ParkingDal::create($place, $vehicle, $inuser, $intime);
            if($createdParking == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($createdParking));
            }
            return $resp->withStatus(404); //no encontrado
        }
        

        public static function get($req, $resp){
            $id = $req->getAttribute("id");
            $parking = ParkingDal::get($id);
            if($parking == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($parking));
            }
            return $resp->withStatus(404); //no encontrado
        }


        public static function update($req, $resp){
            $id = $req->getAttribute("id");
            $parking = ParkingDal::get($id);

            if ($parking==NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                $changedata = $req->getQueryParams()['changedata'];
                $data = $req->getParsedBody();
                if ($changedata){
                    $license = $data['license'];
                    $alien = strtolower($data['alien']) == 'true';
                    $colour = $data['colour'];
                    $model = $data['model'];
                    $brand = $data['brand'];
                    $vehicle = ParkingDal::getVehicle($license, $alien, $colour, $model, $brand);
                    $place = $data['place'];
                    $updatedParking = ParkingDal::updateData($id, $vehicle, $place);
                    if($updatedParking == NULL){
                        return $resp->getBody()->write(json_encode($updatedParking));
                    }
                    return $resp->withStatus(400); //error sintaxis
                }else{

                    $token = $req->getHeader('token');
                    $session = ValidatorHandler::ValidateSession($token[0]);

                    $outuser = $session['owner'];
                    $intime = $parking['intime'];
                    $outtime = time();
                    $price = ParkingDal::setPrice($intime,$outtime);
                    $updatedParking = ParkingDal::update($id, $outuser, $outtime, $price);
                    if($updatedParking == NULL){
                        return $resp->getBody()->write(json_encode($updatedParking));
                    }
                    return $resp->withStatus(400); //error sintaxis
                }
                return $resp->withStatus(404); //no encontrado
            }
        }
    }
?>