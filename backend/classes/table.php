<?php
require_once 'db.php';

class table {
	protected $table;

	public function id($id) {
		$db = new db();

		$sql = "SELECT * FROM `{$this->table}` WHERE id = :id";

		$query = $db->pdo->prepare($sql);

		$query->execute([':id' => $id]);

		if($query->rowCount())
			$this->result = $query->fetch(PDO::FETCH_OBJ);
	}

	public function get() {
		$db = new db();

		$sql = "SELECT * FROM `{$this->table}`";

		$query = $db->pdo->prepare($sql);

		$query->execute();

		if($query->rowCount()) {
			if($query->rowCount() == 1)
				$this->result = $query->fetch(PDO::FETCH_OBJ);
			else 
				while($result = $query->fetch(PDO::FETCH_OBJ))
					$this->results[] = $result;
		}
	}

	public function search($column, $param, $value) {
		$db = new db();

		$sql = "SELECT * FROM `{$this->table}` WHERE {$column} {$param} :value";

		$query = $db->pdo->prepare($sql);

		$query->execute([':value' => $value]);

		if($query->rowCount()) {
			if($query->rowCount() == 1)
				$this->result = $query->fetch(PDO::FETCH_OBJ);
			else 
				while($result = $query->fetch(PDO::FETCH_OBJ))
					$this->results[] = $result;
		}
	}

	public function insert($arr) {
		$arr = json_decode(json_encode($arr));
		$db = new db();

		$sql = "INSERT INTO `{$this->table}`
						VALUES(null, :subject, :word, :definition)";

		$query = $db->pdo->prepare($sql);

		$query->execute([
			':subject' 		=> $arr->subject,
			':word' 			=> $arr->word,
			':definition' => $arr->definition
		]);

		if($query->rowCount())
			$this->success = true;
	}

	public function update($column, $value, $wherecolumn, $whereparam, $wherevalue) {
		$db = new db();

		$sql = "UPDATE `{$this->table}` 
						SET {$column} = :value
						WHERE {$wherecolumn} {$whereparam} :wherevalue";

		$query = $db->pdo->prepare($sql);

		$query->execute([
			':value' 			=> $value,
			':wherevalue' => $wherevalue
		]);

		if($query->rowCount())
			$this->success = true;
	}


	public function delete($column, $param, $value) {
		$db = new db();

		$sql = "DELETE FROM `{$this->table}` WHERE {$column} {$param} :value";

		$query = $db->pdo->prepare($sql);

		$query->execute([':value' => $value]);

		if($query->rowCount())
			$this->success = true;
	}

}

// $table = new table();

// $user = new user();
// $user->id(0);
// $user->search('id', '=', '1');
// $user->search('subject', 'LIKE', '%sad%');
// $user->insert([
// 	'subject'			=> 'mcc',
// 	'word' 				=> 'jfj',
// 	'definition' 	=> 'asdfg'
// ]);
// $user->update('subject', 'mcc', 'subject', '=', ':subject');
// $user->delete('subject', '=', 'mcc');

// print_r($user);

?>