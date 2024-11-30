<?php
// Panggil Koneksi Database
include "../dbconfig.php";

// Inisialisasi objek Database
$db = new Database();
$conn = $db->getConnection();

// Periksa apakah form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idGuru = $_POST['id_guru']; // Tambahkan input ID guru dari form
    $jenisMateri = $_POST['jenis_materi']; // Tambahkan input jenis materi dari form
    $judulTugas = $_POST['judul_tugas'];
    $deskripsi = $_POST['deskripsi'] ?? null;
    $idKelas = $_POST['id_kelas']; // Tambahkan input ID kelas dari form
    $deadline = $_POST['deadline'];
    $videoUrl = $_POST['video_url'] ?? null;

    // Periksa apakah file diunggah
    $filePath = null;
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileName = time() . "_" . basename($_FILES['file']['name']);
        $uploadDir = "upload/";
        $filePath = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            die("Gagal mengunggah file.");
        }
    }

    // Tanggal dibuat
    $tanggalDibuat = date('Y-m-d H:i:s');

    // Simpan data ke database
    $stmt = $conn->prepare("INSERT INTO materi (id_guru, jenis_materi, judul_tugas, deskripsi, id_kelas, tanggal_dibuat, deadline, video_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssisss", $idGuru, $jenisMateri, $judulTugas, $deskripsi, $idKelas, $tanggalDibuat, $deadline, $videoUrl);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Data berhasil disimpan!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal menyimpan data."]);
    }

    $stmt->close();
    $conn->close();
}
?>