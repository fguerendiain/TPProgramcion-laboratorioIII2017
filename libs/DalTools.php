<?php
    require_once dirname(__FILE__)."/PDOHandler.php";

    class DalTools{

        public static function query($query, $params){
            $dbConn = PDOHandler::Connect();
            $results = $dbConn->query($query, $params);
            return $results;
        }

        public static function queryForOne($query, $params){
            $dbConn = PDOHandler::Connect();
            $results = $dbConn->query($query, $params);

            if (count($results)>0){
                return $results[0];
            }else{
                return NULL;
            }
        }

    }
?>
