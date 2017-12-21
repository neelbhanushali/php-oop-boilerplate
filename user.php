<?php
require_once 'db.php';

class user {
	public function __construct($id) {
		$db = new db();

		$sql = "SELECT * FROM `definitions` WHERE id = :id";

		$query = $db->pdo->prepare($sql);

		$query->execute([':id' => $id]);

		if($query->rowCount()) {
			$result = $query->fetch(PDO::FETCH_OBJ);

			foreach($result as $key => $value)
				$this->$key = $value;
		}
	}

	public function isEmpty() {
		return empty(get_object_vars($this)) ? true : false;
	}
}

$user = new user(2);

print_r($user);
?>