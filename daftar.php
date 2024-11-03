<?php
session_start();

// Koneksi ke database
$host = 'localhost';
$db   = 'e_learning';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// Mengambil data dari form dengan pengecekan isset
$nama = isset($_POST["nama"]) ? $_POST["nama"] : '';
$password = isset($_POST["password"]) ? $_POST["password"] : '';
$confirm_password = isset($_POST["confirm-password"]) ? $_POST["confirm-password"] : '';
$role = isset($_POST["role"]) ? $_POST["role"] : '';
$email = isset($_POST["email"]) ? $_POST["email"] : '';

// Validasi ketika error
$errors = [];

if (empty($nama)) {
    $errors[] = "Nama tidak boleh kosong";
}
if (empty($password) || strlen($password) < 6) {
    $errors[] = "Password harus minimal 6 karakter";
}
if ($password !== $confirm_password) {
    $errors[] = "Password dan Ulangi Password tidak cocok";
}
if (empty($role)) {
    $errors[] = "Silakan pilih peran";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email tidak valid";
}

// Jika ada error, tampilkan pesan error
if (!empty($errors)) {
    // foreach ($errors as $error) {
    //     echo "<p style='color:red;'>$error</p>";
    // }
} else {
    // Menyiapkan dan mengeksekusi pernyataan
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (nama, password, sebagai, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $hashedPassword, $role, $email);

    if ($stmt->execute()) {
        // Redirect ke halaman login setelah pendaftaran berhasil
        header("Location: login.php?status=success");
        exit(); // Pastikan untuk keluar setelah redirect
    } else {
        header("Location: daftar.php?status=fail");
    }
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SMK Negeri 7 Jember</title>
    <link rel="stylesheet" href="css/style-daftar.css">
    <script src="js/script.js"></script>
</head>
<body>
    <div class="container">
        <div class="register-box">
            <h2>Daftar</h2>
            <form action="daftar.php" method="POST">
                <div class="input-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama anda" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="********" required>
                </div>
                <div class="input-group">
                    <label for="confirm-password">Ulangi password</label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="********" required>
                </div>
                <div class="input-group">
                    <label for="role">Sebagai</label>
                    <select id="role" name="role" required>
                        <option value="">pilih peran</option>
                        <option value="guru">Guru</option>
                        <option value="siswa">Siswa</option>
                        <option value="admin">admin</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email anda" required>
                </div>
                <button type="submit" class="btn-submit">Daftar</button>
            </form>
        </div>
    </div>
    
    <footer>
        <div class="footer-content">
            <div class="logo">
                <img src="Foto/smk7 jember.png" alt="Logo SMK Negeri 7 Jember">
                <h3>SMK Negeri 7 Jember</h3>
            </div>
            <div class="contact-info">
                <p>Email: smkn7jember@gmail.com</p>
                <p>Website: <a href="https://smkn7jember.sch.id/">smkn7jember.sch.id</a></p>
                <p>Telp: +6281-8094-0000</p>
            </div>
        </div>
    </footer>
</body>
</html>
