<?php
session_start();
$_SESSION['active'] = 'about';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/modal.css">
  <link rel="stylesheet" href="assets/css/about.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/footer.css">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="assets/img/logo.png" />
  <title>About us | Lakbayan Travels and Tours</title>
</head>

<body>
  <?php 
    include __DIR__.'/includes/components/nav.php';
    include __DIR__.'/includes/components/accountModal.php';
  ?>
  <section class="sections about-us" id="about-us" style="margin-top: 5rem;">

    <div class="content">
      <h1>We aspire to make a difference in everything we do.</h1>
      <p>Have you ever wondered where you should go on your next vacation during the post-pandemic?
        Are you having trouble finding a good website where you can choose
        your trip and book a stay at the same time? This website is dedicated
        to you. </p>
      <video class="center" src="assets/media/balloons.mp4" muted loop autoplay preload="auto"></video>
      <p>Lakbayan Travel and Tours will provide a convenient and
        premium travel and tour service for local destination in the
        Philippines, specifically in the Negros Occidental province. 
        Lakbayan Travel and Tours offers tourists the destinations
        that they would love and relax in. We also provide essential
        information to clients so that they are familiar with the culture of
        their chosen places. "Lakbayan" or Lakbay Bayan travel & tours is a
        website that allows visitors to conveniently browse tourist spots.</p>
    </div>
    <div class="colored">
      <div class="mission">
        <span class="inf">
          <h2>MISSION</h2>
          <p>To provide a great travel tour and experience to it's customer in the Philippines, Lakbayan Travel
            and Tours places a strong emphasis on customer satisfaction while also promoting local destinations.
            We acknowledge that the change in tourism during the pandemic provides us with the chance to create 
            an environment where travelers may be aware and enjoy a safe journey.
          </p>
          <p>
            Our mission is to spread the culture and wonders of our local tourist destinations via the medium of our website
            and to have a great experience following the travel booking.
          </p>
        </span>
        <span class="inf">
          <h2>VISION</h2>
          <p>Our vision is to create a comfortable atmosphere where the customer can travel with confidence and expect to have
             a good time when visiting their chosen destinations. Furthermore, we aspire to be a locally independent travel agency
              when it comes to promoting the tourist industry in the Philippines through the use of IT Solutions for travel inquiries and fulfilling our customers' needs
          </p>
        </span>
      </div>
    </div>


    <div class="team">
      <h1>Meet the Lakbayan Team</h1>
      <div class="card-container">
        <div class="card">
          <img src="assets/img/JM.jpeg" alt="">
          <h3>John Mark De Ocampo</h3>
          <p>Project Manager</p>
        </div>
        <div class="card">
          <img src="assets/img/aj.png" alt="">
          <h3>Jeremiah Galzote</h3>
          <p>Project Manager</p>
        </div>
        <div class="card">
          <img src="assets/img/JV.jpg" alt="">
          <h3>John Vincent Ayala</h3>
          <p>Front-end Developer</p>
        </div>
        <div class="card">
          <img src="assets/img/vash.png" alt="" style="background: white;">
          <h3>Jeanne Francis Rivas</h3>
          <p>Back-end Developer</p>
        </div>
      </div>
    </div>
  </section>

  <footer class="site-footer">
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
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script>
    $(function() {
      var $nav = $("._nav");
      $nav.toggleClass("scrolled", true);
    });
  </script>

</body>

</html>