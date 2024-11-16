<?php

// Panggil Koneksi Database
include "dbconfig.php";

// Inisialisasi objek Database
$db = new Database();
$conn = $db->getConnection();

//Uji jika tombol simpan di klik
if (isset($_POST['bsimpanguru'])) {
    try {
        // Persiapkan query untuk menyimpan data
        $query = "INSERT INTO guru (nip, nama, no_hp, mata_pelajaran, email) 
                  VALUES (:nip, :nama, :no_hp, :mata_pelajaran, :email)";
        $stmt = $conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':nip', $_POST['tnip']);
        $stmt->bindParam(':nama', $_POST['tnamaguru']);
        $stmt->bindParam(':no_hp', $_POST['tnohp']);
        $stmt->bindParam(':mata_pelajaran', $_POST['tmatapelajaran']);
        $stmt->bindParam(':email', $_POST['temail']);

        // Eksekusi query
        $stmt->execute();

        // Berikan pesan sukses
        echo "<script>
               alert('Simpan data Guru Sukses!');
               document.location='crudguru_admin.php';
              </script>";
    } catch (PDOException $e) {
        // Tangani kesalahan dan tampilkan pesan error
        echo "<script>
               alert('Simpan data Guru Gagal: " . $e->getMessage() . "');
               document.location='crudguru_admin.php';
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
if (isset($_POST['bsimpanguru'])) {
    try {
        // Persiapkan query simpan
        $query = "INSERT INTO guru (nip, nama, no_hp, mata_pelajaran, email) 
                  VALUES (:nip, :nama, :no_hp, :mata_pelajaran, :email)";
        $stmt = $conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':nip', $_POST['tnip']);
        $stmt->bindParam(':nama', $_POST['tnamaguru']);
        $stmt->bindParam(':no_hp', $_POST['tnohp']);
        $stmt->bindParam(':mata_pelajaran', $_POST['tmatapelajaran']);
        $stmt->bindParam(':email', $_POST['temail']);

        // Eksekusi query
        $stmt->execute();

        echo "<script>
               alert('Simpan data Guru Sukses!');
               document.location='crudguru_admin.php';
              </script>";
    } catch (PDOException $e) {
        echo "<script>
               alert('Simpan data Guru Gagal: " . $e->getMessage() . "');
               document.location='crudguru_admin.php';
              </script>";
    }
}


//Uji jika tombol ubah di klik
if (isset($_POST['bubahguru'])) {
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
    $ubah = $stmt->execute();
}

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