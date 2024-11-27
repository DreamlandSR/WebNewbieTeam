<?php
// Konfigurasi database
$host = 'localhost';
$dbname = 'e_learning';
$username = 'root';
$password = '';

// Koneksi ke database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

$uploadDir = 'uploads/   '; // Folder tempat menyimpan file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi file unggahan
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('File tidak ditemukan atau terjadi kesalahan.');</script>";
        header('Location: pengumpulan_siswa.php');
        exit;
    }

    // Validasi input "Save As"
    if (empty($_POST['save_as'])) {
        echo "<script>alert('Nama tugas tidak boleh kosong.');</script>";
        header('Location: pengumpulan_siswa.php');
        exit;
    }

    $saveAs = htmlspecialchars($_POST['save_as']); // Nama tugas
    $file = $_FILES['file'];

    // Membuat nama file unik
    $fileName = time() . '-' . basename($file['name']);
    $uploadFilePath = $uploadDir . $fileName;

    // Pastikan folder "uploads" ada
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Pindahkan file ke folder tujuan
    if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
        try {
            // Simpan metadata ke database
            $stmt = $pdo->prepare("INSERT INTO file_uploads (file_name, file_path, save_as) VALUES (?, ?, ?)");
            $stmt->execute([$fileName, $uploadFilePath, $saveAs]);

            echo "<script>alert('Tugas berhasil diunggah dan disimpan ke database!');</script>";
            header('Location: pengumpulan_siswa.php');
            exit;
        } catch (PDOException $e) {
            echo "<script>alert('Gagal menyimpan ke database: " . $e->getMessage() . "');</script>";
            header('Location: pengumpulan_siswa.php');
            exit;
        }
    } else {
        echo "<script>alert('Gagal mengunggah file. Silakan coba lagi.');</script>";
        header('Location: pengumpulan_siswa.php');
        exit;
    }
}

// Mendapatkan data file dari database
try {
    $stmt = $pdo->query("SELECT * FROM file_uploads ORDER BY upload_time DESC");
    $files = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Gagal mengambil data file: " . $e->getMessage());
}

// Mendapatkan ID dari form update
$fileId = $_POST['file_id'];

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['file_id'])) {
    $fileId = $_POST['file_id'];
    $saveAs = htmlspecialchars($_POST['save_as']);

    if (!empty($_FILES['file']['name'])) {
        // Hapus file lama
        $stmt = $pdo->prepare("SELECT * FROM file_uploads WHERE id = ?");
        $stmt->execute([$fileId]);
        $file = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($file && file_exists($file['file_path'])) {
            unlink($file['file_path']);
        }

        // Upload file baru
        $uploadDir = 'uploads/';
        $fileName = time() . '-' . basename($_FILES['file']['name']);
        $uploadFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) {
            // Update database
            $stmt = $pdo->prepare("UPDATE file_uploads SET file_name = ?, file_path = ?, save_as = ? WHERE id = ?");
            $stmt->execute([$fileName, $uploadFilePath, $saveAs, $fileId]);

            echo "<script>alert('File berhasil diperbarui.'); window.location.href = 'pengumpulan_siswa.php';</script>";
        } else {
            echo "<script>alert('Gagal mengunggah file baru.');</script>";
        }
    } else {
        // Update hanya metadata
        $stmt = $pdo->prepare("UPDATE file_uploads SET save_as = ? WHERE id = ?");
        $stmt->execute([$saveAs, $fileId]);

        echo "<script>alert('Nama tugas berhasil diperbarui.'); window.location.href = 'pengumpulan_siswa.php';</script>";
    }
}
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
                                <?php if (!empty($files)) : ?>
                                <?php foreach ($files as $index => $file) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($file['file_name']); ?></td>
                                    <td>
                                        <a href="<?= htmlspecialchars($file['file_path']); ?>" class="btn btn-primary"
                                            target="_blank">Lihat</a>
                                        <a href="<?= htmlspecialchars($file['file_path']); ?>" download
                                            class="btn btn-success">Unduh</a>
                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalUbah">Update</a>
                                        <a href="delete_file.php?id=<?= $file['id']; ?>" class="btn btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus file ini?')">Hapus</a>


                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada file yang diunggah</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                            data-bs-target="#modalTambah">Masukkan Tugas</button>
                    </div>
                </div>
            </div>
        </main>

        <!-- Button trigger modal -->


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
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Masukkan File</label>
                                <input class="form-control" type="file" id="formFile" name="file" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Save As</label>
                                <input type="text" class="form-control" name="save_as"
                                    placeholder="Masukkan Nama Tugas Anda!" required>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="bsimpankelas">Simpan</button>
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
                        <input type="hidden" name="file_id" value="<?= htmlspecialchars($file['id']); ?>">

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Masukkan File</label>
                                <input class="form-control" type="file" id="formFile" name="file" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">File Lama</label>
                                <input type="text" class="form-control" name="save_as"
                                    value="<?= htmlspecialchars($file['file_name']); ?>"
                                    placeholder="Masukkan Nama Tugas Anda!" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Save As</label>
                                <input type="text" class="form-control" name="save_as"
                                    value="<?= htmlspecialchars($file['save_as']); ?>"
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