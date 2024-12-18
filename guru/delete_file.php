<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "e_learning";

$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Validasi method request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil nama file dari form
    $file_name = $_POST['file_name'];

    // Query untuk mengambil file dari database
    $stmt = $conn->prepare("SELECT jenis_materi FROM materi WHERE jenis_materi = ?");
    $stmt->bind_param("s", $file_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ambil data file
        $row = $result->fetch_assoc();
        $file_path = "uploads/" . $row['jenis_materi'];

        // Hapus file dari server
        if (file_exists($file_path)) {
            if (unlink($file_path)) {
                // Hapus data dari database
                $delete_stmt = $conn->prepare("DELETE FROM materi WHERE jenis_materi = ?");
                $delete_stmt->bind_param("s", $file_name);

                if ($delete_stmt->execute()) {
                    echo "<script>alert('File berhasil dihapus!'); document.location='menu_kelas.php';</script>";
                } else {
                    echo "<script>alert('Gagal menghapus data dari database!'); document.location='menu_kelas.php';</script>";
                }
                $delete_stmt->close();
            } else {
                echo "<script>alert('Gagal menghapus file dari server!'); document.location='menu_kelas.php';</script>";
            }
        } else {
            echo "<script>alert('File tidak ditemukan di server!'); document.location='menu_kelas.php';</script>";
        }
    } else {
        echo "<script>alert('File tidak ditemukan di database!'); document.location='menu_kelas.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>