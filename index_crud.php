<?php

//Panggil Koneksi Database
include "koneksi_crud.php";

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
                Data Siswa
            </div>
            <div class="card-body">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    Tambah Data
                </button>

                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>No.</th>
                        <th>NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Prodi</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>

                    <?php

                        //persiapan menampilkan data
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY id_siswa DESC");
                             while($data = mysqli_fetch_array($tampil)):
                    ?>

                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nis' ]  ?></td>
                        <td><?= $data['nama_siswa']?></td>
                        <td><?= $data['kelas']?></td>
                        <td><?= $data['prodi']?></td>
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
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Siswa</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form method="POST" action="aksi_crud.php">
                                    <input type="hidden" name="id_siswa" value="<?=$data['id_siswa']?>">

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="form-label">NIS</label>
                                            <input type="text" class="form-control" name="tnim"
                                                value="<?= $data['nis']?>" placeholder="Masukkan NIS Anda!" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="tnama"
                                                value="<?= $data['nama_siswa']?>"
                                                placeholder="Masukkan Nama Lengkap Anda!" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Kelas</label>
                                            <input type="text" class="form-control" name="tkelas"
                                                value="<?= $data['kelas']?>" placeholder="Masukkan Kelas Anda!"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Prodi</label>
                                            <select class="form-select" name="tprodi">
                                                <option value="<?= $data['prodi']?>"><?= $data['prodi']?></option>
                                                <option value="Manajemen Informatika">Manajemen Informatika</option>
                                                <option value="Teknik Informatika">Teknik Informatika</option>
                                                <option value="Teknik Komputer">Teknik Komputer</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Prodi tidak boleh kosong.
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="temail"
                                                value="<?= $data['email']?>" placeholder="Masukkan Email Anda" required>
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

                                <form method="POST" action="aksi_crud.php">
                                    <input type="hidden" name="id_siswa" value="<?=$data['id_siswa']?>">

                                    <div class="modal-body">

                                        <h5 class="text-center">Apakah Anda yakin akan menghapus data ini?<br>
                                            <span class="text-danger"><?= $data['nis']?> -
                                                <?= $data['nama_siswa']?></span>
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




                <!-- Awal Modal Tambah -->
                <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Siswa</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <form method="POST" action="aksi_crud.php">
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label class="form-label">NIS</label>
                                        <input type="text" class="form-control" name="tnim"
                                            placeholder="Masukkan NIS Anda!" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="tnama"
                                            placeholder="Masukkan Nama Lengkap Anda!" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kelas</label>
                                        <input type="text" class="form-control" name="tkelas"
                                            placeholder="Masukkan Kelas Anda!" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Prodi</label>
                                        <select class="form-select" name="tprodi">
                                            <option value=""></option>
                                            <option value="Manajemen Informatika">Manajemen Informatika</option>
                                            <option value="Teknik Informatika">Teknik Informatika</option>
                                            <option value="Teknik Komputer">Teknik Komputer</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Prodi tidak boleh kosong.
                                        </div>

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="temail"
                                            placeholder="Masukkan Email Anda" required>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name="bsimpan">Simpan</button>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>