<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<input type="file" id="file" name="file">
<input type="text" id="status" name="">
<button id="upload-button" onclick="insert()">
	Insert
</button>

<script type="text/javascript">

	function insert() {
		var files = document.getElementById("file").files;
		var status = document.getElementById("status").value;

		if (files.length > 0) {
			var formData = new FormData();

			formData.append("file", files[0]);
			formData.append("status", status);
			var xhttp = new XMLHttpRequest();

			xhttp.open("POST", "coba-ajax-dua.php", true);

			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					var response = this.responseText;

					if (response == 1) {
						alert("Upload Sukses");

						document.getElementById("tipe_kamar").value = '';
						document.getElementById("deskripsi").value = '';
						document.getElementById("fasilitas").value = '';
						document.getElementById("harga").value = '';
						document.getElementById("jumlah_bed").value = '';
						document.getElementById("image").value = '';
						
					} else {
						alert("Upload Gagal");
					}
				}
			};

			xhttp.send(formData);
		} else {
			alert("Pilih Gambar");
		}
	}
</script>

</body>
</html>