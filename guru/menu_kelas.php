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

    // Ambil minggu dari URL (default minggu 1 jika tidak ada parameter)
    $minggu = isset($_GET['minggu']) ? (int)$_GET['minggu'] : 1;

    // Ambil file dari database sesuai minggu
    $query = "SELECT id_tugas, jenis_materi, judul_tugas, deskripsi, video_url FROM materi WHERE minggu = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $minggu);
    $stmt->execute();
    $result = $stmt->get_result();

    $files = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $files[] = $row;
        }
    }

    $stmt->close();
    $conn->close();
    ?>

    <html>

    <head>
        <title>E - Learning</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
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
                <?php foreach ($files as $file): ?>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editMateriModal"
                    data-id="<?= htmlspecialchars($file['id_tugas'] ?? ''); ?>"
                    data-minggu="<?= htmlspecialchars($file['minggu'] ?? ''); ?>"
                    data-judul="<?= htmlspecialchars($file['judul_tugas'] ?? ''); ?>"
                    data-deskripsi="<?= htmlspecialchars($file['deskripsi'] ?? ''); ?>"
                    data-deadline="<?= htmlspecialchars($file['deadline'] ?? ''); ?>"
                    data-url="<?= htmlspecialchars($file['video_url'] ?? ''); ?>"
                    data-file="<?= htmlspecialchars($file['jenis_materi'] ?? ''); ?>">
                    <i class="fas fa-edit"></i> Edit Materi
                </button>
                <?php endforeach; ?>


                <!-- Tombol Upload Materi -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#materiModal">
                    <i class="fas fa-plus"></i> Upload Materi
                </button>
            </div>
            <!-- Navigasi untuk memilih minggu -->
            <div class="week-navigation">
                <a href="?minggu=1" class="btn btn-secondary">Minggu 1</a>
                <a href="?minggu=2" class="btn btn-secondary">Minggu 2</a>
                <a href="?minggu=3" class="btn btn-secondary">Minggu 3</a>
                <!-- Tambahkan minggu lainnya sesuai kebutuhan -->
            </div>

            <div class="week">
                <h1>Minggu <?php echo $minggu; ?></h1>

                <?php if (!empty($files)): ?>
                <?php foreach ($files as $file): ?>
                <div class="lesson">
                    <h5><?php echo htmlspecialchars($file['judul_tugas']); ?></h5>
                    <p><?php echo htmlspecialchars($file['deskripsi']); ?></p>
                    <p><?php echo htmlspecialchars($file['jenis_materi']); ?></p>
                    <p><?php echo htmlspecialchars($file['video_url']); ?></p>
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
                <p>Belum ada materi atau tugas yang tersedia untuk minggu ini.</p>
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
                                <label for="minggu" class="form-label">Minggu</label>
                                <select class="form-control" id="minggu" name="minggu" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <!-- Tambahkan minggu lainnya -->
                                </select>
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
                                <button type="submit" class="btn btn-primary" name="bsimpanmateri">Simpan</button>
                                <button type=" reset" class="btn btn-danger">Cancel</button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Materi -->
        <div class="modal fade" id="editMateriModal" tabindex="-1" aria-labelledby="editMateriModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editMateriModalLabel">Edit Materi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editMateriForm" enctype="multipart/form-data" action="update_materi.php"
                            method="POST">
                            <input type="hidden" id="edit-id" name="id_tugas">
                            <div class="mb-3">
                                <label for="edit-minggu" class="form-label">Minggu</label>
                                <select class="form-control" id="edit-minggu" name="minggu">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit-judulTugas" class="form-label">Judul Tugas</label>
                                <input type="text" class="form-control" id="edit-judulTugas" name="judul_tugas"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="edit-deskripsi" name="deskripsi" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="edit-deadline" class="form-label">Batas Waktu</label>
                                <input type="datetime-local" class="form-control" id="edit-deadline" name="deadline">
                            </div>
                            <div class="mb-3">
                                <label for="edit-videoURL" class="form-label">Video URL</label>
                                <input type="url" class="form-control" id="edit-videoURL" name="video_url">
                            </div>
                            <div class="mb-3">
                                <label for="edit-file" class="form-label">File</label>
                                <input type="file" class="form-control" id="edit-file" name="file">
                                <small id="current-file"></small>
                            </div>
                            <div class="form-actions d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
        // Fungsi untuk menangani pengisian data ke dalam modal Edit Materi
        document.addEventListener('DOMContentLoaded', function() {
            const editMateriModal = document.getElementById('editMateriModal');
            editMateriModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Tombol yang memicu modal
                const id = button.getAttribute('data-id');
                const minggu = button.getAttribute('data-minggu');
                const judul = button.getAttribute('data-judul');
                const deskripsi = button.getAttribute('data-deskripsi');
                const deadline = button.getAttribute('data-deadline');
                const videoUrl = button.getAttribute('data-url');
                const file = button.getAttribute('data-file');

                // Isi nilai form di modal
                const modal = this;
                modal.querySelector('#edit-id').value = id;
                modal.querySelector('#edit-minggu').value = minggu;
                modal.querySelector('#edit-judulTugas').value = judul;
                modal.querySelector('#edit-deskripsi').value = deskripsi;
                modal.querySelector('#edit-deadline').value = deadline;
                modal.querySelector('#edit-videoURL').value = videoUrl;

                // Menampilkan file saat ini (opsional)
                const currentFile = modal.querySelector('#current-file');
                currentFile.textContent = file ? `File saat ini: ${file}` :
                    'Tidak ada file yang terunggah';
            });
        });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../js/script.js"></script>
    </body>

    </html>