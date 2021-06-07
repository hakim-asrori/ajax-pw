<div class="header">
	<span class="icon"><i class="fa fa-bars"></i></span>
	<span class="title">Tipe Kamar</span>
</div>
<br>

<div class="details">
	<div class="recentOrders">
		<div class="cardHeader">
			<h2>Data Tipe Kamar</h2>
			<a href="tambah.php" class="btn"><i class="fa fa-plus"></i> Tambah Data</a>
		</div>
		<table id="data">
			<thead>
				<tr>
					<td>No.</td>
					<td>Tipe Kamar</td>
					<td>Harga</td>
					<td>Jumlah Bed</td>
					<td>Image</td>
					<td>Aksi</td>
				</tr>
			</thead>
			<tbody id="table">
				
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">

	function loadTipeKamar() {

		let xhttp = new XMLHttpRequest();

		xhttp.open("GET", "ajaxFile.php?request=1", true);

		xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

		xhttp.onreadystatechange = function() {

			if (this.readyState == 4 && this.status == 200) {

				let response = JSON.parse(this.responseText);

				let empTable = document.getElementById("data").getElementsByTagName("tbody")[0];

				empTable.innerHTML = "";

				for (let key in response) {
					if (response.hasOwnProperty(key)) {

						let val = response[key];

						let NewRow = empTable.insertRow(-1);
						let no = NewRow.insertCell(0);
						let tipe_kamar = NewRow.insertCell(1);
						let harga = NewRow.insertCell(2);
						let jumlah_bed = NewRow.insertCell(3);
						let image = NewRow.insertCell(4);
						let aksi_cell = NewRow.insertCell(5);

						no.innerHTML = val['no'];
						tipe_kamar.innerHTML = val['tipe_kamar'];
						harga.innerHTML = val['harga'];
						jumlah_bed.innerHTML = val['jumlah_bed'];
						image.innerHTML = '<img width="100" src="image/'+val['image']+'">';
						aksi_cell.innerHTML = '<a href="?page=edit_kamar&id_tipe='+val["id_tipe"]+'" class="btn-warning" style="text-decoration: none;" onclick="edit('+ val['id_tipe'] +')" id="btn_edit"><i class="fa fa-edit"></i> Edit</a> &bull; <button class="btn-danger" onclick="hapus('+ val['id_tipe'] +')"><i class="fa fa-trash-o"></i> Hapus</button>';
					}
				}
			}

		};

		xhttp.send();
	}

	
	loadTipeKamar();
</script>