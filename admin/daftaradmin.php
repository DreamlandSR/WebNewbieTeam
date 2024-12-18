<?php
session_start();
require_once '../dbconfig.php';

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama = isset($_POST["nama"]) ? trim($_POST["nama"]) : '';
    $password = isset($_POST["password"]) ? $_POST["password"] : '';
    $confirm_password = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : '';
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
    $role_user = 'admin'; // Role default untuk admin

    // Validasi
    $errors = [];
    if (empty($nama)) $errors[] = "Nama tidak boleh kosong.";
    if (empty($password) || strlen($password) < 6) $errors[] = "Password minimal 6 karakter.";
    if ($password !== $confirm_password) $errors[] = "Password dan konfirmasi password tidak cocok.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email tidak valid.";

    // Jika ada error, kembalikan ke form
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: daftaradmin.php");
        exit();
    }

    try {
        // Mulai transaksi
        $conn->beginTransaction();

        // Periksa apakah email sudah ada
        $sql_check_email = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt_check_email = $conn->prepare($sql_check_email);
        $stmt_check_email->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt_check_email->execute();
        $email_exists = $stmt_check_email->fetchColumn();

        if ($email_exists > 0) {
            // Email sudah digunakan, rollback transaksi dan kirim error
            $conn->rollBack();
            $_SESSION['errors'] = ["Email sudah terdaftar, Silakan gunakan email lain !"];
            header("Location: daftaradmin.php");
            exit();
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // 1. Masukkan data ke tabel e_learning_users
        $sql_users = "INSERT INTO users (nama, password, email, role_user) 
                      VALUES (:nama, :password, :email, :role_user)";
        $stmt_users = $conn->prepare($sql_users);
        $stmt_users->bindValue(':nama', $nama, PDO::PARAM_STR);
        $stmt_users->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt_users->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt_users->bindValue(':role_user', $role_user, PDO::PARAM_STR);
        $stmt_users->execute();

        // Dapatkan ID user yang baru saja ditambahkan
        $id_user = $conn->lastInsertId();

        // 2. Masukkan data ke tabel e_learning_admins
        $sql_admins = "INSERT INTO admins (id_user, nama, email, password, role_user) 
                       VALUES (:id_user, :nama, :email, :password, :role_user)";
        $stmt_admins = $conn->prepare($sql_admins);
        $stmt_admins->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $stmt_admins->bindValue(':nama', $nama, PDO::PARAM_STR);
        $stmt_admins->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt_admins->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt_admins->bindValue(':role_user', $role_user, PDO::PARAM_STR);
        $stmt_admins->execute();

        // Commit transaksi
        $conn->commit();

        // Simpan data ke session sebelum redirect
        $_SESSION['user_info'] = [
            'nama' => $nama,
            'email' => $email,
            'role_user' => $role_user
        ];
        header("Location: prosesdaftar.php");
        exit();

    } catch (PDOException $e) {
        // Rollback jika ada error
        $conn->rollBack();
        $_SESSION['errors'] = ["Error: " . $e->getMessage()];
        header("Location: daftaradmin.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SMK Negeri 7 Jember</title>
    <!-- font, icon dll -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <!-- Boostrap alert -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
    <!-- link css -->
    <link rel="stylesheet" href="../css/daftaradmin.css">
</head>
<body>
<div class="header">
    <div class="logo">
        <i class="fas fa-bars menu-icon"></i>
        <img src="../Foto/smk7 jember.png" alt="School Logo" />
        <span class="text-elearning">E-Learning</span>
    </div>
    <a href="../logout.php" class="logout">Keluar</a>
</div>
    <div class="sidebar">
        <a href="admin.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="daftar.php"><i class="bi bi-person-plus-fill"></i> Daftar Akun</a>
        <a href="kalender.php"><i class="bi bi-calendar-date"></i> Kalender </a>
        <a href="profile.php"><i class="bi bi-person-fill"></i> Profile</a>
        <a href="panduan.php"><i class="fas fa-book"></i> Panduan</a>
        <a class="dropdown-btn" href="javascript:void(0);" id="dropdown-btn" onclick="toggleDropdown()">
            Tabel Master
            <i class="fas fa-caret-down"> </i>
        </a>
        <div class="dropdown" id="dropdown">
            <a href="crudsiswa.php"> Siswa </a>
            <a href="crudguru_admin.php"> Guru </a>
            <a href="crud_kelas.php"> Master Kelas </a>
            <a href="crudmapel.php"> Master mapel</a>
            <a href="guruMapel.php"> Guru mapel</a>
            <a href="kelas.php"> Kelas</a>
        </div>
    </div>

    <div class="content" id="box">
        <div class="register-box">
            <h2>Daftar Akun Admin</h2>
            <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
                <div class="alert alert-danger alert-custom" role="alert">
                        <?php 
                            foreach ($_SESSION['errors'] as $error) {
                                echo "<li>$error</li>";
                            }
                            unset($_SESSION['errors']); // Hapus pesan error setelah ditampilkan
                        ?>
                </div>
            <?php endif; ?>

            <form action="daftaradmin.php" method="POST">
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
                    <input type="password" id="confirm-password" name="confirm_password" placeholder="********" required>
                </div>
                <div class="input-group">
                    <label for="role_user">Role User</label>
                    <input type="text" id="role_user" name="role_user" value="admin" placeholder="Role user" readonly>
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email anda" required>
                </div>
                <button type="submit" class="btn-submit">Daftar</button>
            </form>
        </div>
    </div>

    <div class="footer">
        <div class="school-info">
          <img src="../Foto/smk7 jember.png" alt="School Emblem" />
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
    <script src="../js/script.js"></script>
</body>
</html>
