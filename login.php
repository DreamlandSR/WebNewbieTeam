<?php
session_start();
$host = 'localhost';
$db   = 'e_learning';
$user = 'root'; 
$pass = ''; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cek apakah kedua field telah diisi
    if (isset($_POST['nama']) && isset($_POST['password'])) {
        $nama = $conn->real_escape_string($_POST['nama']);
        $password = $_POST['password']; 
        
        //cek username
        $sql = "SELECT * FROM users WHERE nama='$nama'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Ambil data user
            $user = $result->fetch_assoc();

            // Verifikasi password 
            if (password_verify($password, $user['password'])) {
                // Simpan nama dan sebagai ke session
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['sebagai'] = $user['sebagai'];
                
                // Redirect berdasarkan "sebagai"
                if ($user['sebagai'] === 'admin') {
                    header("Location: admin.html");
                } else if ($user['sebagai'] === 'guru') {
                    header("Location: guru.html");
                } else if ($user['sebagai'] === 'siswa') {
                    header("Location: siswa.html");
                } else {
                    header("Location: login.html?error=unknown_sebagai");
                }
                exit();
            } else {
                // Password salah
                header("Location: login.html?error=wrong_credentials");
                exit();
            }
        } else {
            // Nama pengguna tidak ditemukan
            header("Location: login.html?error=wrong_credentials");
            exit();
        }
    } else {
        // Jika field tidak diisi
        header("Location: login.html?error=empty_fields");
        exit();
    }
}
?>