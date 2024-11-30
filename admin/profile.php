<?php
session_start();
require_once "../Auth.php";
require_once "../dbconfig.php";

$user = new Auth();
// Cek status login user
if (!$user->isLoggedIn()) {  
    header("location: login.php"); // Redirect ke halaman login  
    exit; // Tambahkan exit setelah header
}

$db = new Database();
$conn = $db ->getConnection();


$userId = $_SESSION['id']; // Mengambil ID user dari session

// Koneksi ke database
try {
    $conn = new PDO("mysql:host=".'localhost'.";dbname=".'e_learning', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Mendapatkan foto user yang ada
    $query = "SELECT foto FROM admins WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $userFoto = $stmt->fetchColumn(); // Menyimpan data foto yang ada
    
    // Mengupdate foto jika ada file baru yang diupload
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_FILES['fotoProfil']) && $_FILES['fotoProfil']['error'] == 0) {
            // Mendapatkan file yang di-upload
            $foto = $_FILES['fotoProfil']['tmp_name'];
            $fotoData = file_get_contents($foto); // Membaca file dan mengubahnya ke dalam format biner

            // Query untuk memperbarui foto di database
            $query = "UPDATE admins SET foto = :foto WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':foto', $fotoData, PDO::PARAM_LOB);
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Mengecek apakah foto berhasil diperbarui
            if ($stmt->rowCount() > 0) {
                echo "Foto berhasil diperbarui!";
                // Refresh halaman untuk melihat perubahan
                header("Location: profile.php");
                exit;
            } else {
                echo "Gagal memperbarui foto. Mungkin tidak ada perubahan!";
            }
        } else {
            echo "Tidak ada foto yang di-upload atau terjadi kesalahan saat upload.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$currentUser = $user->getUserAdmin();
if (!$currentUser) {
    echo "Error: Gagal mengambil data pengguna.";
    exit;
}

?>

<html>

<head>
    <title>Data Diri</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
        <a href="admin.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="daftar.php"><i class="bi bi-person-plus-fill"></i> Daftar Akun</a>
        <a href="kalender.php"><i class="bi bi-calendar-date"></i> Kalender </a>
        <a href="profile.php"><i class="bi bi-person-fill"></i> Profile</a>
        <a href="panduan.php"><i class="fas fa-book"></i> Panduan</a>
        <a class="dropdown-btn" href="javascript:void(0);" id="dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
            Tabel Master
            <i class="fas fa-caret-down"> </i>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdown-btn">
            <li><a class="dropdown-item" href="crudsiswa.php">Siswa</a></li>
            <li><a class="dropdown-item" href="crudguru_admin.php">Guru</a></li>
            <li><a class="dropdown-item" href="crud_kelas.php">Master Kelas</a></li>
            <li><a class="dropdown-item" href="crudmapel.php">Master mapel</a></li>
            <li><a class="dropdown-item" href="guruMapel.php">Guru mapel</a></li>
            <li><a class="dropdown-item" href="kelas.php">Kelas</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="container">
            <div class="card">
                <h2>Data Diri</h2>
                    <div class="profile">
                    <div class="left">
                        <form action="profile.php" method="POST" enctype="multipart/form-data">
                    <?php if ($userFoto): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($userFoto); ?>" alt="Foto Profil" class="rounded-circle" width="150" height="150">
                    <?php else: ?>
                        <img src="../images/default-profile.png" alt="Foto Profil" class="rounded-circle" width="150" height="150">
                    <?php endif; ?>
                    <div class="col-md-9" id="upload">
                        <!-- Tombol untuk membuka modal -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">Ganti Foto</button>
                    </div>
                    </div>
                    <div class="right">
                        <div class="info">
                            <div>
                                <b>Nama</b>
                                <div class="name"><?php echo isset($currentUser['nama']) ? htmlspecialchars($currentUser['nama']) : 'Nama tidak tersedia'; ?></div>
                            </div>
                        </div>
                        
                        <div class="info">
                            <div>
                                <b>Email</b>
                                <div class="name"><?php echo isset($currentUser['email']) ? htmlspecialchars($currentUser['email']) : 'Email tidak tersedia'; ?></div>
                            </div>
                        </div>

                        <div class="info">
                            <div>
                                <b>Role User</b>
                                <div class="name"><?php echo isset($currentUser['email']) ? htmlspecialchars($currentUser['role_user']) : 'role tidak tersedia'; ?></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Upload Foto Profil -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Pilih Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk memilih file foto -->
                    <form action="profile.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="fotoProfil" class="form-label">Pilih Foto</label>
                            <input type="file" name="fotoProfil" class="form-control" accept="image/*" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Upload Foto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
