<?php
$koneksi = new mysqli ("localhost", "root", "", "coba_ya");

if (!$koneksi) {
    die("Connection Failed");
}