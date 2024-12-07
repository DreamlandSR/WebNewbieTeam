<?php

// Panggil Koneksi Database
require_once "../dbconfig.php";
require_once "../Auth.php";

// Inisialisasi objek Database
$db = new Database();
$conn = $db->getConnection();

if (!$conn) {
    die("Error: Gagal terhubung ke database.");
}

session_start();

// Inisialisasi Auth
$user = new Auth();
        
// Cek status login user
if (!$user->isLoggedIn()) {  
    header("Location: login.php"); // Redirect ke halaman login
    exit; // Tambahkan exit setelah header
}

// Ambil data user saat ini
$currentUser = $user->getCurrentUser();
if (!$currentUser) {
    echo "Error: Gagal mengambil data pengguna.";
    exit;
}

// Persiapkan query untuk mengambil data pengumpulan tugas
$stmt = $conn->prepare("
    SELECT 
        p.id_pengumpulan, 
        p.file_tugas, 
        s.nama AS nama_siswa,  
        p.waktu_pengumpulan 
    FROM pengumpulan p
    JOIN siswa s ON p.id_siswa = s.id_siswa
    JOIN materi t ON p.id_tugas = t.id_tugas
    WHERE t.id_guru = t.id_guru
");

// Bind parameter
$id_guru = 1; // Ganti dengan ID guru yang sedang login
$stmt->bindParam(1, $id_guru, PDO::PARAM_INT);

// Eksekusi query
$stmt->execute();

// Ambil hasil query
$files = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Periksa apakah ada data
if (count($files) === 0) {
    echo "Tidak ada data pengumpulan tugas ditemukan.";
}

?>


<html>

<head>
    <title>E-Learning</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Nama Tugas</th>
                <th>File</th>
                <th>Tanggal Upload</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
            <tr>
                <td><?= htmlspecialchars($file['nama_siswa']); ?></td>
                <td><?= htmlspecialchars($file['nama_tugas']); ?></td>
                <td><a href="uploads/<?= htmlspecialchars($file['file_tugas']); ?>" target="_blank">Lihat</a></td>
                <td><?= htmlspecialchars($file['upload_date']); ?></td>
                <td>
                    <a href="uploads/<?= htmlspecialchars($file['file_tugas']); ?>" download>Unduh</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>