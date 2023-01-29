<?php
session_start();
$_SESSION['active'] = 'email';
if (isset($_SESSION['isLoggedIn']) == false) {
  $_SESSION['isLoggedIn'] = false;
} 

if (isset($_SESSION['token']) == false and isset($_SESSION['recovery-email']) == false){
  header("Location: http://".$_SERVER['HTTP_HOST'] ."/index.php");
  // header("Location: http://".$_SERVER['HTTP_HOST'] ."/Finals/index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../assets/css/modal.css">
  <link rel="stylesheet" href="../../assets/css/login.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/footer.css">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <link rel="icon" href="../../assets/img/logo.png" />
  <title>Packages | Lakbayan Travels and Tours</title>
</head>

<body style="background-color: #f5f5f5;">
  <?php
  include __DIR__.'/../../includes/components/nav.php';
  include __DIR__.'/../../includes/components/accountModal.php';
  include __DIR__.'/../connect/dbCon.php';
  ?>

  <section class="sections reset-email" style="margin-top: 100px;">
    <div class="card">
      <h1>Reset Password</h1>
      <form action="#" method="POST" name="login">

        <div class="pass-field">
          <label for="password">New Password</label>
          <input type="password" id="password" class="form-control" name="password" required autofocus>
        </div>
        <div class="pass-field">
          <label for="cpassword">Confirm Password</label>
          <input type="password" id="cpassword" class="form-control" name="cpassword" required>
        </div>

        <div style="width: 100%; margin-top: 2rem; text-align: center;">
          <input type="submit" value="Save Changes" name="reset">
        </div>
      </form>
    </div>
    </div>
  </section>
  <?php
  if (isset($_POST["reset"])) { 
    include __DIR__."/../connect/dbCon.php";
    $psw = mysqli_real_escape_string($conn, $_POST["password"]);
    $cpsw = mysqli_real_escape_string($conn, $_POST["cpassword"]);

    if (trim($psw) == trim($cpsw)) {
      $token = $_SESSION['token'];
      $email = $_SESSION['recovery-email'];

      $hash = password_hash($psw, PASSWORD_BCRYPT);

      $sql = mysqli_query($conn, "SELECT * FROM user_tbl WHERE email='$email'");
      $fetch = mysqli_fetch_assoc($sql);

      if ($fetch['email'] == $email) {
        $new_pass = $hash;
        mysqli_query($conn, "UPDATE user_tbl SET password='$new_pass' WHERE id={$fetch['id']} AND email='$email'");
  ?>
      <script>
        window.location.replace("../../index.php");
        alert("Your password has been successfully reset.");
      </script>
    <?php
      } else {
    ?>
      <script>
        alert("ERROR. Code 0 - An error with the database has been encountered.");
      </script>
  <?php
      }
    } else {
  ?>
    <script>
      alert("Confirm Password must match with the Password.");
    </script>
  <?php
    }
  }
  ?>

  <footer class="site-footer" style="position: absolute; bottom: 0;">
    <div class="container">
      <div class="logo">
        <img src="../../assets/img/logo.png" alt="" />
      </div>
      <div class="abt">
        <h1>About</h1>
        <p>Lakbayan Travel and Tours will provide a convenient and
          premium travel and tour service for local destinations in the
          Philippines. Lakbayan Travel and Tours offers tourists destinations
          that they would love and relax in. We also provide essential
          information to clients so that they are familiar with the culture of
          their chosen places.</p>
      </div>
      <div class="quick-links">
        <h1>Quick Links</h1>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="destinations.php">Destinations</a></li>
          <li><a href="packages.php">Packages</a></li>
          <li><a href="about.php">About</a></li>
        </ul>
      </div>
      <div class="soc-med">
        <h1>Contact Us</h1>
        <div class="contact">
          <div class="info">
            <span><i class="fas fa-phone-alt"></i></span>
            <p>0961 285 3038</p>
          </div>
          <div class="info">
            <span><i class="fas fa-map-marker-alt"></i></span>
            <p>Manila, Philippines</p>
          </div>
        </div>

        <div class="icons">
          <a href="facebook.com"><i class="fab fa-facebook-f"></i></a>
          <a href="twitter.com"><i class="fab fa-twitter"></i></a>
          <a href="instagram.com"><i class="fab fa-instagram"></i></a>
          <a href="youtube.com"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
  </footer>

  <script>
    var $nav = $("._nav");

    $nav.toggleClass("scrolled", true);
    
  </script>

</body>

</html>