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

        <h3>STATUS PENGUMPULAN</h3>
        <div class="status-box">
            <div class="status-menu">
                <a href="#">Status pengumpulan</a>
                <a href="#">Status penilaian</a>
                <a href="#">Batas waktu</a>
                <a href="#">Sisa Waktu</a>
                <a href="#">terakhir diedit</a>
                <a href="#">Pengumpulan tugas</a>
            </div>
            <div class="status-content">
                <table>
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
                    <tr>
                        <td>File Tugas</td>
                    </tr>
                </table>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Masukkan Tugas
                </button>

                <!-- Awal Modal Tambah -->
                <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload File</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form method="POST" action="pengumpulan_siswa.php">
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Masukkan File</label>
                                        <input class="form-control" type="file" id="formFile" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Author</label>
                                        <input type="text" class="form-control" placeholder="Masukkan Nama Anda!"
                                            required>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"
                                            name="bsimpankelas">Simpan</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Keluar</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal Tambah -->

            </div>
        </div>

    </div>
    <script src="../js/script.js"></script>
</body>

</html>