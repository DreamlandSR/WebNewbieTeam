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
        <div class="actions d-flex align-items-center gap-3">
            <!-- Tombol Edit Class -->
            <button class="btn btn-primary"><i class="fas fa-edit"></i> Edit Class</button>
            <!-- Tombol Upload Materi -->
            <div class="dropdown-upload">
                <button class="btn btn-primary dropdown-toggle" type="button" id="uploadMateriButton"
                    onclick="dropdown()">
                    <i class="fas fa-plus"></i> Upload Materi
                </button>
                <ul class="dropdown-menu" id="dropdownOptions">
                    <li><a class="dropdown-item" href="uploadmateri.php" data-bs-toggle="modal"
                            data-bs-target="#modalTambah">Minggu
                            1</a></li>
                    <li><a class="dropdown-item" href="#">Minggu 2</a></li>
                    <li><a class="dropdown-item" href="#">Minggu 3</a></li>
                    <li><a class="dropdown-item" href="#">Minggu 4</a></li>
                </ul>
            </div>
        </div>

        <div class="week">
            <h2>Minggu 1</h2>
            <div class="lesson">
                <span>1. Pembelajaran Minggu ini terkait Eksponen dan algoritma silahkan
                    pelajari terlebih dahulu materi berikut</span><br>

            </div>
            <div class="lesson">
                <i class="bi bi-file-earmark-pdf-fill"></i><a href="#"> Pembelajaran Minggu ke-1: Materi Al - Jabar</a>
            </div>
            <div class="task">
                <i class="bi bi-file-earmark-pdf-fill"></i><a href="#">Tugas 1</a>
            </div>
            <h2>Minggu 2</h2>
            <div class="lesson">
                <span>1. Pembelajaran Minggu ini terkait Eksponen dan algoritma silahkan
                    pelajari terlebih dahulu materi berikut</span>
            </div>
            <div class="lesson">
                <a href="#">Pembelajaran Minggu ke-2: Materi Eksponen dan algoritma</a>
            </div>
        </div>
    </div>

    <!-- Awal Modal Tambah -->

    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahLabel">Upload File</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="pengumpulan_siswa.php">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Masukkan File</label>
                            <input class="form-control" type="file" id="formFile" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Author</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Anda!" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="bsimpankelas">Simpan</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
</body>

</html>