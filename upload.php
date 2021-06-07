<?php
	var_dump($_FILES);

	foreach ($_FILES['foto']['tmp_name'] as $key => $value) {
		$targetPath = "img/" . basename($_FILES['foto']['name'][$key]);
		move_uploaded_file($value, $targetPath);
	}
?>