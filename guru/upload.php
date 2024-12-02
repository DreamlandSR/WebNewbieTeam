<?php
// Koneksi ke database
$host = "localhost";  // Ganti sesuai konfigurasi Anda
$user = "root";       // Ganti dengan user database Anda
$password = "";       // Ganti dengan password database Anda
$dbname = "e_learning"; // Nama database

$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Validasi method request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
$file_data = $_POST['jenis_materi'];
$judul_tugas = $_POST['judul_tugas'];
$deskripsi = $_POST['deskripsi'];
$deadline = $_POST['deadline'];
$video_url = $_POST['video_url'];

// Periksa apakah file diunggah
if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
    // Ambil informasi file
    $file_data = file_get_contents($_FILES['file']['tmp_name']); // Baca data file biner

    // Query untuk menyimpan data ke database
    $stmt = $conn->prepare("INSERT INTO materi (jenis_materi, judul_tugas, deskripsi, deadline, video_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param( "sssss",$file_data, $judul_tugas, $deskripsi, $deadline, $video_url);

    if ($stmt->execute()) {
        echo "Data dan file berhasil disimpan ke database.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "File tidak diunggah atau terjadi kesalahan.";
}
}

$conn->close();
?>