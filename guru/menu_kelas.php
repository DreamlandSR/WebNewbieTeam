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
        </div>
    </div>

    <!-- Modal Tambah Materi -->
    <div class="modal fade" id="materiModal" tabindex="-1" aria-labelledby="materiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materiModalLabel">Tambah Materi </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="materiForm" enctype="multipart/form-data" action="upload.php" method="POST">

                        <div class="mb-3">
                            <label for="jenisMateri" class="form-label">Jenis Materi</label>
                            <input type="text" class="form-control" id="jenisMateri" name="jenis_materi"
                                placeholder="PDF, Docx, PNG, dll.">
                        </div>
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
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script>
</body>

</html>