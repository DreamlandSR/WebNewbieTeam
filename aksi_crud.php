<?php

//panggil koneksi database
include "koneksi_crud.php";

//Uji jika tombol simpan di klik
if(isset($_POST['bsimpan'])) {

    //persiapan simpan data baru 
    $simpan = mysqli_query($koneksi, "INSERT INTO siswa (nis, nama_siswa, kelas, prodi, email)
                                       VALUES ('$_POST[tnim]',
                                               '$_POST[tnama]',
                                               '$_POST[tkelas]',
                                               '$_POST[tprodi]',
                                               '$_POST[temail]')");
    //jika simpan sukses
    if($simpan){
        echo "<script>
               alert('Simpan data Sukses!');
               document.location='index_crud.php'; 
              </script>";
    }else{
        echo "<script>
               alert('Simpan data Gagal!');
               document.location='index_crud.php'; 
              </script>";
    }
}


//Uji jika tombol ubah di klik
if(isset($_POST['bubah'])) {

    //persiapan ubah data
    $ubah = mysqli_query($koneksi, "UPDATE siswa SET
                                                        nis = '$_POST[tnim]',
                                                        nama_siswa = '$_POST[tnama]',
                                                        kelas = '$_POST[tkelas]',
                                                        prodi = '$_POST[tprodi]',
                                                        email = '$_POST[temail]'
                                                    WHERE id_siswa = '$_POST[id_siswa]' 
                                                        ");


    //jika ubah sukses
    if($ubah){
        echo "<script>
               alert('Update data Sukses!');
               document.location='index_crud.php'; 
              </script>";
    }else{
        echo "<script>
               alert('Update data Gagal!');
               document.location='index_crud.php'; 
              </script>";
    }
}

//Uji jika tombol hapus di klik
if(isset($_POST['bhapus'])) {

    //persiapan hapus data
    $hapus = mysqli_query($koneksi, "DELETE FROM siswa WHERE id_siswa ='$_POST[id_siswa]'");

    //jika hapus sukses
    if($hapus){
        echo "<script>
               alert('Hapus data Sukses!');
               document.location='index_crud.php'; 
              </script>";
    }else{
        echo "<script>
               alert('Hapus data Gagal!');
               document.location='index_crud.php'; 
              </script>";
    }
}

//aksi crud guru untuk admin

//Uji jika tombol simpan di klik
if(isset($_POST['bsimpanguru'])) {

    //persiapan simpan data baru 
    $simpan = mysqli_query($koneksi, "INSERT INTO guru (nip, nama_guru, no_hp, mata_pelajaran, email)
                                       VALUES ('$_POST[tnip]',
                                               '$_POST[tnamaguru]',
                                               '$_POST[tnohp]',
                                               '$_POST[tmatapelajaran]',
                                               '$_POST[temail]')");
    //jika simpan sukses
    if($simpan){
        echo "<script>
               alert('Simpan data Sukses!');
               document.location='crudguru_admin.php'; 
              </script>";
    }else{
        echo "<script>
               alert('Simpan data Gagal!');
               document.location='crudguru_admin.php'; 
              </script>";
    }
}


//Uji jika tombol ubah di klik
if(isset($_POST['bubahguru'])) {

    //persiapan ubah data
    $ubah = mysqli_query($koneksi, "UPDATE guru SET
                                                        nip = '$_POST[tnip]',
                                                        nama_guru = '$_POST[tnamaguru]',
                                                        no_hp = '$_POST[tnohp]',
                                                        mata_pelajaran = '$_POST[tmatapelajaran]',
                                                        email = '$_POST[temail]'
                                                    WHERE id_guru = '$_POST[id_guru]' 
                                                        ");


    //jika ubah sukses
    if($ubah){
        echo "<script>
               alert('Update data Sukses!');
               document.location='crudguru_admin.php'; 
              </script>";
    }else{
        echo "<script>
               alert('Update data Gagal!');
               document.location='crudguru_admin.php'; 
              </script>";
    }
}

//Uji jika tombol hapus di klik
if(isset($_POST['bhapusguru'])) {

    //persiapan hapus data
    $hapus = mysqli_query($koneksi, "DELETE FROM guru WHERE id_guru ='$_POST[id_guru]'");

    //jika hapus sukses
    if($hapus){
        echo "<script>
               alert('Hapus data Sukses!');
               document.location='crudguru_admin.php'; 
              </script>";
    }else{
        echo "<script>
               alert('Hapus data Gagal!');
               document.location='crudguru_admin.php'; 
              </script>";
    }
}


?>