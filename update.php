<?php

include "koneksi.php";

$data = json_decode(file_get_contents("php://input"));

$nama = $data->nama;
$gaji = $data->gaji;
$email = $data->email;
$id = $_GET['id'];

$sql = $koneksi->query("UPDATE employee SET nama = '$nama', gaji = '$gaji', email = '$email' WHERE id = '$id'");

if($sql){
    echo 1; 
}else{
    echo 0;
}

exit;