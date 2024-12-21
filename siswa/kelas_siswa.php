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

// Fungsi untuk mengambil materi berdasarkan minggu
function getMateriByMinggu($conn, $minggu) {
    $query = "SELECT id_tugas, judul_tugas, deskripsi, jenis_materi, video_url FROM materi WHERE minggu = ? ORDER BY tanggal_dibuat DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $minggu);
    $stmt->execute();
    $result = $stmt->get_result();
    $materi = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $materi[] = $row;
        }
    }
    $stmt->close();
    return $materi;
}

// Ambil materi untuk masing-masing minggu
$materiMinggu1 = getMateriByMinggu($conn, 1);
$materiMinggu2 = getMateriByMinggu($conn, 2);

// Tutup koneksi
$conn->close();
?>

<html>

<head>
    <title>E - Learning</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/menu_kelas.css" />

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
        <a href="siswa.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="kalender.php"><i class="bi bi-calendar-date"></i> Kalender </a>
        <a href="profile.php"><i class="bi bi-person-fill"></i> Profile</a>
        <a href="panduan.php"><i class="fas fa-book"></i> Panduan</a>
        <a class="dropdown-btn" href="javascript:void(0);" id="dropdown-btn" onclick="toggleDropdown()">
            Kelas
            <i class="fas fa-caret-down"> </i>
        </a>
        <div class="dropdown" id="dropdown">
            <a href="kelas_siswa.php"> Matematika </a>
            <a href="kelas_siswa.php"> Penjaskes</a>
            <a href="kelas_siswa.php"> B.Jawa</a>
            <a href="kelas_siswa.php"> B.Inggris</a>
        </div>
    </div>
    <div class="content">
        <div class="container-menu">
            <h1>Matematika</h1>
            <div class="teacher-info">
                <i class="fas fa-user"></i>
                <span>Ismail Bin Mail</span>
            </div>
            <div class="breadcrumb">
                <a href="#">Dashboard</a> / <a href="#">Kelas</a> /
                <a href="#">Matematika</a>
            </div>
        </div>
        <div class="content">
            <div class="container-menu">
                <h1>Minggu 1</h1>
            </div>
            <div class="week">
                <h2>Materi dan Tugas</h2>
                <?php if (!empty($materiMinggu1)): ?>
                <?php foreach ($materiMinggu1 as $item): ?>
                <div class="lesson">
                    <h5><?php echo htmlspecialchars($item['judul_tugas']); ?></h5>
                    <p><?php echo htmlspecialchars($item['deskripsi']); ?></p>
                    <p><?php echo htmlspecialchars($item['jenis_materi']); ?></p>
                    <?php 
                $file_path = "../guru/uploads/" . htmlspecialchars($item['jenis_materi']);
            if (file_exists($file_path)): ?>
                    <a href="<?= $file_path; ?>" class="btn btn-success btn-sm" download>Unduh File</a>
                    <?php else: ?>
                    <p class="text-danger">File tidak ditemukan.</p>
                    <?php endif; ?>

                    <p><?php echo htmlspecialchars($item['video_url']); ?></p>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p>Belum ada materi atau tugas yang tersedia untuk minggu ini.</p>
                <?php endif; ?>
                <i class="fas fa-file-alt"></i>
                <a href="pengumpulan_siswa.php">Tugas Minggu 1</a>
            </div>
        </div>


        <div class="content">
            <div class="container-menu">
                <h1>Minggu 2</h1>
            </div>
            <div class="week">
                <h2>Materi dan Tugas</h2>
                <?php if (!empty($materiMinggu2)): ?>
                <?php foreach ($materiMinggu2 as $item): ?>
                <div class="lesson">
                    <h5><?php echo htmlspecialchars($item['judul_tugas']); ?></h5>
                    <p><?php echo htmlspecialchars($item['deskripsi']); ?></p>
                    <?php if (!empty($item['file_path']) && file_exists($item['file_path'])): ?>
                    <a href="<?php echo htmlspecialchars($item['file_path']); ?>" target="_blank"
                        class="btn btn-info">Lihat</a>
                    <a href="<?php echo htmlspecialchars($item['file_path']); ?>" class="btn btn-success"
                        download>Unduh</a>
                    <?php else: ?>
                    <p class="text-danger">File tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                <p>Belum ada materi atau tugas yang tersedia untuk minggu ini.</p>
                <?php endif; ?>
            </div>
        </div>

</body>
</div>
<script src="../js/script.js"></script>
</body>

</html>