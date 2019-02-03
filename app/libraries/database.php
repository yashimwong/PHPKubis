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
			$this->dbh = new PDO($dsn, $this->db_user, $this->db_pass, $options);
		} catch(PDOException $error) {
			$this->error = $error->getMessage();
			echo $this->error;
		}

	}

}




?>