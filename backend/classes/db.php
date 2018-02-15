<?php
class db {
	public function __construct() {
		$d = json_decode(file_get_contents('../details.json'));
		
		try {
	    $this->pdo = new PDO("mysql:host=$d->DB_HOST;dbname=$d->DB_NAME", $d->DB_USER, $d->DB_PASS);
	    // set the PDO error mode to exception
	    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    // echo "Connected successfully";
    }
		catch(PDOException $e) {
		$this->success = false;
		$this->message = 'db conx error';
    }
	}

	public function __destruct() {
		$this->pdo = null;
	}
}
// $db = new db();
// print_r($db);
?>