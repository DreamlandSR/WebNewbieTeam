<?php

// Panggil Koneksi Database
include "../dbconfig.php";

// Inisialisasi objek Database  
$db = new Database();
$conn = $db->getConnection();

// Logika CRUD
if (isset($_POST['bubah'])) {
    // Ubah data siswa
    $sql = "UPDATE siswa SET
                nisn = :nisn,
                nama = :nama,
                id_kelas = :kelas,  -- Ubah ke id_kelas jika ini adalah ID kelas
                email = :email,
                no_hp = :nohp
            WHERE id_siswa = :id_siswa";
    $stmt = $conn->prepare($sql);

    // Binding nilai dari form ke parameter SQL
    $stmt->bindValue(':nisn', $_POST['tnisn']);
    $stmt->bindValue(':nama', $_POST['tnama']);
    $stmt->bindValue(':kelas', $_POST['tkelas']);
    $stmt->bindValue(':email', $_POST['temail']);
    $stmt->bindValue(':nohp', $_POST['tnohp']); // Pastikan parameter ini sesuai dengan nama form input
    $stmt->bindValue(':id_siswa', $_POST['id_siswa']); // Pastikan parameter ini sesuai dengan ID siswa

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>
               alert('Update data Sukses!');
               document.location='crudsiswa.php';
              </script>";
    } else {
        echo "<script>
               alert('Update data Gagal!');
               document.location='crudsiswa.php';
              </script>";
    }
} elseif (isset($_POST['bhapus'])) {
    // Hapus data
    $query = "DELETE FROM siswa WHERE id_siswa = :id_siswa";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id_siswa', $_POST['id_siswa']);

    // Eksekusi query
    if ($stmt->execute()) {
        echo "<script>
               alert('Hapus data Sukses!');
               document.location='crudsiswa.php';
              </script>";
    } else {
        echo "<script>
               alert('Hapus data Gagal!');
               document.location='crudsiswa.php';
              </script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tabel Master Siswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="../css/crud.css" />
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
        <a class="dropdown-btn" href="javascript:void(0);" id="dropdown-btn" onclick="toggleDropdown()">
            Tabel Master
            <i class="fas fa-caret-down"> </i>
        </a>
        <div class="dropdown" id="dropdown">
            <a href="crudsiswa.php"> Siswa </a>
            <a href="crudguru_admin.php"> Guru </a>
            <a href="crud_kelas.php"> Master Kelas </a>
            <a href="crudmapel.php"> Master mapel</a>
            <a href="guruMapel.php"> Guru mapel</a>
            <a href="kelas.php"> Kelas</a>
        </div>
    </div>
    <div class="content">
        <!-- <div class="mt-3">
            <h3 class="text-center">CRUD - PHP & MySQL + Modal Bootstrap 5</h3>
        </div> -->
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                Data Siswa
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Email</th>
                        <th>Nomor Handphone</th>
                        <th>Aksi</th>
                    </tr>

                    <?php
                        //persiapan menampilkan data                       
                        $no = 1;
                        $query = $conn->prepare("SELECT * FROM siswa ORDER BY id_siswa DESC");
                        $query->execute();
                        while ($data = $query->fetch(PDO::FETCH_ASSOC)):

                        // Query mengambil data kelas
                        $sql_kelas = "SELECT * FROM kelas ORDER BY id_kelas DESC";
                        $stmt_kelas = $conn->prepare($sql_kelas);
                        $stmt_kelas->execute();
                        $kelas_data = $stmt_kelas->fetchAll(PDO::FETCH_ASSOC);                        
                    ?>

                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nisn']?></td>
                        <td><?= $data['nama']?></td>
                        <td><?= $data['kelas']?></td>
                        <td><?= $data['email']?></td>
                        <td><?= $data['no_hp']?></td>
                        <td>
                            <a href="#" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modalUbah<?= $no ?>">Update</a>
                            <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalHapus<?= $no ?>">Hapus</a>
                        </td>
                    </tr>

                    <!-- Awal Modal Update -->
                    <div class="modal fade" id="modalUbah<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Siswa</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form method="POST" action="crudsiswa.php">
                                    <input type="hidden" name="id_siswa" value="<?=$data['id_siswa']?>">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">NISN</label>
                                            <input type="text" class="form-control" name="tnisn"
                                                value="<?= $data['nisn']?>" placeholder="Masukkan NISN Anda!" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="tnama"
                                                value="<?= $data['nama']?>" placeholder="Masukkan Nama Lengkap Anda!"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Kelas</label>
                                            <select name="tkelas" id="kelas">
                                                <?php foreach ($kelas_data as $kelas): ?>
                                                    <option value="<?= $kelas['id_kelas']; ?>" 
                                                        <?= ($kelas['id_kelas'] == $data['id_kelas']) ? 'selected' : ''; ?>>
                                                        <?= $kelas['nama_kelas']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>


                                            <!-- <input type="text" class="form-control" name="tkelas"
                                                value="<?= $data['kelas']?>" placeholder="Masukkan Kelas Anda!"
                                                required>
                                        </div> -->

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="temail"
                                                value="<?= $data['email']?>" placeholder="Masukkan Email Anda!"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nomor Handphone</label>
                                            <input type="text" class="form-control" name="tnohp"
                                                value="<?= $data['no_hp']?>"
                                                placeholder="Masukkan Nomor Handphone Anda!" required>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="bubah">Update</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Keluar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Update -->


                    <!-- Awal Modal Hapus -->
                    <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form method="POST" action="crudsiswa.php">
                                    <input type="hidden" name="id_siswa" value="<?=$data['id_siswa']?>">

                                    <div class="modal-body">

                                        <h5 class="text-center">Apakah Anda yakin akan menghapus data ini?<br>
                                            <span class="text-danger"><?= $data['nisn']?> -
                                                <?= $data['nama']?></span>
                                        </h5>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="bhapus">Iya, Hapus!</button>
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Keluar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Modal Hapus -->

                    <?php endwhile; ?>
                </table>

            </div>
        </div>
        <a href="admin.php">
            <button class="btn btn-danger" id="btn-back">Kembali</button>
        </a>
    </div>
    <footer>
        <div class="footer">
            <div class="school-info">
                <img src="../Foto/smk7 jember.png" alt="School Emblem" />
                <p>SMK Negeri 7 Jember</p>
            </div>
            <div class="contact-info">
                <p id="footer-contact">Contact</p>
                <p><i class="fas fa-envelope"></i> smkn7jember@gmail.com</p>
                <p><i class="fas fa-globe"></i> https://smkn7jember.sch.id/</p>
                <p><i class="fas fa-phone"></i> +6281-8094-0000</p>
            </div>
        </div>
    </footer>
    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>