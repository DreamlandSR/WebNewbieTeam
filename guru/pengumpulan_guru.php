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
        p.waktu_pengumpulan AS upload_date
    FROM pengumpulan p
    JOIN siswa s ON p.id_siswa = s.id_siswa
    JOIN materi t ON p.id_tugas = t.id_tugas
    WHERE t.id_guru = ?
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
    <title>E - Learning</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <script src="js/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-..." crossorigin="anonymous">
    <link rel="stylesheet" href="../css/pengumpulan_guru.css" />
</head>

<body>
    <div class="header">
        <div class="logo">
            <i class="fas fa-bars menu-icon"></i>
            <img src="../Foto/smk7 jember.png" alt="School Logo" />
            <span class="text-elearning">E-Learning</span>
        </div>
        <a href="../logout.php" class="logout">Keluar</a>
    </div>
    <div class="sidebar">
        <a href="guru.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="kalender.php"><i class="bi bi-calendar-date"></i> Kalender </a>
        <a href="profile.php"><i class="bi bi-person-fill"></i> Profile</a>
        <a href="panduan.php"><i class="fas fa-book"></i> Panduan</a>
        <a href="pengumpulan_guru.php"><i class="fas fa-book"></i> Pengumpulan Tugas</a>
        <a class="dropdown-btn" href="javascript:void(0);" id="dropdown-btn" onclick="toggleDropdown()">Kelas
            <i class="fas fa-caret-down"> </i>
        </a>
        <div class="dropdown" id="dropdown">
            <a href="menu_kelas.php"> XII TKJ 1 </a>
            <a href="menu_kelas.php"> XII TKJ 2</a>
            <a href="menu_kelas.php"> XII MM 1 </a>
            <a href="menu_kelas.php"> XII MM 2 </a>
        </div>
    </div>
    <div class="content">

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