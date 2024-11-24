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
    <link rel="stylesheet" href="../css/style-daftar.css">
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
            <a href="crud_kelas.php"> Kelas </a>
            <a href="crudmapel.php"> Mata Pelajaran</a>
        </div>
    </div>
    <div class="content" id="box">
    <div class="register-box">
    <h2>Daftar</h2>
    <p>Daftar untuk akun Siswa, Guru, dan Admin</p>
    <form action="daftar.php" method="POST" onsubmit="redirectToRolePage(event)">
    <div class="input-group">
        <label for="role">Role User</label>
        <select id="role" name="role" onchange="updateRoleUser()" required>
            <option value="">Pilih peran</option>
            <option value="admin">Admin</option>
            <option value="guru">Guru</option>
            <option value="siswa">Siswa</option>
        </select>
    </div>
    <input type="hidden" id="roleUser" name="role_user" />
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
