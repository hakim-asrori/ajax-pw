<table>
	<input type="hidden" id="id_tipe">
	<tr>
		<td>Status</td>
		<td>:</td>
		<td>
			<input type="text" id='status'>
		</td>
	</tr>
	<tr>
		<td>Image</td>
		<td>:</td>
		<td>
			<input type="file" id="image" name="image">
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<input type="button" id="btn" value="Simpan" onclick="insert();">
			<button id="btn_update" onclick="update()" hidden>Update</button>
		</td>
	</tr>
</table>
<hr>

<fieldset>
	<legend>
		Data Employee
	</legend>
	<table id='empTable' border='1' cellpadding="10" >
		<thead>
			<tr>
				<th>No</th>
				<th>Image</th>
				<th>Status</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
</fieldset>

<script type="text/javascript">
	loadEmployees();

	function loadEmployees() {
		let xhttp = new XMLHttpRequest();

		xhttp.open("GET", "ajaxfile.php?request=1", true);

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {

				let response = JSON.parse(this.responseText);

				let empTable = document.getElementById("empTable").getElementsByTagName("tbody")[0];

				empTable.innerHTML = "";

				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						let NewRow = empTable.insertRow(0); 
						let no = NewRow.insertCell(0);
						let image = NewRow.insertCell(1); 
						let status = NewRow.insertCell(2);
						let aksi_cell = NewRow.insertCell(3);

						no.innerHTML = val['no'];
						image.innerHTML = '<img width="100" src='+val['image']+'>'; 
						status.innerHTML = val['status'];
						aksi_cell.innerHTML = '<button onclick="edit('+ val['id_image'] +')" id="btn_edit">Edit</button> &bull; <button onclick="hapus('+ val['id_image'] +')">Hapus</button>';
					}
				} 
			}
		};

		xhttp.send();
	}

	function insert() {
		let files = document.getElementById("image").files;
		let status = document.getElementById("status").value;

		if (files.length > 0) {
			var formData = new FormData();

			formData.append("image", files[0]);
			formData.append("status", status);

			var xhttp = new XMLHttpRequest();

			xhttp.open("POST", "ajaxfile.php?request=2", true);

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

	function hapus(id_image) {
		let xhttp = new XMLHttpRequest();
		let konfirmasi = confirm("Yakin ? Mau di Hapus ?");

		if (konfirmasi) {
			xhttp.open("GET", "ajaxfile.php?request=3&id_image="+id_image, true);

			xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Delete successfully.");

						loadEmployees();
					}

				}
			};

			xhttp.send();

		}
	}

	function edit(id_tipe) {
		let tipe_kamar = document.getElementById('tipe_kamar');
		let deskripsi = document.getElementById('deskripsi');
		let harga = document.getElementById('harga');
		let jumlah_bed = document.getElementById('jumlah_bed');
		let btn = document.getElementById('btn');
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		btn.hidden = true;
		btn_update.hidden = false;

		let xhttp = new XMLHttpRequest();
		xhttp.open("GET", "ajaxfile.php?request=4&id_tipe="+id_tipe, true);

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {

				let response = JSON.parse(this.responseText);

				for (let key in response) {
					if (response.hasOwnProperty(key)) {
						let val = response[key];

						tipe_kamar.value = val['tipe_kamar'];
						deskripsi.value = val['deskripsi'] 
						harga.value = val['harga']; 
						jumlah_bed.value = val['jumlah_bed'];
						document.getElementById("id_tipe").value = val['id_tipe'];

					}
				} 

			}
		};

		xhttp.send();
	}

	function update() {

		let id_tipe = document.getElementById('id_tipe').value;
		let tipe_kamar = document.getElementById('tipe_kamar').value;
		let deskripsi = document.getElementById('deskripsi').value;
		let harga = document.getElementById('harga').value;
		let jumlah_bed = document.getElementById('jumlah_bed').value;
		let btn_edit = document.getElementById('btn_edit');
		let btn_update = document.getElementById('btn_update');

		if(tipe_kamar != '' && deskripsi !='' && harga != '' && jumlah_bed != ''){

			let data = { id_tipe : id_tipe, tipe_kamar : tipe_kamar, deskripsi : deskripsi, harga : harga,jumlah_bed : jumlah_bed};

			let xhttp = new XMLHttpRequest();

			xhttp.open("POST", "ajaxfile.php?request=5", true);

			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {

					let response = this.responseText;
					if(response == 1){
						alert("Update successfully.");

						loadEmployees();

						document.getElementById("id_tipe").value = '';
						document.getElementById("tipe_kamar").value = '';
						document.getElementById("deskripsi").value = '';
						document.getElementById("harga").value = '';
						document.getElementById("jumlah_bed").value = '';

						btn.hidden = false;
						btn_update.hidden = true;
					}
				}
			};

			xhttp.setRequestHeader("Content-Type", "application/json");

			xhttp.send(JSON.stringify(data));
		}
	}


</script>