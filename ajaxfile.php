<?php

include "config.php";

$request = 3;

// Read $_GET value
if(isset($_GET['request'])){
	$request = $_GET['request'];
}

// Fetch records 
if($request == 1){

   // Select record 
	$i = 1;
	$sql = "SELECT * FROM tipe_kamar ORDER BY tipe_kamar ASC";
	$employeeData = mysqli_query($con,$sql);

	$response = array();
	
	while($row = mysqli_fetch_assoc($employeeData)){
		$response[] = array(
			"no" => $i++,
			"id_tipe" => $row['id_tipe'],
			"tipe_kamar" => $row['tipe_kamar'],
			"deskripsi" => $row['deskripsi'],
			"harga" => $row['harga'],
			"jumlah_bed" => $row['jumlah_bed'],
			);
	}

	echo json_encode($response);
	exit;
}

// Insert record
if($request == 2){

   // Read POST data
	$data = json_decode(file_get_contents("php://input"));

	$tipe_kamar = $data->tipe_kamar;
	$deskripsi = $data->deskripsi;
	$harga = $data->harga;
	$jumlah_bed = $data->jumlah_bed;
	

   // Insert record
	$sql = "insert into tipe_kamar values('', '$tipe_kamar', '$deskripsi', '$harga', '$jumlah_bed')";
	if(mysqli_query($con,$sql)){
		echo 1; 
	}else{
		echo 0;
	}

	exit;
}

if ($request == 3) {

	$id = $_GET["id_tipe"];
	$sql = $con->query("DELETE FROM tipe_kamar WHERE id_tipe = '$id'");

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