load();

function load() {
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "tampil.php", true);

    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            let response = JSON.parse(this.responseText);
            let empTable = document.getElementById("data").getElementsByTagName("tbody")[0];

            empTable.innerHTML = "";

            for (let key in response) {
                if (response.hasOwnProperty(key)) {
                    let val = response[key];

                    let NewRow = empTable.insertRow(0); 
                    let nama_cell = NewRow.insertCell(0); 
                    let gaji_cell = NewRow.insertCell(1); 
                    let email_cell = NewRow.insertCell(2);
                    let aksi_cell = NewRow.insertCell(3);

                    nama_cell.innerHTML = val['nama']; 
                    gaji_cell.innerHTML = val['gaji']; 
                    email_cell.innerHTML = val['email']; 
                    aksi_cell.innerHTML = '<button onclick="edit('+ val['id'] +')" id="btn_edit">Edit</button> | <button onclick="hapus('+ val['id'] +')">Hapus</button>'; 
                    
                }
            } 

        }
    };

    xhttp.send();

    
}

function insert() {

    let nama = document.getElementById('nama').value;
    let gaji = document.getElementById('gaji').value;
    let email = document.getElementById('email').value;

    if(nama != '' && gaji !='' && email != ''){

        let data = {nama: nama, gaji: gaji, email: email};
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "insert.php", true);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                let response = this.responseText;
                if(response == 1){
                    alert("Insert successfully.");

                    load();
                }
            }
        };

    xhttp.setRequestHeader("Content-Type", "application/json");

    xhttp.send(JSON.stringify(data));
    }

}

function edit(id) {
    let nama = document.getElementById('nama');
    let gaji = document.getElementById('gaji');
    let email = document.getElementById('email');
    let btn = document.getElementById('btn');
    let btn_edit = document.getElementById('btn_edit');
    let btn_update = document.getElementById('btn_update');
    
    btn.hidden = true;
    btn_update.hidden = false;

    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "tampil_with_id.php?id="+id, true);

    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            let response = JSON.parse(this.responseText);

            for (let key in response) {
                if (response.hasOwnProperty(key)) {
                    let val = response[key];

                    nama.value = val['nama']; 
                    gaji.value = val['gaji']; 
                    email.value = val['email'];
                    document.getElementById("id").value = val['id'];

                }
            } 

        }
    };

    xhttp.send();
}

function hapus(id) {
    let xhttp = new XMLHttpRequest();

    xhttp.open("GET", "hapus.php?id="+id, true);

    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            let response = this.responseText;
            if(response == 1){
                alert("Delete successfully.");

                load();
            }

        }
    };

    xhttp.send();
}

function update() {
    let nama = document.getElementById('nama').value;
    let gaji = document.getElementById('gaji').value;
    let email = document.getElementById('email').value;
    let id = document.getElementById("id").value;

    if(nama != '' && gaji !='' && email != ''){

        let data = {nama: nama, gaji: gaji, email: email, id: id};
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "update.php", true);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                let response = this.responseText;
                if(response == 1){
                    alert("Update successfully.");

                    location.reload(load())
                }
            }
        };

        xhttp.setRequestHeader("Content-Type", "application/json");

        xhttp.send(JSON.stringify(data));
    }
}