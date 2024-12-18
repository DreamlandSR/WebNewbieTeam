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
    $judul_tugas = $_POST['judul_tugas'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $video_url = $_POST['video_url'];

    // Periksa apakah file diunggah
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        // Konfigurasi folder tujuan
        $upload_dir = "uploads/"; // Pastikan folder ini sudah ada dan memiliki izin tulis
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Buat folder jika belum ada
        }

        // Proses file
        $file_name = time() . '_' . basename($_FILES['file']['name']);
        $file_path = $upload_dir . $file_name;


        if (move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
            // Baca data file sebagai biner
            $file_data = file_get_contents($file_path);

           // Query untuk menyimpan data ke database
            $stmt = $conn->prepare("INSERT INTO materi (jenis_materi, judul_tugas, deskripsi, deadline, video_url) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $file_name, $judul_tugas, $deskripsi, $deadline, $video_url);

            if ($stmt->execute()) {
                echo "<script>alert('File berhasil diunggah!'); document.location='menu_kelas.php';</script>";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "<script>alert('Gagal memindahkan file ke folder tujuan!'); document.location='menu_kelas.php';</script>";
        }
    } else {
        echo "<script>alert('File Gagal diunggah!'); document.location='menu_kelas.php';</script>";
    }
}

$conn->close();
?>