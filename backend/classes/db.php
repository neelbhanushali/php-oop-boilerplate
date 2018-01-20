<?php
class db {
	public function __construct() {
		$servername = 	'localhost';
		$username 	= 	'root';
		$password 	= 	'root';
		$dbname 		= 	'test';

		try {
	    $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    // echo "Connected successfully";
    }
		catch(PDOException $e) {
	    die(json_encode([
	    	'success' => false,
	    	'message' => 'db conx error'
	    ]));
    }
	}

	public function __destruct() {
		$this->pdo = null;
	}
}

?>