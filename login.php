<?php
require 'vendor/autoload.php';
session_start();

use NewbieTeam\App\Auth;

$host = 'localhost';
$db   = 'e_learning';
$user = 'root'; 
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nama']) && isset($_POST['password'])) {
        $auth = new Auth($conn);
        $user = $auth->login($_POST['nama'], $_POST['password']);

        if ($user) {
            // Simpan nama dan sebagai ke session
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['sebagai'] = $user['sebagai'];

            // Redirect
            if ($user['sebagai'] === 'admin') {
                header("Location: admin.html");
            } else if ($user['sebagai'] === 'guru') {
                header("Location: guru.html");
            } else if ($user['sebagai'] === 'siswa') {
                header("Location: siswa.html");
            } else {
                header("Location: login.html?error=unknown_sebagai");
            }
            exit();
        } else {
            header("Location: login.html?error=wrong_credentials");
            exit();
        }
    } else {
        header("Location: login.html?error=empty_fields");
        exit();
    }
}
