<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
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
    
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forgot-password.php" method="POST" autocomplete="">
                    <h2 class="text-center">Lupa password</h2>
                    <p class="text-center">Masukkan email anda</p>
                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control" id="input-text" type="email" name="email" placeholder="Masukkan email anda" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Kirim kode">
                    </div>
                </form>
            </div>
        </div>

      <!-- <div class="footer">
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
      </div> -->
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/script.js"></script>
</body>
</html>