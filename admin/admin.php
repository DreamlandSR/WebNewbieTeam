<?php
session_start();
require_once "../Auth.php";
require_once "../dbconfig.php"; 

$user = new Auth();
// Cek status login user
if (!$user->isLoggedIn()) {  
    header("location: login.php"); //Redirect ke halaman login  
    exit; // Tambahkan exit setelah header
}

$db = new Database();
$conn = $db->getConnection();

$sql = "
    SELECT  
    (SELECT COUNT(*) FROM admins WHERE role_user = 'admin') AS total_admin,
    (SELECT COUNT(*) FROM guru) AS total_guru,
    (SELECT COUNT(*) FROM siswa) AS total_siswa,
    (SELECT COUNT(*) FROM mapel) AS total_mapel,
    (SELECT COUNT(*) FROM kelas) AS total_kelas
";

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $totalAdmin = $row['total_admin'];
    $totalGuru = $row['total_guru'];
    $totalSiswa = $row['total_siswa'];
    $totalMapel = $row['total_mapel'];
    $totalKelas = $row['total_kelas'];

} catch(PDOException $e){
    die("Query gagal: " . $e->getMessage());
}

// Ambil foto user dari tabel admins
$userId = $_SESSION['id']; 

$sqlFoto = "SELECT foto FROM admins WHERE id = :id";
try {
    $stmt = $conn->prepare($sqlFoto);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
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

$currentUser = $user->getCurrentUser();
if (!$currentUser) {
    echo "Error: Gagal mengambil data pengguna.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/admin.css">
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
        <a href="admin.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="daftar.php"><i class="bi bi-person-plus-fill"></i> Daftar Akun</a>
        <a href="kalender.php"><i class="bi bi-calendar-date"></i> Kalender </a>
        <a href="profile.php"><i class="bi bi-person-fill"></i> Profile</a>
        <a href="panduan.php"><i class="fas fa-book"></i> Panduan</a>
        <a class="dropdown-btn" href="javascript:void(0);" id="dropdown-btn" onclick="toggleDropdown()">
            Tabel Master
            <i class="fas fa-caret-down"> </i>
        </a>
        <div class="dropdown" id="dropdown">
            <a href="crudsiswa.php"> Siswa </a>
            <a href="crudguru_admin.php"> Guru </a>
            <a href="crud_kelas.php"> Master Kelas </a>
            <a href="crudmapel.php"> Master mapel</a>
            <a href="guruMapel.php"> Guru mapel</a>
            <a href="kelas.php"> Kelas</a>
        </div>
    </div>

    <div class="content">
        <div class="profile-card">
            <div class="profile-info">
                <!-- Menampilkan foto profil dalam format base64 -->
                <div class="name">
                    <?php if ($fotoData): ?>
                        <!-- Menampilkan foto profil jika ada -->
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($fotoData); ?>" alt="Foto Profil" class="rounded-circle" width="50" height="50">
                    <?php else: ?>
                        <!-- Menampilkan foto default jika tidak ada foto -->
                        <img src="../Foto/account.png" alt="Foto profil" class="rounded-circle" width="50" height="50">
                    <?php endif; ?>
                </div>

                <div class="profile-text">
                    <div class="name"><?php echo htmlspecialchars($currentUser['nama']); ?></div>
                    <div class="email"><?php echo htmlspecialchars($currentUser['role_user']); ?></div>
                </div>
            </div>
            <a href="profile.php">
                <button class="profile-button">Profile</button>
            </a>
        </div>

        <h1 class="stats-akun">Akun yang terdaftar</h1>
        <div class="stats">
            <div class="stat-card">
                <div class="stat-title">Akun Admin</div>
                <div class="stat-value"><?php echo $totalAdmin; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Akun Siswa</div>
                <div class="stat-value"><?php echo $totalSiswa; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Akun Guru</div>
                <div class="stat-value"><?php echo $totalGuru; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Mapel</div>
                <div class="stat-value"><?php echo $totalMapel; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-title">Kelas</div>
                <div class="stat-value"><?php echo $totalKelas; ?></div>
            </div>
        </div>

        <h1 class="stats-akun">Menu admin</h1>
        <div class="admin-menu">
            <div class="menu-title">Daftar Akun</div>
            <div class="menu-description">Menambahkan akun seperti Admin, Siswa, dan Guru untuk memulai pembelajaran
            </div>
            <a href="daftar.php"><button class="menu-button">Daftar</button></a>
        </div>
        <div class="admin-menu">
            <div class="menu-title">Profile</div>
            <div class="menu-description">Melihat data pribadi serta mengubah tampilan pada data diri</div>
            <a href="profile.php"><button class="menu-button">profile</button></a>
        </div>
        <div class="admin-menu">
            <div class="menu-title">Panduan</div>
            <div class="menu-description">Melihat panduan untuk masing - masing dari user</div>
            <a href="panduan.php"><button class="menu-button">Panduan</button></a>
            </div>
    </div>
    <script src="../js/script.js"></script>
</body>
</html>