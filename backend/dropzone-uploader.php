<?php
	if(isset($_FILES['image'])) {
		// exit if file extension is not allowed
		$filename = strtolower($_FILES['image']['name']);
		$filemeta = pathinfo(strtolower($filename));


		$allowed_file_extensions = ['jpg', 'jpeg', 'png', 'gif'];

		if(!in_array($filemeta['extension'], $allowed_file_extensions)) exit();

		$upload_target[] = $_SERVER['DOCUMENT_ROOT'];
		$upload_target[] = 'uploads';
		$upload_target[] = $_FILES['image']['name'];

		$upload_file = implode('/', $upload_target);

		while(file_exists($upload_file)) {
			$upload_target = explode('/', $upload_file);
			$filename = end($upload_target);
			array_pop($upload_target);

			$filemeta = pathinfo($filename);
			$filename = $filemeta['filename'].rand(0,9).'.'.$filemeta['extension'];

			$upload_target[] = $filename;

			$upload_file = implode('/', $upload_target);
		}

		if(move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
			$tmp = explode('/', $upload_file);
			echo '/uploads/'.end($tmp);
		}
	}
?>