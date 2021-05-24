<?php

include "koneksi.php";
$id = $_GET["id"];
$sql = $koneksi->query("SELECT * FROM employee WHERE id = '$id'");

$data = array();

while ($ambil = $sql->fetch_assoc()) {
    $data[] = array(
        'id' => $ambil['id'],
        'nama' => $ambil['nama'],
        'gaji' => $ambil['gaji'],
        'email' => $ambil['email']
    );
}

echo json_encode($data);
exit;