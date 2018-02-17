<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/backend/inc.php';

class db {
	public function __construct() {
		$host = "localhost";
		$user = "root";
		$pass = "";
		$db   = "test";
		
		try {
	    $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
	    // set the PDO error mode to exception
	    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    // echo "Connected successfully";
    }
		catch(PDOException $e) {
			// $this->success = false;
			$this->message = 'db conx error';
			die(json_encode($this));
    	}
	}

	public function __destruct() {
		$this->pdo = null;
	}
}
// $db = new db();
// print_r($db);
?>