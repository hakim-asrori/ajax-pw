<?php
$koneksi = new mysqli ("localhost", "root", "", "test");

if (!$koneksi) {
    die("Connection Failed");
}