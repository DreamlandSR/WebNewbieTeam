<?php
$hostName = "localhost";
$userName = "root";
$password = "";
$dbName = "e_learning";

// Buat koneksi
$koneksi = mysqli_connect($hostName, $userName, $password, $dbName);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Jangan ada output di sini
?>
