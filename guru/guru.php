<?php

session_start();

require_once("../Auth.php");
require_once("../dbconfig.php");

$user = new Auth();
// Cek status login user
if (!$user->isLoggedIn()) {  
    header("location: login.php"); //Redirect ke halaman login  
    exit; // Tambahkan exit setelah header
}

$db = new Database();
$conn = $db->getConnection();

// Ambil data user saat ini
$currentUser = $user->getCurrentUser();
if (!$currentUser) {
    echo "Error: Gagal mengambil data pengguna.";
    exit;
}

$sql = "
    SELECT  
    (SELECT COUNT(*) FROM kelas_mapel) AS total_kelas_mapel,
    (SELECT COUNT(*) FROM siswa) AS total_siswa,
    (SELECT COUNT(*) FROM mapel) AS total_mapel,
    (SELECT COUNT(*) FROM materi) AS total_materi
";

try {
    $stmt = $conn ->prepare($sql);
    $stmt -> execute ();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $totalKelasMapel = $row['total_kelas_mapel'];
    $totalSiswa = $row['total_siswa'];
    $totalMapel = $row['total_mapel'];
    $totalMateri = $row['total_materi'];

} catch(PDOException $e){
    die("Query gagal: " . $e->getMessage());
}

// Ambil foto user dari tabel guru
 
$sqlFoto = "SELECT foto FROM guru WHERE id_guru = :id_guru";
try {
    $stmt = $conn->prepare($sqlFoto);
    $stmt->bindParam(':id_guru', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $fotoData = $row['foto']; 
    } else {
        $fotoData = null;
    }

} catch(PDOException $e) {
    die("Query gagal: " . $e->getMessage());
}

// Ambil data user saat ini
$currentUser = $user->getCurrentUser();
if (!$currentUser) {
    echo "Error: Gagal mengambil data pengguna.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <script src="js/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-..." crossorigin="anonymous">
    <link rel="stylesheet" href="../css/guru.css">
    <title>Guru</title>
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
        <a class="dropdown-btn" href="javascript:void(0);" id="dropdown-btn" onclick="toggleDropdown()">
            Kelas
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
        <div class="profile-card">
            <div class="profile-info">

                <!-- Menampilkan foto profil dalam format base64 -->
                <div class="name">
                    <?php if ($fotoData): ?>
                    <!-- Menampilkan foto profil jika ada -->
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($fotoData); ?>" alt="Foto Profil"
                        class="rounded-circle" width="50" height="50">
                    <?php else: ?>
                    <!-- Menampilkan foto default jika tidak ada foto -->
                    <img src="../Foto/account.png" alt="Foto profil" class="rounded-circle" width="50" height="50">
                    <?php endif; ?>
                </div>

                <div class="profile-text">
                    <div class="name"><?php echo htmlspecialchars($currentUser['nama']); ?></div>
                    <div class="role"><?php echo htmlspecialchars($currentUser['role_user']); ?></div>
                </div>
            </div>
            <a href="profile.php">
                <button class="profile-button">Profile</button>
            </a>
        </div>
        <h1 class="stats-akun">Informasi singkat Guru</h1>
        <div class="stats">
            <div class="stat-card">
                <div class="stat-title">Kelas yang di ampu</div>
                <div class="stat-value"><?php echo $totalKelasMapel; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Siswa Binaan</div>
                <div class="stat-value"><?php echo $totalSiswa; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Mapel yang di ampu</div>
                <div class="stat-value"><?php echo $totalMapel; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Materi</div>
                <div class="stat-value"><?php echo $totalMateri; ?></div>
            </div>
        </div>
        <div class="grid-container">
            <div class="card">
                <a href="../guru/materi_dosen.php">
                    <h3>XII TKJ 1</h3>
                </a>
                <ul>
                    <li><i class="fas fa-user"></i> 32 Siswa</li>
                </ul>
            </div>
            <div class="card">
                <h3>XII TKJ 2</h3>
                <ul>
                    <li><i class="fas fa-user"></i> 31 Siswa</li>
                </ul>
            </div>
            <div class="second-card">
                <h3>Tugas</h3>
                <ul>
                    <li class="heading">
                        <span class="class-title">XII TKJ 1</span>
                        <i class="fas fa-folder"></i> <span>Cek hasil tugas</span>
                    </li>
                    <li class="heading">
                        <span class="class-title">XII MM 2</span>
                        <i class="fas fa-folder"></i> <span>Cek hasil tugas</span>
                    </li>
                </ul>
            </div>
            <div class="card">
                <h3>XII MM 1</h3>
                <ul>
                    <li><i class="fas fa-user"></i> 32 Siswa</li>
                </ul>
            </div>
            <div class="card">
                <h3>XII MM 2</h3>
                <ul>
                    <li><i class="fas fa-user"></i> 29 Siswa</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="school-info">
            <img src="../Foto/smk7 jember.png" alt="School Emblem" />
            <p>SMK Negeri 7 Jember</p>
        </div>
        <div class="contact-info">
            <p id="footer-contact">Contact</p>
            <p><i class="fas fa-envelope"></i> smkn7jember@gmail.com</p>
            <p><i class="fas fa-globe"></i> https://smkn7jember.sch.id/</p>
            <p><i class="fas fa-phone"></i> +6281-8094-0000</p>
        </div>
    </div>
    </footer>
    <script src="../js/script.js"></script>
</body>

</html>