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

// Ambil data file dari database
$stmt = $pdo->prepare("SELECT * FROM file_uploads WHERE id = ?");
$stmt->execute([$id]);
$file = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$file) {
    die('File tidak ditemukan.');
}

// Hapus file dari server
if (file_exists($file['file_path'])) {
    unlink($file['file_path']);
}

// Hapus data dari database
$stmt = $pdo->prepare("DELETE FROM file_uploads WHERE id = ?");
$stmt->execute([$id]);

echo "<script>alert('File berhasil dihapus.'); window.location.href = 'pengumpulan_siswa.php';</script>";
?>