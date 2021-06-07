<?php

include 'config.php';

if (isset($_FILES['file']['name'])) {
	$filename = $_FILES['file']['name'];

	$location = "img/";

	$path = $location.$filename;

	$file_extension = pathinfo($path, PATHINFO_EXTENSION);
	$file_extension = strtolower($file_extension);

	$valid_ext = array("pdf", "jpg");

	$response = 0;

	if (in_array($file_extension, $valid_ext)) {
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $path)) {
			
			$con->query("INSERT INTO image (id_image, image) VALUES ('','$filename') ");
			$response = 1;
		}
	}
	echo $response;
	exit;
}

?>