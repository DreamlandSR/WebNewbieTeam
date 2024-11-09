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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/daftarguru.css">
</head>
<body>
<div class="header">
    <div class="logo">
        <i class="fas fa-bars menu-icon"></i>
        <img src="Foto/smk7 jember.png" alt="School Logo" />
        <span class="text-elearning">E-Learning</span>
    </div>
    <a href="logout.php" class="logout">Keluar</a>
</div>
    <div class="sidebar">
        <a href="admin.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="daftar.php"><i class="bi bi-person-plus-fill"></i> Daftar Akun</a>
        <a href="profile.php"><i class="bi bi-person-fill"></i> Profile</a>
        <a href="panduan.php"><i class="fas fa-book"></i> Panduan</a>
    </div>
    <div class="container">
        <div class="register-box">
            <h2>Daftar Akun Guru</h2>
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
                    <label for="role">Role User</label>
                    <input type="text" id="roleUser" name="role" placeholder="Masukkan role anda" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email anda" required>
                </div>
                <div class="input-group">
                    <label for="nomorInduk">NIP</label>
                    <input type="number" id="nomorInduk" name="nomorInduk" placeholder="Masukkan NISN anda" required>
                </div>
                <div class="input-group">
                    <label for="telp">No.Telp</label>
                    <input type="number" id="telp" name="telp" placeholder="Masukkan Nomor Telepon anda" required>
                </div>
                <button type="submit" class="btn-submit">Daftar</button>
            </form>
        </div>
    </div>
    
    <div class="footer">
        <div class="school-info">
          <img src="Foto/smk7 jember.png" alt="School Emblem" />
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
    <script src="js/script.js"></script>
</body>
</html>


<input type="file">