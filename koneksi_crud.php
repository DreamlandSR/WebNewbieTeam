<?php

//Koneksi database 
$server = "localhost";
$user = "root";
$password = "";
$database = "e-learning";

//buat koneksi
$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));
?>