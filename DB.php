<?php 
class Database{
	public static function connect(){
		$dsn = 'mysql:dbname=test;host=127.0.0.1';
		$user = 'root';
		$password = '';

		$pdo = new PDO($dsn, $user, $password);

		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		return $pdo;
	}


	public static function query($sql, $params = array()){
		try {
			$pieces;
			$pieces = explode(" ", $sql);


			if ($pieces[0] === "SELECT") {

				$statement = self::connect()->prepare($sql);
				$statement->execute($params);
				$data=array();


				if($statement->rowCount() > 0){
					foreach ($result = $statement->fetchAll() as $row ) {
						array_push($data, $row);
				}
				}

				return $data;
			}elseif ($pieces[0] === "INSERT"){

				$statement = self::connect()->prepare($sql);
				if($statement->execute($params)){
					return true;
				}else{
					return false;
				}
			}elseif($pieces[0] === "UPDATE"){
				$statement = self::connect()->prepare($sql);
				if($statement->execute($params)){
					return true;
				}else{
					return false;
				}
			}elseif($pieces[0] === "DELETE"){
				$statement = self::connect()->prepare($sql);
				if($statement->execute($params)){
					return true;
				}else{
					return false;
				}
			}else{
				$statement = self::connect()->prepare($sql);
				$statement->execute($params);
				return $statement;
			}

		} catch (Exception $e) {
			echo $e;
		}
	}
}
