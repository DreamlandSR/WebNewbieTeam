<?php
session_start();
require_once "../Auth.php";
require_once "../dbconfig.php"; 

$user = new Auth();
// Cek status login user
if (!$user->isLoggedIn()) {  
    header("location: login.php"); //Redirect ke halaman login  
    exit; // Tambahkan exit setelah header
}

?>

<html>
  <head>
    <title>E-Learning</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../css/panduan.css" />
  </head>
  <body>
  <div class="header">
    <div class="logo">
        <i class="fas fa-bars menu-icon"></i>
        <img src="../Foto/smk7 jember.png" alt="School Logo" />
        <span class="text-elearning">E-Learning</span>
    </div>
    <a href="logout.php" class="logout">Keluar</a>
  </div>
  <div class="sidebar">
        <a href="guru.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="kalender.php"><i class="bi bi-calendar-date"></i> Kalender </a>
        <a href="profile.php"><i class="bi bi-person-fill"></i> Profile</a>
        <a href="panduan.php"><i class="fas fa-book"></i> Panduan</a>
        <a class="dropdown-btn" href="javascript:void(0);" id="dropdown-btn" onclick="toggleDropdown()">
        Kelas
        <i class="fas fa-caret-down"> </i>
      </a>
      <div class="dropdown" id="dropdown">
        <a href="menu_kelas.php"> XII TKJ 1 </a>
        <a href="menu_kelas.php"> XII TKJ 2</a>
        <a href="menu_kelas.php"> XII MM 1 </a>
        <a href="menu_kelas.php"> XII MM 2 </a>
    </div>
    </div>
    <div class="content">
      <h1>Panduan penggunaan Aplikasi</h1>
      <div class="card">
        <img alt="Guru Icon" height="80" src="../Foto/teacher.png" width="80" />
        <div class="card-content">
          <h2>Guru</h2>
          <p>Menambahkan Tugas, form quiz, memberikan materi, serta melakukan komentar terhadap tugas</p>
          <a class="button" href="../panduan/Akun.pdf" download="Panduan-Guru.pdf">Lihat Panduan</a>
        </div>

      </div>
      <div class="card">
        <img alt="Murid Icon" height="80" src="../Foto/graduation.png" width="80" />
        <div class="card-content">
          <h2>Murid</h2>
          <p>Mengumpulkan tugas, melihat mata pelajaran dan jadwal pelajaran</p>
          <a class="button" href="../panduan/Cobak.pdf" download="Panduan-Murid.pdf">Lihat Panduan</a>
        </div>
      </div>
      <div class="card">
        <img alt="Teknisi Icon" height="80" src="../Foto/engineer.png" width="80" />
        <div class="card-content">
          <h2>Admin</h2>
          <p>Melakukan perubahan pada jadwal dan mata pelajaran</p>
          <a class="button" href="../panduan/Info.pdf" download="Panduan-Admin.pdf">Lihat Panduan</a>
        </div>
      </div>
    </div>
    <script src="../js/script.js"></script>
  </body>
</html>
