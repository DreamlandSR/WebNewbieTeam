<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Learning</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="../css/kalender.css" />
</head>
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
<div class="dropdown" id="dropdown">
    <a href="menu_kelas.php"> XII TKJ 1 </a>
    <a href="menu_kelas.php"> XII TKJ 2</a>
    <a href="menu_kelas.php"> XII MM 1 </a>
    <a href="menu_kelas.php"> XII MM 2 </a>
</div>
</div>
<div class="content">
    <div class="breadcrumb">
    <p>Kalender Akademik</p>
    <a href="admin.php">Dashboard</a> /
    <a href="kalender.php">Kalender</a> /
        <span>
            <?php
        $month = isset($_GET['month']) ? $_GET['month'] : date('n'); 
        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

        // Tampilkan nama bulan dan tahun
        echo date("F Y", strtotime("$year-$month-01"));
        ?>
        </span>

        </div>
        <?php
    // Ambil bulan dan tahun dari URL, atau defaultkan ke bulan dan tahun sekarang
    $month = isset($_GET['month']) ? $_GET['month'] : date('n'); 
    $year = isset($_GET['year']) ? $_GET['year'] : date('Y'); 

    // Menentukan jumlah hari dalam bulan tertentu
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // Menentukan hari pertama bulan tersebut
    $firstDayOfMonth = strtotime("$year-$month-01");
    $firstDayName = date('w', $firstDayOfMonth); // Hari pertama dalam angka (0=Sunday, 6=Saturday)
    ?>

        <table class="calendar-table">
            <thead>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
            </thead>
            <tbody>
                <?php
            // Membuat baris pertama kosong sesuai dengan hari pertama bulan
            $currentDay = 1;
            echo '<tr>';

            // Tambahkan spasi kosong sebelum hari pertama
            for ($i = 0; $i < $firstDayName; $i++) {
                echo '<td class="empty"></td>';
            }

            // Isi tanggal-tanggal
            for ($i = $firstDayName; $i < 7; $i++) {
                echo '<td>' . $currentDay++ . '</td>';
            }
            echo '</tr>';

            // Isi sisa tanggal-tanggal
            while ($currentDay <= $daysInMonth) {
                echo '<tr>';
                for ($i = 0; $i < 7; $i++) {
                    if ($currentDay <= $daysInMonth) {
                        echo '<td>' . $currentDay++ . '</td>';
                    } else {
                        echo '<td class="empty"></td>';
                    }
                }
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>

        <div class="calendar-footer">
            <span>Kalender <?php echo date("F Y", strtotime("$year-$month-01")); ?></span>
        </div>
    </div>

</div>
<script src="../js/script.js"></script>
</body>

</html>