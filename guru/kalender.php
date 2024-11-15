<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Learning</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
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
      <div class="breadcrumb">
        <strong style="background-color: white"> SMK 7 JEMBER (E-Learning) </strong>
        <br />
        Dashboard /
        <a href="#"> Kalender </a>
        / September 2024
      </div>
      <div class="calendar">
        <div class="calendar-header">
          <div class="nav">
            <i class="fas fa-chevron-left"> </i>
          </div>
          <h2>Agustus 2024</h2>
          <h2>September 2024</h2>
          <h2>Oktober 2024</h2>
          <div class="nav">
            <i class="fas fa-chevron-right"> </i>
          </div>
        </div>
        <table class="calendar-table">
          <thead>
            <tr>
              <th>Senin</th>
              <th>Selasa</th>
              <th>Rabu</th>
              <th>Kamis</th>
              <th>Jumat</th>
              <th>Sabtu</th>
              <th>Minggu</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>5</td>
              <td>6</td>
              <td>7</td>
            </tr>
            <tr>
              <td>8</td>
              <td>9</td>
              <td>10</td>
              <td>11</td>
              <td>12</td>
              <td>13</td>
              <td>14</td>
            </tr>
            <tr>
              <td>15</td>
              <td>16</td>
              <td>17</td>
              <td>18</td>
              <td>19</td>
              <td>20</td>
              <td>21</td>
            </tr>
            <tr>
              <td>22</td>
              <td>23</td>
              <td>24</td>
              <td>25</td>
              <td>26</td>
              <td>27</td>
              <td>28</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <script src="../js/script.js"></script>
  </body>
</html>
