<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "e_learning";

$koneksi = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if ($koneksi) {
    echo "Koneksi berhasil";
} else {
    echo "Koneksi gagal";
}
?>