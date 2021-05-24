<?php

include "koneksi.php";

$sql = $koneksi->query("SELECT * FROM employee");

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