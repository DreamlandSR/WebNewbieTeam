<?php
// Panggil Koneksi Database
include "../dbconfig.php";

// Inisialisasi objek Database
$db = new Database();
$conn = $db->getConnection();

// Tambahkan logika CRUD di sini
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (isset($_POST['bsimpankelas'])) {
            // Simpan data
            $query = "INSERT INTO kelas (kode_kelas, nama_kelas, tahun_ajaran, semester, wali_kelas) 
                      VALUES (:kode_kelas, :nama_kelas, :tahun_ajaran, :semester, :wali_kelas)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':kode_kelas', $_POST['tkkelas']);
            $stmt->bindParam(':nama_kelas', $_POST['tnamakelas']);
            $stmt->bindParam(':tahun_ajaran', $_POST['tajaran']);
            $stmt->bindParam(':semester', $_POST['tsemester']);
            $stmt->bindParam(':wali_kelas', $_POST['twali']);
            $stmt->execute();
            echo "<script>
                   alert('Simpan data Kelas Sukses!');
                   document.location='crud_kelas.php';
                  </script>";
        } elseif (isset($_POST['bubahkelas'])) {
            // Ubah data
            $sql = "UPDATE kelas SET
                        kode_kelas = :kode_kelas,
                        nama_kelas = :nama_kelas,
                        tahun_ajaran = :tahun_ajaran,
                        semester = :semester,
                        wali_kelas = :wali_kelas
                    WHERE id_kelas= :id_kelas";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':kode_kelas', $_POST['tkkelas']);
            $stmt->bindParam(':nama_kelas', $_POST['tnamakelas']);
            $stmt->bindParam(':tahun_ajaran', $_POST['tajaran']);
            $stmt->bindParam(':semester', $_POST['tsemester']);
            $stmt->bindParam(':wali_kelas', $_POST['twali']);
            $stmt->execute();
            echo "<script>
                   alert('Update Data Kelas Sukses!');
                   document.location='crud_kelas.php';
                  </script>";
        } elseif (isset($_POST['bhapuskelas'])) {
            // Hapus data
            $query = "DELETE FROM kelas WHERE id_kelas = :id_kelas";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':id_kelas', $_POST['id_kelas']);
            $stmt->execute();
            echo "<script>
                   alert('Hapus Data Kelas Sukses!');
                   document.location='crud_kelas.php';
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
               alert('Operasi Gagal: " . $e->getMessage() . "');
               document.location='crud_kelas.php';
              </script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD - PHP & MySQL + Modal Bootstrap 5</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
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
            <a href="crudmapel.php"> Guru mapel</a>
            <a href="crudmapel.php"> Kelas</a>
        </div>
    </div>
    <div class="content">

        <div class="mt-3">
            <h3 class="text-center">CRUD - PHP & MySQL + Modal Bootstrap 5</h3>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                Data Kelas
            </div>
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Data
                </button>

                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>Kode Kelas</th>
                        <th>Nama Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Wali Kelas</th>
                        <th>Aksi</th>
                    </tr>

                    <?php

                        //persiapan menampilkan data
                        $no = 1;
                            $query = $conn->prepare("SELECT * FROM kelas ORDER BY id_kelas DESC");
                        $query->execute();
                        while ($data = $query->fetch(PDO::FETCH_ASSOC)):
                        
                    ?>

                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['id_kelas']  ?></td>
                        <td><?= $data['nama_kelas']?></td>
                        <td><?= $data['tahun_ajaran']?></td>
                        <td><?= $data['wali_kelas']?></td>
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
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Kelas</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form method="POST" action="crudmapel.php">
                                    <input type="hidden" name="id_kelas" value="<?=$data['id_kelas']?>">

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="form-label">Kode Kelas</label>
                                            <input type="text" class="form-control" name="tkkelas"
                                                value="<?= $data['kode_kelas']?>" placeholder="Masukkan Kode Kelas!"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama Kelas</label>
                                            <select class="form-select" name="tnamakelas">
                                                <option value="<?= $data['nama_kelas']?>">
                                                    <?= $data['nama_kelas']?></option>
                                                <option value="IPA 1">IPA 1</option>
                                                <option value="IPA 2">IPA 2</option>
                                                <option value="MTK 1">MTK1 </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Mata Pelajaran tidak boleh kosong.
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tahun Ajaran</label>
                                            <input type="text" class="form-control" name="tajaran"
                                                value="<?= $data['tahun_ajaran']?>"
                                                placeholder="Masukkan Tahun Ajaran Kelas!" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Wali Kelas</label>
                                            <input type="text" class="form-control" name="twali"
                                                value="<?= $data['wali_kelas']?>" placeholder="Masukkan Wali Kelas!"
                                                required>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="bubahkelas">Update</button>
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

                                <form method="POST" action="crud_kelas.php">
                                    <input type="hidden" name="id_kelas" value="<?=$data['id_kelas']?>">

                                    <div class="modal-body">

                                        <h5 class="text-center">Apakah Anda yakin akan menghapus data ini?<br>
                                            <span class="text-danger"><?= $data['kode_kelas']?> -
                                                <?= $data['nama_kelas']?></span>
                                        </h5>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="bhapuskelas">Iya,
                                            Hapus!</button>
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




                <!-- Awal Modal Tambah -->
                <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Kelas</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form method="POST" action="crud_kelas.php">
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label class="form-label">Kode Kelas</label>
                                        <input type="text" class="form-control" name="tkkelas"
                                            placeholder="Masukkan Kode Kelas!" required>
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label">Nama Kelas</label>
                                        <select class="form-select" name="tnamakelas">
                                            <option value="IPA 1">IPA 1</option>
                                            <option value="IPA 2">IPA 2</option>
                                            <option value="MTK 1">MTK1 </option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tahun Ajaran</label>
                                        <input type="text" class="form-control" name="tajaran"
                                            placeholder="Masukkan Tahun Ajaran Kelas!" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Wali Kelas</label>
                                        <input type="text" class="form-control" name="twali"
                                            placeholder="Masukkan Wali Kelas!" required>
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