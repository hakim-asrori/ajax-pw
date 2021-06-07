<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<input type="file" id="file" name="file">
<button id="upload-button" onclick="insert()">
	Insert
</button>

<script type="text/javascript">
	function insert() {
		var files = document.getElementById("file").files;

		if (files.length > 0) {
			var formData = new FormData();

			formData.append("file", files[0]);

			var xhttp = new XMLHttpRequest();

			xhttp.open("POST", "image.php", true);

			xhttp.onreadystatechange = function () {
				if (this.readyState == 4 && this.status == 200) {
					var response = this.responseText;

					if (response == 1) {
						alert("Upload Sukses");
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