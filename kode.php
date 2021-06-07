<?php
	include 'config.php';

	$data = json_decode(file_get_contents("php://input"));

	foreach ($_FILES['images']['error'] as $key => $error) {
		if ($error == UPLOAD_ERR_OK) {
			$name = $_FILES['images']['name'][$key];

			$status = $data->status;

			move_uploaded_file($_FILES['images']['tmp_name'][$key], "img/" . $_FILES["images"]["name"][$key]);
				
			$query = $con->query("INSERT INTO image VALUES('','$name', '$status')");
		}
	}
	echo "<h2>Berhasil</h2>";
?>