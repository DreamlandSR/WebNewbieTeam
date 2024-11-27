<?php

// Konfigurasi database
$host = 'localhost';
$dbname = 'e_learning';
$username = 'root';
$password = '';

// Koneksi ke database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
// Ambil ID file
$id = $_GET['id'] ?? null;

if (!$id) {
    die('ID file tidak ditemukan.');
}

// Ambil data file berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM file_uploads WHERE id = ?");
$stmt->execute([$id]);
$file = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$file) {
    die('File tidak ditemukan.');
}

// Proses update file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $saveAs = htmlspecialchars($_POST['save_as']);

    if (!empty($_FILES['file']['name'])) {
        // Hapus file lama
        if (file_exists($file['file_path'])) {
            unlink($file['file_path']);
        }

        // Upload file baru
        $uploadDir = 'uploads/';
        $fileName = time() . '-' . basename($_FILES['file']['name']);
        $uploadFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) {
            $stmt = $pdo->prepare("UPDATE file_uploads SET file_name = ?, file_path = ?, save_as = ? WHERE id = ?");
            $stmt->execute([$fileName, $uploadFilePath, $saveAs, $id]);

            echo "<script>alert('File berhasil diperbarui.'); window.location.href = 'pengumpulan_siswa.php';</script>";
        } else {
            echo "<script>alert('Gagal mengunggah file baru.');</script>";
        }
    } else {
        // Update hanya metadata
        $stmt = $pdo->prepare("UPDATE file_uploads SET save_as = ? WHERE id = ?");
        $stmt->execute([$saveAs, $id]);

        echo "<script>alert('Nama tugas berhasil diperbarui.'); window.location.href = 'pengumpulan_siswa.php';</script>";
    }
}
?>