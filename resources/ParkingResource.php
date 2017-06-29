<?php
/*****************************************/
/*                PARKING                */
/*****************************************/

    require_once dirname(__FILE__)."/../dal/ParkingDal.php";
    require_once dirname(__FILE__)."/../libs/ValidatorHandler.php";

    class ParkingResource{

        public static function find($req, $resp){
            $parkings = ParkingDal::findAll();
            return $resp->getBody()->write(json_encode($parkings));
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
            return $resp->getBody()->write(json_encode($createdParking));
        }

        public static function get($req, $resp){
            $id = $req->getAttribute("id");
            $parking = ParkingDal::get($id);
            if ($parking==NULL){
                return $resp->withStatus(404);
            }else{
                return $resp->getBody()->write(json_encode($parking));
            }
        }

        public static function update($req, $resp){
            $id = $req->getAttribute("id");
            $parking = ParkingDal::get($id);

            if ($parking==NULL){
                return $resp->withStatus(404);
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
                    return $resp->getBody()->write(json_encode($updatedParking));
                }else{

                    $token = $req->getHeader('token');
                    $session = ValidatorHandler::ValidateSession($token[0]);

                    $outuser = $session['owner'];
                    $intime = $parking['intime'];
                    $outtime = time();
                    $price = ParkingDal::setPrice($intime,$outtime);
                    $updatedParking = ParkingDal::update($id, $outuser, $outtime, $price);
                    return $resp->getBody()->write(json_encode($updatedParking));
                }
            }
        }

    }
?>