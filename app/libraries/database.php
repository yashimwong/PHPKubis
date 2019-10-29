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
	private $charset = DB_CHARSET;
	protected $fetch_mode = PDO::FETCH_ASSOC;

	private $db_handler;
	private $statement;
	private $error;

	public function __construct(){
		//Set DSN
		$dsn = 'mysql:host='. $this->host .';dbname='. $this->db_name .';charset='. $this->charset;
		$options = [
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_EMULATE_PREPARES => false,
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
	
	// Set Fetch Mode. By Default: Fetch Mode by Assoc
	public function fetchMode($type){
		switch($type){
			case 'object':
				$this->fetch_mode = PDO::FETCH_OBJ;
			break;

			case 'associative':
				$this->fetch_mode = PDO::FETCH_ASSOC;
			break;

			case 'both':
				$this->fetch_mode = PDO::FETCH_BOTH;
			break;

			case 'number':
				$this->fetch_mode = PDO::FETCH_NUM;
			break;
		}

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

	// Get result
	public function resultSet(){
		$this->execute();
		return $this->statement->fetchAll($this->fetch_mode);
	}

	// Get single record
	public function single(){
		$this->execute();
		return $this->statement->fetch($this->fetch_mode);
	}

	// Get row count
	public function rowCount(){
		return $this->statement->rowCount();
	}

}




?>
