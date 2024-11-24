<?php

// Panggil Koneksi Database
include "../dbconfig.php";

// Inisialisasi objek Database
$db = new Database();
$conn = $db->getConnection();

// crud siswa

//Uji jika tombol ubah di klik

if (isset($_POST['bubah'])) {
    $sql = "UPDATE siswa SET
                nisn = :nisn,
                nama = :nama,
                kelas = :kelas,
                email = :email
            WHERE id_siswa = :id_siswa";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':nisn', $_POST['tnim']);
    $stmt->bindValue(':nama', $_POST['tnama']);
    $stmt->bindValue(':kelas', $_POST['tkelas']);
    $stmt->bindValue(':email', $_POST['temail']);
    $stmt->bindValue(':id_siswa', $_POST['id_siswa']);
    $ubah = $stmt->execute();
}

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

//Uji jika tombol hapus di klik
if(isset($_POST['bhapus'])) {

    //persiapan hapus data
    $hapus = mysqli_query($conn, "DELETE FROM siswa WHERE id_siswa ='$_POST[id_siswa]'");

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
    $hapus = mysqli_query($conn, "DELETE FROM guru WHERE id_guru ='$_POST[id_guru]'");

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

//aksi crud mapel pada admin

//Uji jika tombol simpan di klik
if (isset($_POST['bsimpanmapel'])) {
    try {
        // Persiapkan query simpan
        $query = "INSERT INTO mapel (kode_mapel, nama_mapel) 
                  VALUES (:kode_mapel, :nama_mapel)";
        $stmt = $conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':kode_mapel', $_POST['tkdmapel']);
        $stmt->bindParam(':nama_mapel', $_POST['tmapel']);

        // Eksekusi query
        $stmt->execute();

        echo "<script>
               alert('Simpan data Mata Pelajaran Sukses!');
               document.location='crudmapel.php';
              </script>";
    } catch (PDOException $e) {
        echo "<script>
               alert('Simpan data Mata Pelajaran Gagal: " . $e->getMessage() . "');
               document.location='crudmapel.php';
              </script>";
    }
}


//Uji jika tombol ubah di klik
if (isset($_POST['bubahmapel'])) {
    $sql = "UPDATE mapel SET
                kode_mapel = :kode_mapel,
                nama_mapel = :nama_mapel
            WHERE id_mapel = :id_mapel";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':kode_mapel', $_POST['tkdmapel']);
    $stmt->bindValue(':nama_mapel', $_POST['tmapel']);
    $stmt->bindValue(':id_mapel', $_POST['id_mapel']);
    $ubah = $stmt->execute();
}

    //jika ubah sukses
    if($ubah){
        echo "<script>
               alert('Update data Sukses!');
               document.location='crudmapel.php'; 
              </script>";
    }else{
        echo "<script>
               alert('Update data Gagal!');
               document.location='crudmapel.php'; 
              </script>";
    }


//Uji jika tombol hapus di klik
if(isset($_POST['bhapusmapel'])) {

    //persiapan hapus data
    $hapus = mysqli_query($conn, "DELETE FROM mapel WHERE id_mapel ='$_POST[id_mapel]'");

    //jika hapus sukses
    if($hapus){
        echo "<script>
               alert('Hapus data Sukses!');
               document.location='crudmapel.php'; 
              </script>";
    }else{
        echo "<script>
               alert('Hapus data Gagal!');
               document.location='crudmapel.php'; 
              </script>";
    }
}

?>