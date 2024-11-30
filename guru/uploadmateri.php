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

        <!-- Main Form -->
        <div class="form-container mt-3">
            <h2 class="h5 mb-4">Minggu ke - 1</h2>
            <form>
                <div class="mb-3">
                    <label for="judulMateri" class="form-label">Judul Materi</label>
                    <input type="text" class="form-control" id="judulMateri" placeholder="Masukkan Judul Materi!    ">
                </div>
                <div class="mb-3">
                    <label for="batasWaktu" class="form-label">Batas Waktu</label>
                    <input type="datetime-local" class="form-control" id="batasWaktu">
                </div>
                <div class="mb-3">
                    <label for="jenisFile" class="form-label">Jenis File</label>
                    <input type="text" class="form-control" id="jenisFile" placeholder="PDF, Docx, PNG, JPEG" disabled>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi (optional)</label>
                    <textarea class="form-control" id="deskripsi" rows="3" placeholder="Deskripsi Materi"></textarea>
                </div>
                <div class="mb-3">
                    <label for="videoURL" class="form-label">Video URL (optional)</label>
                    <input type="url" class="form-control" id="videoURL" placeholder="Link URL">
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <button type="button" class="btn btn-primary me-3">Pilih File</button>
                    <span>full_Matematika.pdf</span>
                </div>
                <div class="form-actions d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-danger">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <script src="../js/script.js"></script>
</body>

</html>