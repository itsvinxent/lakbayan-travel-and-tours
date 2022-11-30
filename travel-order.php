<?php
session_start();
$_SESSION['active'] = 'profile';
if (isset($_SESSION['isLoggedIn']) == false) {
  $_SESSION['isLoggedIn'] = false;
}
if (isset($_SESSION['booking-stat']) == false) {
  $_SESSION['booking-stat'] = 'none';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/modal.css">
  <link rel="stylesheet" href="assets/css/packages.css">
  <link rel="stylesheet" href="assets/css/travel-order.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/footer.css">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="assets/img/logo.png" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>Travel Order | Lakbayan Travels and Tours</title>
</head>

<body>
  <?php
  include 'includes/components/nav.php';
  include 'includes/components/accountModal.php';
  ?>

  <section class="sections t-order" id="t-order" style="margin-top: 100px;">
    <div class="content">
      <div class="progress">
        <span class="icon green">
          <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/000000/external-booking-vacation-planning-solo-trip-flaticons-flat-flat-icons-2.png" />
          <p class="title">Booking Placed</p>
        </span>
        <span class="bar green"></span>

        <span class="icon green active">
          <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/000000/external-money-vacation-planning-solo-trip-flaticons-flat-flat-icons-3.png" />
          <p class="title active">Payment</p>
        </span>
        <span id="thisbar"class="bar gray"></span>

        <span id="thisicon" class="icon gray">
          <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/000000/external-road-trip-vacation-planning-solo-trip-flaticons-flat-flat-icons-2.png" />
          <p class="title">Trip Scheduled</p>
        </span>
        <span class="bar gray"></span>

        <span class="icon gray">
          <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/64/000000/external-checklist-vacation-planning-solo-trip-flaticons-flat-flat-icons-4.png" />
          <p class="title">Rate Destination</p>
        </span>

      </div>
      
    </div>
  </section>

  <!-- <footer class="site-footer">
    <div class="container">
      <div class="logo">
        <img src="assets/img/logo.png" alt="" />
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
  </footer> -->

  <script>
    var $nav = $("._nav");
    $nav.toggleClass("scrolled");
  </script>

  <script>
  
  </script>

</body>

</html>