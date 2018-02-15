<?php


require_once 'db.php';

class table {
	protected $table;

	public function where($column, $param, $value) {
		$this->where[] = [
			'column' => $column,
			'param' => $param,
			'value' => $value,
		];

		return $this;
	}

	public function all() {
		$db = new db();

		// basic query for the function
		$this->sql[] = "SELECT * FROM `{$this->table}`";

		// generating where clause
		$this->whereclause();
				
		$query = $db->pdo->prepare($this->sql);

		$query->execute($this->values);

		if($query->rowCount()) {
			while($result = $query->fetch(PDO::FETCH_OBJ))
				$this->results[] = $result;
		}
	}

	public function whereclause() {
		$values = [];  // empty array for values to be passed in prepared statement
		if(isset($this->where)) {
			if(count($this->where)) {
				foreach($this->where as $where) {
					$w[] = $where['column'];
					$w[] = $where['param'];
					$w[] = '?';
					$values[] = $where['value'];

					$this->WHERE[] = implode(' ', $w);
					$this->values = $values;
					$w = [];
				}
				$this->sql[] = 'WHERE '.implode(' AND ', $this->WHERE);
			}
		}
		// unset($this->where);
		unset($this->WHERE);
		$this->sql = implode(' ', $this->sql);
	}



	public function get($count, $index = null) {
		$db = new db();

		// basic query for the function
		$this->sql[] = "SELECT * FROM `{$this->table}`";

		// generating where clause
		$this->whereclause();

		// appending limit clause
		if(!empty($index))
			$this->sql .= " LIMIT {$index}, {$count}";
		else
			$this->sql .= " LIMIT {$count}";
				
		$query = $db->pdo->prepare($this->sql);

		$query->execute($this->values);

		if($query->rowCount()) {
			while($result = $query->fetch(PDO::FETCH_OBJ))
				$this->results[] = $result;
		}
	}

	public function first() {
		$this->get(1);
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

	public function update($column, $value) {
		$db = new db();

		// basic query for the function
		$this->sql[] = "UPDATE `{$this->table}` SET {$column} = ?";

		// generating where clause
		$this->whereclause();
		// adding $value to start of $this->values
		array_unshift($this->values, $value);
				
		$query = $db->pdo->prepare($this->sql);

		$query->execute($this->values);
	}

	// public function update($column, $value, $wherecolumn, $whereparam, $wherevalue) {
	// 	$db = new db();

	// 	$sql = "UPDATE `{$this->table}` 
	// 					SET {$column} = :value
	// 					WHERE {$wherecolumn} {$whereparam} :wherevalue";

	// 	$query = $db->pdo->prepare($sql);

	// 	$query->execute([
	// 		':value' 			=> $value,
	// 		':wherevalue' => $wherevalue
	// 	]);

	// 	if($query->rowCount())
	// 		$this->success = true;
	// }


	public function delete($column, $param, $value) {
		$db = new db();

		$sql = "DELETE FROM `{$this->table}` WHERE {$column} {$param} :value";

		$query = $db->pdo->prepare($sql);

		$query->execute([':value' => $value]);

		if($query->rowCount())
			$this->success = true;
	}


	public function softdelete($column, $param, $value) {
		$db = new db();

		$sql = "UPDATE `{$this->table}` 
						SET deleted_at = NOW()
						WHERE {$column} {$param} :value";

		$query = $db->pdo->prepare($sql);

		$query->execute([
			':value' => $value
		]);

		if($query->rowCount())
			$this->success = true;
	}

}

// $table = new table();
// $table->softdelete('id', '=', '2');

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