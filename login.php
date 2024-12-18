<?php
session_start();
require_once 'Auth.php';

$auth = new Auth();

// Logout
if (isset($_GET['logout'])) {
    $auth->logout();
    header("Location: login.php");
    exit();
}

// Cek apakah pengguna sudah login
if ($auth->isLoggedIn()) {
    // Jika sudah login, ambil informasi pengguna
    $user = $auth->getCurrentUser();

    // Redirect berdasarkan role
    switch ($user['role_user']) {
        case 'admin':
            header("Location: admin/admin.php");
            exit();
        case 'guru':
            header("Location: guru/guru.php");
            exit();
        case 'siswa':
            header("Location: siswa/siswa.php");
            exit();
    }
}

// Login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Periksa apakah input 'nama' dan 'password' ada di $_POST
    if (isset($_POST['nama']) && isset($_POST['password'])) {
        $nama = $_POST['nama'];
        $password = $_POST['password'];

        if ($auth->login($nama, $password)) {
            // Login berhasil, lanjutkan dengan logika
            $user = $auth->getCurrentUser();

            // Periksa apakah $user bukan null
            if ($user) {
                // Redirect berdasarkan role
                switch ($user['role_user']) {
                    case 'admin':
                        header("Location: admin/admin.php");
                        break;
                    case 'guru':
                        header("Location: guru/guru.php");
                        break;
                    case 'siswa':
                        header("Location: siswa/siswa.php");
                        break;
                    default:
                        // Tangani role yang tidak dikenal
                        header("Location: login.php?error=unknown_role");
                        exit();
                }
                exit(); // Tambahkan exit setelah redirect
            } else {
                $error = "Pengguna tidak ditemukan.";
            }
        } else {
            $error = $auth->getLastError();
        }
    } else {
        // Jika nama atau password tidak ada dalam $_POST
        $error = "Nama atau password tidak boleh kosong.";
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content ="width=device-width, initial-scale=1.0" />
    <title>Login - SMK Negeri 7 Jember</title>
    <!-- icon boostrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet" href="css/style-login.css" />
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header-sidebar.css">
    <!-- SVG untuk ikon warning -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
</head>

<body>
<nav class="header">
      <div class="logo">
        <img src="Foto/smk7 jember.png" alt="School Logo" />
        <span class="text-elearning">E-Learning</span>
      </div>
      <div class="site">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="index.html#fitur-web">Fitur</a></li>
          <li><a href="index.html#panduan">Panduan</a></li>
        </ul>
      </div>
      <a href="login.php" class="login-button">Masuk</a>
    </nav>
    
    <div class="sidebar">
    <div class="toggle">
        <a href="#" class="burger js-menu-toggle btn-sm" data-toggle="collapse" data-target="#main-navbar">
              <span></span>
            </a>
      </div>
      <div class="side-inner">

        <div class="profile">
          <!-- <img src="images/person_4.jpg" alt="Image" class="img-fluid"> -->
          <h3 class="name">Account Guest</h3>
          <span class="country">Akun tamu</span>
        </div>

        
        <div class="nav-menu">
          <ul>
            <li class="accordion">
            <li><a href="index.html"><span class="icon-home mr-3"></span>Home</a></li>
            </li>
            <li><a href="index.html#fitur-web"><span class="icon-menu mr-3"></span>Fitur</a></li>
            <li><a href="index.html#panduan"><span class="icon-book mr-3"></span>Panduan</a></li>
            <li class="accordion">
            <a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsible">
                <span class="icon-share2 mr-3"></span>Account official
              </a>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne">
                <div>
                  <ul>
                    <li><a href="#"><span class="icon-instagram mr-3"></span>Instagram</a></li>
                    <li><a href="#"><span class="icon-youtube mr-3"></span>Youtube</a></li>
                    <li><a href="#"><span class="icon-twitter mr-3"></span>Twitter</a></li>
                    <li><a href="#"><span class="icon-facebook-official mr-3"></span>Facebook</a></li>
                  </ul>
                </div>
              </div>
              </li>
          </ul>
        </div>
      </div>
      
    </div>

<!-- form login -->
    <div class="login-container">
        <div class="login-box">
            <div class="logo-smk7">
                <img src="Foto/smk7 jember.png" alt="Logo SMK Negeri 7 Jember" />
                <h2>SMK Negeri 7 Jember</h2>
            </div>
            <form action="login.php" method="post">
                <?php if (isset($error)): ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div><?php echo htmlspecialchars($error); ?></div>
                </div>
                <?php endif; ?>
                <div class="input-group">
                    <label for="nama-siswa">Nama</label>
                    <input type="text" id="nama-siswa" name="nama" placeholder="Masukkan nama anda" required />
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="********" required />
                    <span class="show-password" onclick="togglePassword()">Show</span>
                </div>
                <div class="forgot-password">
                    <a href="forgot-password.php">Lupa Nama siswa atau password?</a>
                    <p>Kuki harus diaktifkan pada browser anda</p>
                </div>
                <button type="submit" class="btn_input" id="submit" name="kirim">Masuk</button>
            </form>
        </div>
    </div>

    <footer>
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
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/script.js"></script>
</body>

</html>