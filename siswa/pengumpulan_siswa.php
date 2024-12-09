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

// Validasi method request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

// Periksa apakah file diunggah
if (isset($_FILES['file_tugas']) && $_FILES['file_tugas']['error'] == 0) {
    $file_name = basename($_FILES['file_tugas']['name']); // Nama file
    $target_dir = "../uploads/"; // Folder penyimpanan
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES['file_tugas']['tmp_name'], $target_file)) {
        // Simpan nama file ke database
        $stmt = $conn->prepare("INSERT INTO pengumpulan (file_tugas) VALUES (?)");
        $stmt->bind_param("s", $file_name);
        if ($stmt->execute()) {
            echo "<script>alert('File berhasil diunggah!'); document.location='pengumpulan_siswa.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "<script>alert('Gagal mengunggah file ke server!');</script>";
    }
}

}

// Ambil file dari database
$result = $conn->query("SELECT id_pengumpulan, file_tugas FROM pengumpulan");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/pengumpulan_siswa.css" />

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
            <h2 class="text-center mb-4 fw-bold custom">Matematika</h2>
            <div class="teacher-info">
                <i class="fas fa-user"></i>
                <span>Ismail Bin Mail</span>
            </div>
            <div class="breadcrumb">
                <a href="#">Dashboard</a> / <a href="#">Kelas</a> /
                <a href="#">Matematika</a>
            </div>
        </div>

        <main class="container mt-4">
            <h2 class="text-center mb-4 fw-bold">STATUS PENGUMPULAN</h2>

            <div class="row">
                <div class="col-md-3">
                    <div class="status-menu p-3 bg-primary text-white">
                        <p>Status pengumpulan</p>
                        <p>Status penilaian</p>
                        <p>Batas waktu</p>
                        <p>Sisa Waktu</p>
                        <p>Terakhir diedit</p>
                        <p>Pengumpulan tugas</p>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="status-content p-4 bg-light border rounded">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Status Pengumpulan</td>
                                </tr>
                                <tr>
                                    <td>Belum dinilai</td>
                                </tr>
                                <tr>
                                    <td>Kamis, 19 September 2024, 17:00 PM</td>
                                </tr>
                                <tr>
                                    <td>1 Hari 15 Jam</td>
                                </tr>
                                <tr>
                                    <td>34 Menit lalu</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($files as $index => $file): ?>
                                <tr>
                                    <td><?= htmlspecialchars($file['file_tugas']); ?></td>
                                    <td>
                                        <?php
                $file_path = "uploads/" . htmlspecialchars($file['file_tugas']);
                $file_ext = pathinfo($file_path, PATHINFO_EXTENSION);

                // Cek jenis file dan tampilkan opsi sesuai
                if (in_array(strtolower($file_ext), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                        <img src="<?= $file_path; ?>" alt="Gambar" width="100">
                                        <?php elseif (strtolower($file_ext) === 'pdf'): ?>
                                        <?php endif; ?>

                                        <!-- Tombol Lihat -->
                                        <a href="<?= $file_path; ?>" target="blank"
                                            class="btn btn-info btn-sm">Lihat</a>
                                        <!-- Tombol Unduh -->
                                        <a href="<?= $file_path; ?>" class="btn btn-success btn-sm" download>Unduh</a>
                                        <!-- Tombol Hapus -->
                                        <form method="POST" action="delete_file.php" style="display:inline-block;">
                                            <input type="hidden" name="file_name"
                                                value="<?= htmlspecialchars($file['file_tugas']); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus file ini?');">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                            data-bs-target="#modalTambah">Masukkan
                            Tugas</button>
                    </div>
                </div>
            </div>
        </main>


        <!-- Awal Modal Tambah -->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload File</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="POST" action="pengumpulan_siswa.php" enctype="multipart/form-data">
                        <input type="hidden" name="id_tugas" value="1"> <!-- Ganti sesuai tugas -->
                        <input type="hidden" name="id_siswa" value="123"> <!-- Ganti sesuai siswa -->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Masukkan File</label>
                                <input class="form-control" type="file" id="file_tugas" name="file_tugas" required>
                            </div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="bsimpantugas">Simpan</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <!-- Akhir Modal Tambah -->

    </div>

    <script src="../js/script.js"></script>
</body>

</html>