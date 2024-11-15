<html>
<head>
    <title>Mata Pelajaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaJ6tnjMr0P6LIYzjvR7UluKswzD+8mHE7WvTyfK9BYI8xX/EnBGlm5d6L7" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.23.5/dist/bootstrap-table.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="css/mapel.css">
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
        <a class="dropdown-btn" href="javascript:void(0);" id="dropdown-btn" onclick="toggleDropdown()">
        Tabel Master
        <i class="fas fa-caret-down"> </i>
      </a>
      <div class="dropdown" id="dropdown">
        <a href="materi_dosen.html"> Siswa </a>
        <a href="#"> Pendidik </a>
        <a href="#"> Kelas </a>
        <a href="mapel.php"> Materi </a>
    </div>
    </div>
    <div class="container">
        <div class="container-matkul">
            <h1>Mata Pelajaran</h1>
            <button><i class="fas fa-plus"></i> Tambah data</button>
        </div>
        <div class="search-container">
            <label for="search">Cari:</label>
            <input type="text" id="search">
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Id Mapel</th>
                <th scope="col">Nama Mapel</th>
                <th scope="col">Edit</th>
                <th scope="col">Hapus</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>Ahmad</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>Ahmad</td>
                </tr>
                <tr>
            </tbody>
        </table>
        <div class="pagination">
            <button>Kembali</button>
            <button class="active">1</button>
            <button>Selanjutnya</button>
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
    <script src="js/script.js"></script>
</body>
</html>