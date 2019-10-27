<?php

/*
 * PDO Database Class
 * Connect to database
 * Create prepared statements
 * Bind Values
 * Return rows and results
 *
 */

class Database {
	private $host = DB_HOST;
	private $db_user = DB_USER;
	private $db_pass = DB_PASS;
	private $db_name = DB_NAME;

	private $db_handler;
	private $statement;
	private $error;

	public function __construct(){
		//Set DSN
		$dsn = 'mysql:host='. $this->host .';dbname='. $this->db_name;
		$options = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];

		// Create PDO Instance
		try {
			$this->db_handler = new PDO($dsn, $this->db_user, $this->db_pass, $options);
		} catch(PDOException $error) {
			$this->error = $error->getMessage();
			echo $this->error;
		}

	}

	// Prepare Statement with query
	public function query($sql){
		$this->statement = $this->db_handler->prepare($sql);
	}

	// Bind Values
	public function bind($param, $value, $type = null){
		if(is_null($type)){
			switch(true){
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;

				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;

				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;

				default:
					$type = PDO::PARAM_STR;
			}
		}

		$this->statement->bindValue($param, $value, $type);
	}
	
	// Bind All Values
	public function bindAll($bindArray){
		foreach($bindArray as $key => $value){
			$this->bind($key, $value);
		}
	}

	// Execute the prepared statement
	public function execute(){
		return $this->statement->execute();
	}

	// Get result set as array of objects
	public function resultSet(){
		$this->execute();
		return $this->statement->fetchAll(PDO::FETCH_OBJ);
	}

	// Get single record as object
	public function single(){
		$this->execute();
		return $this->statement->fetch(PDO::FETCH_OBJ);
	}

	// Get row count
	public function rowCount(){
		return $this->statement->rowCount();
	}

}




?>
