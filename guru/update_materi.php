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

// Tangkap data dari form
$id_tugas = $_POST['id_tugas'];
$judul_tugas = $_POST['judul_tugas'];
$deskripsi = $_POST['deskripsi'];
$deadline = $_POST['deadline'];
$video_url = $_POST['video_url'];
$minggu = $_POST['minggu'];
$file_name = isset($_FILES['file']['name']) ? $_FILES['file']['name'] : null;

if (!empty($file_name)) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file_name);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        $query = "UPDATE materi SET minggu = ?, judul_tugas = ?, deskripsi = ?, deadline = ?, video_url = ?, jenis_materi = ? WHERE id_tugas = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssi", $minggu, $judul_tugas, $deskripsi, $deadline, $video_url, $file_name, $id_tugas);
    } else {
        die("Gagal mengunggah file.");
    }
} else {
    $query = "UPDATE materi SET minggu = ?, judul_tugas = ?, deskripsi = ?, deadline = ?, video_url = ? WHERE id_tugas = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $minggu, $judul_tugas, $deskripsi, $deadline, $video_url, $id_tugas);
}

if ($stmt->execute()) {
    echo "<script>alert('File berhasil diperbarui!'); document.location='menu_kelas.php';</script>";
} else {
    echo "<script>alert('File Gagal diperbarui!'); document.location='menu_kelas.php';</script>";
}

$stmt->close();
$conn->close();
?>