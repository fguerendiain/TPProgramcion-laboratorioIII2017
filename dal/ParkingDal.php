<?php
    require_once dirname(__FILE__)."/../libs/DalTools.php";
    require_once dirname(__FILE__)."/VehicleDal.php";


    class ParkingDal{

        public static function findAll(){
            $query = "select id, place, vehicle, inuser, outuser, intime, outtime, price from parking";
            $parkings = DalTools::query($query,null);
            return $parkings;
        }

        public static function create($place, $vehicle, $inuser, $intime){
            $query = "insert into parking (place, vehicle, inuser, intime) values (?,?,?,?)";
            $params = [$place, $vehicle, $inuser, $intime];
            $createdParkingId = DalTools::query($query,$params);
            return ParkingDal::get($createdParkingId);
        }

        public static function get($id){
            $query = "select id, place, vehicle, inuser, outuser, intime, outtime, price from parking where id = ?";
            $params = [$id];
            $parking = DalTools::queryForOne($query,$params);
            return $parking;
        }


        /*
         *  CARGA EL TIEMPO , USUARIO Y PRECIO DE SALIDA PARA LA ESTADIA INDICADA
         */
        public static function update($id, $outuser, $outtime, $price){
            $query = "update parking set outuser = ?, outtime = ?, price = ? where id = ?";
            $params = [$outuser, $outtime, $price, $id];
            DalTools::query($query, $params);
            return ParkingDal::get($id);
        }


        /*
         *  MODIFICA EL ID DEL VEHICULO Y LA ESTADIA
         */
        public static function updateData($id, $vehicle, $place){
            $queryParking = "update parking set vehicle = ?, place = ? where id = ?";
            $paramsParking = [$vehicle, $place, $id];
            DalTools::query($queryParking, $paramsParking);
            return ParkingDal::get($id);
        }


        /*
         *  VERIFICA SI UN VEHICULO EXISTE, EN CASO DE QUE NO LO CREA
         */
        public static function getVehicle($license, $alien, $colour, $model, $brand){

            $query = "select id from vehicle where license = ? and alien = ? and colour = ? and model = ? and brand = ? and deleted = false";
            $params = [$license, $alien, $colour, $model, $brand];
            $vehicle = DalTools::queryForOne($query,$params);
            
            if($vehicle !== NULL){
                return $vehicle['id'];

            }else{
                $query = "insert into vehicle (license, alien, colour, model, brand) values (?,?,?,?,?)";
                $params = [$license, $alien, $colour, $model, $brand];
                DalTools::queryForOne($query,$params);
             //   $createdVehicleId = DalTools::queryForOne($query,$params);
             //   return $createdVehicleId;
                return ParkingDal::getVehicle($license, $alien, $colour, $model, $brand); //Uso recursividad por que luego del incert PDO no me devuelve bien el indice
            }
        }


        /*
         *  CALCULA EL IMPORTE A PAGAR SEGUN LA ESTADIA
         */
        public static function setPrice($intime,$outtime){

            $config = json_decode(file_get_contents(dirname(__FILE__)."/../config.json"));

            $parkedPrice = 0;
            $PriceHour = $config->price->hour;
            $PriceHalfStay = $config->price->halfStay;
            $PriceStay = $config->price->stay;

            $parkedTime = $outtime - $intime;
            $timeHour = $config->time->hour;
            $timeHalfStay = $config->time->halfStay;
            $timeStay =  $config->time->stay;

            while($parkedTime >= $timeStay){
                $parkedPrice += $PriceStay;
                $parkedTime -= $timeStay;
            }
            while($parkedTime >= $timeHalfStay){
                $parkedPrice += $PriceHalfStay;
                $parkedTime -= $timeHalfStay;
            }
            while($parkedTime >= $timeHour){
                $parkedPrice += $PriceHour;
                $parkedTime -= $timeHour;
            }
            if($parkedTime < $timeHour/4){
                $parkedPrice += 0;
            }else{
                $parkedPrice += $PriceHour;
            }

            return $parkedPrice;
        }
    }
?>