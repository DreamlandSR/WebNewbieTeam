<?php
// Panggil Koneksi Database
require_once "../dbconfig.php";

// Inisialisasi objek Database
$db = new Database();
$conn = $db->getConnection();

// Mulai sesi
session_start();
require_once "../Auth.php";

$user = new Auth();
// Cek status login user
if (!$user->isLoggedIn()) {  
    header("location: login.php"); //Redirect ke halaman login  
    exit; // Tambahkan exit setelah header
}

// Ambil data user saat ini
$currentUser = $user->getCurrentUser();
if (!$currentUser) {
    echo "Error: Gagal mengambil data pengguna.";
    exit;
}

?>

<html>

<head>
    <title>Data Diri</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/profile.css">
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
        <div class="container">
            <div class="card">
                <h2>Data Diri</h2>
                <div class="profile">
                    <div class="left">
                        <img alt="Profile picture placeholder" height="100"
                            src="https://storage.googleapis.com/a1aa/image/EQfmn4Xbi2waCCbUEeHlR3z5FdjWdqNHXR3RVeCZ1uCD1CQnA.jpg"
                            class="rounded-circle img-thumbnail" width="100" />

                        <a href="editprofil.php">
                            <button>
                                <i class="fas fa-camera"> </i>
                                Edit Foto
                            </button>
                        </a>
                    </div>
                    <div class="right">
                        <div class="info">
                            <div>
                                <b> Nama </b>
                                <?php echo htmlspecialchars($currentUser['nama']);?>
                            </div>
                            <div>
                                <b> Email </b>
                                <?php echo htmlspecialchars($currentUser['email']);?>
                            </div>
                        </div>
                        <div class="info">
                            <div>
                                <b> NIP </b>
                                351010100020
                            </div>
                        </div>
                        <div class="info">
                            <div>
                                <b> No.Hp </b>
                                +6281-6664-5555
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>