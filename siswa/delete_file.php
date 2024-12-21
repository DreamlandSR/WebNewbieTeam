<?php

// Koneksi ke database
$host = "localhost";  
$user = "root";       
$password = "";       
$dbname = "e_learning"; 

$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file_name = $_POST['file_name'];  // Ganti menjadi 'file_name' sesuai dengan input field di form
    $file_path = "upload_siswa/" . $file_name;

    if (file_exists($file_path)) {
        // Coba hapus file dari server
        if (unlink($file_path)) {
            // Hapus data dari database
            require '../dbconfig.php'; 
            $stmt = $conn->prepare("DELETE FROM pengumpulan WHERE file_tugas = ?");
            $stmt->bind_param("s", $file_name);

            if ($stmt->execute()) {
                echo "<script>alert('File berhasil dihapus!'); document.location='pengumpulan_siswa.php';</script>";
            } else {
                echo "<script>alert('Gagal menghapus data dari database!');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Gagal menghapus file!');</script>";
        }
    } else {
        echo "<script>alert('File tidak ditemukan!');</script>";
    }
}
?>