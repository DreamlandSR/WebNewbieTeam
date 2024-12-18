<?php
// Panggil Koneksi Database
include "../dbconfig.php";

// Inisialisasi objek Database
$db = new Database();
$conn = $db->getConnection();

// Tambahkan logika CRUD di sini
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Proses update guru
        if (isset($_POST['bubahguru'])) {
            $sql = "UPDATE guru SET 
                        nip = :nip,
                        nama = :nama,
                        no_hp = :no_hp,
                        email = :email
                    WHERE id_guru = :id_guru";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':nip', $_POST['tnip']);
            $stmt->bindValue(':nama', $_POST['tnamaguru']);
            $stmt->bindValue(':no_hp', $_POST['tnohp']);
            $stmt->bindValue(':email', $_POST['temail']);
            $stmt->bindValue(':id_guru', $_POST['id_guru']);
            $stmt->execute();
            
            echo "<script>
                    alert('Update data Sukses!');
                    document.location='crudguru_admin.php';
                  </script>";
        }
        
        // Proses hapus data
        if (isset($_POST['bhapusguru'])) {
            try {
                // Mulai transaksi database
                $conn->beginTransaction();
                
                // Pertama, hapus dari tabel users
                $query_users = "DELETE FROM users WHERE id = :id";
                $stmt_users = $conn->prepare($query_users);
                $stmt_users->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
                $stmt_users->execute();
                
                // Kemudian, hapus dari tabel guru
                $query_guru = "DELETE FROM guru WHERE id_guru = :id_guru";
                $stmt_guru = $conn->prepare($query_guru);
                $stmt_guru->bindValue(':id_guru', $_POST['id_guru'], PDO::PARAM_INT);
                $stmt_guru->execute();
                
                // Commit transaksi
                $conn->commit();
                
                // Redirect dengan pesan sukses
                echo "<script>
                        alert('Data berhasil dihapus!');
                        document.location='crudguru_admin.php';
                      </script>";
                
            } catch (PDOException $e) {
                // Batalkan transaksi jika terjadi kesalahan
                $conn->rollBack();
                
                // Tampilkan pesan kesalahan
                echo "<script>
                        alert('Gagal menghapus data: " . $e->getMessage() . "');
                        document.location='crudguru_admin.php';
                      </script>";
            }
        }
        
    } catch (PDOException $e) {
        // Tangani kesalahan umum
        echo "<script>
                alert('Terjadi kesalahan: " . $e->getMessage() . "');
                document.location='crudguru_admin.php';
              </script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <title>CRUD - PHP & MySQL + Modal Bootstrap 5</title> -->
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
                Data Guru
            </div>
            <div class="card-body">

                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>NIP</th>
                        <th>Nama Lengkap</th>
                        <th>Nomor Handphone</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>

                    <?php

                        //persiapan menampilkan data
                        $no = 1;
                            $query = $conn->prepare("SELECT * FROM guru ORDER BY id_guru DESC");
                        $query->execute();
                        while ($data = $query->fetch(PDO::FETCH_ASSOC)):
                        
                    ?>

                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nip' ]  ?></td>
                        <td><?= $data['nama']?></td>
                        <td><?= $data['no_hp']?></td>
                        <td><?= $data['email']?></td>
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
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Guru</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form method="POST" action="crudguru_admin.php">
                                    <input type="hidden" name="id_guru" value="<?=$data['id_guru']?>">

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="form-label">NIP</label>
                                            <input type="text" class="form-control" name="tnip"
                                                value="<?= $data['nip']?>" placeholder="Masukkan NIP Anda!" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="tnamaguru"
                                                value="<?= $data['nama']?>" placeholder="Masukkan Nama Lengkap Anda!"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nomor Handphone</label>
                                            <input type="tel" class="form-control" name="tnohp" pattern="[0-9]*"
                                                value="<?= $data['no_hp']?>" placeholder="Masukkan Nomor Telepon Anda!"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="temail"
                                                value="<?= $data['email']?>" placeholder="Masukkan Email Anda" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="bubahguru">Update</button>
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

                                <form method="POST" action="crudguru_admin.php">
                                    <input type="hidden" name="id_guru" value="<?=$data['id_guru']?>">
                                    <div class="modal-body">
                                        <h5 class="text-center">Apakah Anda yakin akan menghapus data ini?<br>
                                            <span class="text-danger"><?= $data['nip']?> -
                                                <?= $data['nama']?></span>
                                        </h5>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="bhapusguru">Iya,
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

            </div>
        </div>

        <!-- <a href="admin.php">
            <button class="btn btn-danger" id="btn-back">Kembali</button>
        </a> -->

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