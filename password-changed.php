<?php require_once "controllerUserData.php"; ?>
<?php
if($_SESSION['info'] == false){
    header('Location: login.php');  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Berhasil merubah password</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="css/header-sidebar.css">
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
          <h3 class="name">SMKN 7 Jember</h3>
          <span class="country">Website pembelajaran E-learning</span>
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

    <!-- konten lupa password -->
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
            <?php 
            if(isset($_SESSION['info'])){
                ?>
                <div class="alert alert-success text-center">
                <?php echo $_SESSION['info']; ?>
                </div>
                <?php
            }
            ?>
                <form action="login.php" method="GET">
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Masuk sekarang">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/script.js"></script>
</body>
</html>