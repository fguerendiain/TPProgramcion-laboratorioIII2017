<?php 
class PDOHandler
{
	private static $_objetoDataBase;
	private $_objetoPDO;
	private function __construct()
	{
        $config = json_decode(file_get_contents(dirname(__FILE__)."/../config.json"));
        $dsn = "mysql:host=".$config->db->host.";port=".$config->db->port.";dbname=".$config->db->db.";charset=utf8";

		try {
			$this->_objetoPDO =
				new PDO($dsn,$config->db->user,$config->db->password,
					array(
						PDO::ATTR_EMULATE_PREPARES => false,
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
					)
				);

			$this->_objetoPDO->exec("SET CHARACTER SET utf8");

		} catch (PDOException $e) {

			print "Error connecting to the DB: " . $e->getMessage();

			die();
		}
	}

	public function Query($sql, $params)
	{
		$statement=$this->_objetoPDO->prepare($sql);

        if ($params!=null && count($params)>0){
            for($p=0; $p < count($params); $p++){
                $param = $params[$p];
                $valuePosition = $p+1;
                $statement->bindValue($valuePosition, $param);
            }
        }

		$statement->execute();
		
        if ($statement->columnCount () == 0){
            return $this->_objetoPDO->lastInsertId();
        }else{
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
	}

	public static function Connect()//singleton
	{
		if (!isset(self::$_objetoDataBase)) {       
			self::$_objetoDataBase = new PDOHandler(); 
		}	return self::$_objetoDataBase;        
	}

	// Evita que el objeto se pueda clonar
	public function __clone()
	{
		trigger_error('La clonaci&oacute;n de este objeto no est&aacute; permitida!!!', E_USER_ERROR);
	}
}

// $obj=DataBase::Connect();
// $obj->Query("DELETE FROM usuario WHERE id=1");
// $resultado=$obj->Query("SELECT * FROM usuario");
// var_dump($resultado);
?>
