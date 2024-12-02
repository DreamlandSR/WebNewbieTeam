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
    // Ambil data dari form
$file_data = $_POST['file_tugas'];

// Periksa apakah file diunggah
if (isset($_FILES['file_tugas']) && $_FILES['file_tugas']['error'] == 0) {
    // Ambil informasi file
    $file_data = file_get_contents($_FILES['file_tugas']['tmp_name']); // Baca data file biner

    // Query untuk menyimpan data ke database
    $stmt = $conn->prepare("INSERT INTO pengumpulan (file_tugas) VALUES (?)");
    $stmt->bind_param( "s",$file_data);

    if ($stmt->execute()) {
        echo "Data dan file berhasil disimpan ke database.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "File tidak diunggah atau terjadi kesalahan.";
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
                        <table class="table mb-4">
                            <tbody>
                                <tr>
                                    <td>Belum mengumpulkan</td>
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
                                <td colspan="4" class="text-center">Belum ada file yang diunggah</td>
                                </tr>
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


        <!-- Awal Modal Update -->
        <div class="modal fade" id="modalUbah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form method="POST" action="pengumpulan_siswa.php" enctype="multipart/form-data">
                        <!-- Input hidden untuk ID -->
                        <input type="hidden" name="id">

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Masukkan File Baru</label>
                                <input class="form-control" type="file" id="formFile" name="file">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama File Lama</label>
                                <input type="text" class="form-control" name="file_old">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Save As</label>
                                <input type="text" class="form-control" name="save_as"
                                    placeholder="Masukkan Nama Tugas Anda!" required>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="bubah">Update File</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Akhir Modal Update -->

    </div>
    </div>

    </div>
    <script src="../js/script.js"></script>
</body>

</html>