<?php
// Panggil Koneksi Database
include "dbconfig.php";

// Inisialisasi objek Database
$db = new Database();
$conn = $db->getConnection();

// Tambahkan logika CRUD di sini
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (isset($_POST['bubahguru'])) {
            // Ubah data
            $sql = "UPDATE guru SET
                        nip = :nip,
                        nama = :nama,
                        no_hp = :no_hp,
                        mata_pelajaran = :mata_pelajaran,
                        email = :email
                    WHERE id_guru = :id_guru";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':nip', $_POST['tnip']);
            $stmt->bindValue(':nama', $_POST['tnamaguru']);
            $stmt->bindValue(':no_hp', $_POST['tnohp']);
            $stmt->bindValue(':mata_pelajaran', $_POST['tmatapelajaran']);
            $stmt->bindValue(':email', $_POST['temail']);
            $stmt->bindValue(':id_guru', $_POST['id_guru']);
            $stmt->execute();
            echo "<script>
                   alert('Update data Sukses!');
                   document.location='crudguru_admin.php';
                  </script>";
        } elseif (isset($_POST['bhapusguru'])) {
            // Hapus data
            $query = "DELETE FROM guru WHERE id_guru = :id_guru";
            $stmt = $conn->prepare($query);
            $stmt->bindValue(':id_guru', $_POST['id_guru']);
            $stmt->execute();
            echo "<script>
                   alert('Hapus data Sukses!');
                   document.location='crudguru_admin.php';
                  </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
               alert('Operasi Gagal: " . $e->getMessage() . "');
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
    <title>CRUD - PHP & MySQL + Modal Bootstrap 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container">

        <div class="mt-3">
            <h3 class="text-center">CRUD - PHP & MySQL + Modal Bootstrap 5</h3>
        </div>

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
                        <th>Mata Pelajaran</th>
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
                        <td><?= $data['mata_pelajaran']?></td>
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
                                            <label class="form-label">Mata Pelajaran</label>
                                            <select class="form-select" name="tmatapelajaran">
                                                <option value="<?= $data['mata_pelajaran']?>">
                                                    <?= $data['mata_pelajaran']?></option>
                                                <option value="Matematika">Matematika</option>
                                                <option value="Olahraga">Olahraga</option>
                                                <option value="Bahasa Inggris">Bahasa Inggris</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Mata Pelajaran tidak boleh kosong.
                                            </div>
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

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>