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
            return $resp->getBody()->write(json_encode($places));
        }

        public static function create($req, $resp){
            $data = $req->getParsedBody();
            $name = $data['name'];
            $floor = $data['floor'];
            $createdPlace = PlaceDal::create($name, $floor);
            return $resp->getBody()->write(json_encode($createdPlace));
        }

        public static function update($req, $resp){
            $id = $req->getAttribute("id");
            $place = PlaceDal::get($id);
            if ($place==NULL){
                return $resp->withStatus(404);
            }else{
                $data = $req->getParsedBody();
                $name = $data['name'];
                $floor = $data['floor'];
                $handicap = strtolower($data['handicap']) == 'true';
                $active = strtolower($data['active']) == 'true';
                $updatedPlace = PlaceDal::update($id, $name, $floor, $handicap, $active);
                return $resp->getBody()->write(json_encode($updatedPlace));
            }
        }

        public static function get($req, $resp){
            $id = $req->getAttribute("id");
            $place = PlaceDal::get($id);
            if ($place==NULL){
                return $resp->withStatus(404);
            }else{
                return $resp->getBody()->write(json_encode($place));
            }
        }

        public static function delete($req, $resp){
            $id = $req->getAttribute("id");
            $place = PlaceDal::get($id);
            if ($place==NULL){
                return $resp->withStatus(404);
            }else{
                PlaceDal::delete($id);
                return $resp->getBody()->write(json_encode("Se elimino el indice ".$id));
            }            
        }

    }
?>