<?php

include 'config.php';


$filename = $_FILES['file']['name'];
$status = $_POST['status'];
$location = "img/";

$path = $location.$filename;

$file_extension = pathinfo($path, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

$valid_ext = array("pdf", "jpg");

$response = 0;

if (in_array($file_extension, $valid_ext)) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $path)) {

        $con->query("INSERT INTO image VALUES ('','$filename', '$status') ");
        $response = 1;
    }
}
echo $response;
exit;

?>