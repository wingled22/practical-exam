
<?php 

/**
 *  this is the class for the database
 *  we have a connect function
 *	and a query function that can handle not all but most used CRUD functionality
 *
 *	to use this class first you should import this to the file where you want to use this class
 * 	with the require_once function
 *
 *	then use Database::query('the query with column1 = :parameter1' , array(':parameter1'=> 'value' ....))
 *
 */
class Database{
	
	// this is connect function to connect the site to the database
	public static function connect(){
		$dsn = 'mysql:dbname=test;host=127.0.0.1';
		$user = 'root';
		$password = '';

		// initialize a new PDO object
		// call the constructor of the PDO
		$pdo = new PDO($dsn, $user, $password);

		//default setAttribute 
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		// return the pdo object to any one who call this function
		return $pdo;
	}


/**
 *  this is the trickiest part of the class
 *  here we make a function that can handle all the CRUD request
 *	I implented it this way so that i can reuse this code whenever I will 
 *	do something with the database
 */



// so first make a function that have a 2 parameter
// 1 for the query and 1 for the variables that supports that query which is an array parameter
	public static function query($sql, $params = array()){
		

	//here we use try catch for easy debugging 
	try {

		// make a variable so that we can explode the query to that variable,
		// and find the keyword from the exploded query, so that the we can know
		// what the user will do to our database
		// keywords examples: DELETE, INSERT, UPDATE, SELECT

		$pieces;
		$pieces = explode(" ", $sql);


		// so if you notice all the keyword are on the first part if the exploded query 
		// so we use $pieces[0], and then keyword
		if ($pieces[0] === "SELECT") {
			// the query is select

			// initialize the constructor and the pdo object will be passed into the statement then prepare the statement
			// and then execute with $params as parameter, !! it is still okay if the params is empty 
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

			// from here up to the bottom functions this will not return the data, but instead we will return to the caller of the function if the query was successfully executed or not
			$statement = self::connect()->prepare($sql);
			if($statement->execute($params)){
				// if executed properly then return true
				return true;
			}else{
				// if not return false
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
		}

	} catch (Exception $e) {
		echo $e;
	}
	}


}