<?php

include "koneksi.php";

$data = json_decode(file_get_contents("php://input"));

$nama = $data->nama;
$gaji = $data->gaji;
$email = $data->email;

$sql = $koneksi->query("INSERT INTO employee (nama, gaji, email) VALUES ('$nama', '$gaji', '$email')");

if($sql){
    echo 1; 
}else{
    echo 0;
}

exit;