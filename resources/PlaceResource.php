<?php
/*****************************************/
/*                  PLACE                */
/*****************************************/

    require_once dirname(__FILE__)."/../dal/PlaceDal.php";

    class PlaceResource{

        public static function find($req, $resp){
            $includeInactive = $req->getQueryParams()['includeinactive'];
            $active = TRUE;
            if ($includeInactive){
                $active = NULL;
            }
            $places = PlaceDal::findAll($active);
            if($places == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($places));
            }
            return $resp->withStatus(404); //no encontrado
        }

        public static function create($req, $resp){
            $data = $req->getParsedBody();
            $name = $data['name'];
            $floor = $data['floor'];
            $createdPlace = PlaceDal::create($name, $floor);
            if($createdPlace == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($createdPlace));
            }
            return $resp->withStatus(404); //no encontrado
        }

        public static function update($req, $resp){
            $id = $req->getAttribute("id");
            $place = PlaceDal::get($id);
            if ($place==NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                $data = $req->getParsedBody();
                $name = $data['name'];
                $floor = $data['floor'];
                $handicap = strtolower($data['handicap']) == 'true';
                $active = strtolower($data['active']) == 'true';
                $updatedPlace = PlaceDal::update($id, $name, $floor, $handicap, $active);
                if($updatedPlace == NULL){
                    return $resp->withStatus(400); //error sintaxis
                }else{
                    return $resp->getBody()->write(json_encode($updatedPlace));
                }
                return $resp->withStatus(404); //no encontrado
            }
        }

        public static function get($req, $resp){
            $id = $req->getAttribute("id");
            $place = PlaceDal::get($id);
            if ($place==NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                return $resp->getBody()->write(json_encode($place));
            }
            return $resp->withStatus(404); //no encontrado
        }

        public static function delete($req, $resp){
            $id = $req->getAttribute("id");
            $place = PlaceDal::get($id);
            if($places == NULL){
                return $resp->withStatus(400); //error sintaxis
            }else{
                $deletedPlace = PlaceDal::delete($id);
                if($deletedPlace == NULL){
                    return $resp->withStatus(400); //error sintaxis
                }else{
                    return $resp->getBody()->write(json_encode($places));
                }
                return $resp->withStatus(404); //no encontrado
            }
        }
    }
?>