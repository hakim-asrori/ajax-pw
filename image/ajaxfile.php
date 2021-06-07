<?php

include 'config.php';

$request = 3;

// Read $_GET value
if(isset($_GET['request'])){
	$request = $_GET['request'];
}

// Fetch records 
if($request == 1){

   // Select record 
	$sql = "SELECT * FROM image";
	$employeeData = mysqli_query($con,$sql);

	$response = array();
	
	$no = 1;
	while($row = mysqli_fetch_assoc($employeeData)){
		$response[] = array(
			"no"	  => $no++,
			"id_image" => $row['id_image'],
			"image" => $row['image'],
			"status" => $row['status'],
			);
	}

	echo json_encode($response);
	exit;
}

// Insert record
if($request == 2){

	$status = $_POST['status'];

	$namafile = $_FILES['image']['name'];
	$ukuranfile = $_FILES['image']['size'];
	$error = $_FILES['image']['error'];
	$tmpname = $_FILES['image']['tmp_name'];

	$ekstensiGambarValid = ['jpg','jpeg','png'];
	$ekstensiGambar = explode('.', $namafile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	$namafilebaru = uniqid();
	$namafilebaru .= '.';
	$namafilebaru .= $ekstensiGambar;

	move_uploaded_file($tmpname, '' . $namafilebaru);

	$response = 0;

	$query = $con->query("INSERT INTO image VALUES ('','$namafilebaru', '$status') ");

	if ($query != 0) {
		$response = 1;
	}

	echo $response;
	exit;

}
	
if ($request == 3) {
	
	$id = $_GET['id_image'];

	$sql = $con->query("SELECT * FROM image WHERE id_image = '$id'");
    $data_gambar = $sql->fetch_array();
    $image = $data_gambar['image'];
        
    if (file_exists("$image")) {
        unlink("$image");
    }

	$sql = $con->query("DELETE FROM image WHERE id_image = '$id'");

	if($sql){
		echo 1; 
	}else{
		echo 0;
	}

	exit;
}

if ($request == 4) {

	$id = $_GET["id_tipe"];
	$sql = $con->query("SELECT * FROM tipe_kamar WHERE id_tipe = '$id'");

	$data = array();

	while ($ambil = $sql->fetch_assoc()) {
		$data[] = array(
			'id_tipe' => $ambil['id_tipe'],
			'tipe_kamar' => $ambil['tipe_kamar'],
			'deskripsi' => $ambil['deskripsi'],
			'harga' => $ambil['harga'],
			'jumlah_bed' => $ambil['jumlah_bed']
			);
	}

	echo json_encode($data);
	exit;
}

if ($request == 5) {
	$data = json_decode(file_get_contents("php://input"));

	$id_tipe = $data->id_tipe;
	$tipe_kamar = $data->tipe_kamar;
	$deskripsi = $data->deskripsi;
	$harga = $data->harga;
	$jumlah_bed = $data->jumlah_bed;

	$sql = $con->query("UPDATE tipe_kamar SET tipe_kamar = '$tipe_kamar', deskripsi = '$deskripsi', harga = '$harga', jumlah_bed = '$jumlah_bed' WHERE id_tipe = $id_tipe");

	if($sql){
		echo 1; 
	}else{
		echo 0;
	}

	exit;
}