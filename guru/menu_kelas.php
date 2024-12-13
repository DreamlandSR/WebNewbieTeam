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

// Ambil file dari database
$result = $conn->query("SELECT id_tugas, jenis_materi, judul_tugas, deskripsi FROM materi");
$files = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $files[] = $row;
    }
}

$conn->close();
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
    <link rel="stylesheet" href="../css/menu_kelas.css" />
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
        <div class="container-menu">
            <h1>Matematika</h1>
            <div class="teacher-info">
                <i class="fas fa-user"></i>
                <span>Ismail Bin Mail</span>
            </div>
            <div class="breadcrumb">
                <a href="#">Dashboard</a> / <a href="#">Kelas</a> / <a href="#">Matematika</a>
            </div>
        </div>
        <div class="actions d-flex align-items-center gap-3">
            <!-- Tombol Edit Class -->
            <button class="btn btn-primary"><i class="fas fa-edit"></i> Edit Class</button>
            <!-- Tombol Upload Materi -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#materiModal">
                <i class="fas fa-plus"></i> Upload Materi
            </button>
        </div>

        <div class="week">
            <h1>Minggu 1</h1>
            <?php if (!empty($files)): ?>
            <?php foreach ($files as $file): ?>
            <div class="lesson">
                <h5><?php echo htmlspecialchars($file['judul_tugas']); ?></h5>
                <p><?php echo htmlspecialchars($file['deskripsi']); ?></p>
                <p><?php echo htmlspecialchars($file['jenis_materi']); ?></p>
                <?php
         // Periksa apakah file ada di folder uploads
         $file_path = "uploads/" . htmlspecialchars($file['jenis_materi']);

        // Validasi file sebelum menampilkan tombol
         if (file_exists($file_path)): ?>
                <!-- Tombol Lihat -->
                <a href="<?= $file_path; ?>" target="_blank" class="btn btn-info btn-sm">Lihat</a>
                <!-- Tombol Unduh -->
                <a href="<?= $file_path; ?>" class="btn btn-success btn-sm" download>Unduh</a>
                <!-- Tombol Hapus -->
                <form method="POST" action="delete_file.php" style="display:inline-block;">
                    <input type="hidden" name="file_name" value="<?= htmlspecialchars($file['jenis_materi']); ?>">
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus file ini?');">Hapus</button>
                </form>
                <?php else: ?>
                <p class="text-danger">File tidak ditemukan di server.</p>
                <?php endif; ?>
            </div>

            <?php endforeach; ?>
            <?php else: ?>
            <p>Belum ada materi atau tugas yang tersedia.</p>
            <?php endif; ?>
        </div>

    </div>


    <!-- Modal Tambah Materi -->
    <div class="modal fade" id="materiModal" tabindex="-1" aria-labelledby="materiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materiModalLabel">Tambah Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Upload Materi -->
                    <form id="materiForm" enctype="multipart/form-data" action="upload.php" method="POST">

                        <div class="mb-3">
                            <label for="judulTugas" class="form-label">Judul Tugas</label>
                            <input type="text" class="form-control" id="judulTugas" name="judul_tugas"
                                placeholder="Judul Tugas atau Materi">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi (optional)</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"
                                placeholder="Deskripsi Materi"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Batas Waktu</label>
                            <input type="datetime-local" class="form-control" id="deadline" name="deadline">
                        </div>
                        <div class="mb-3">
                            <label for="videoURL" class="form-label">Video URL (optional)</label>
                            <input type="url" class="form-control" id="videoURL" name="video_url"
                                placeholder="Link URL">
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File</label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <div class="form-actions d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary" name="bsimpanmateri">Simpan</button>
                            <button type=" reset" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>