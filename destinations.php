<?php 
  session_start(); 
  $_SESSION['active'] = 'dest';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/modal.css">
  <link rel="stylesheet" href="assets/css/destinations.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/footer.css">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="assets/img/logo.png">
  <title>Destinations | Lakbayan Travels and Tours</title>
</head>

<body>
  <?php 
    include 'includes/components/nav.php';
    include 'includes/components/accountModal.php';
  ?>
  <section class="sections destinations" id="destinations">
    <div class="banner-half">
      <video src="assets/media/sea.mp4" muted loop autoplay preload="auto"></video>
      <div class="text">
        <h1>Destinations</h1>
        <h2>
          HERE ARE SOME OF THE FEATURED DESTINATIONS INCLUDED IN THE PACKAGES
        </h2>
      </div>
    </div>

    <div class="card-container">
      <div class="wrap">
        <img src="assets/img/Ruinsmain.jpeg" alt="" />
        <div class="cap">
          <h2>The Ruins</h2>
          <p class="fee">
            The ruins of an ancestral mansion in Talisay,
            just outside of Bacolod City, are known....
          </p>
          <a href="includes/destinations/The Ruins.php"><button class="btn">Learn More</button></a>
        </div>
      </div>

      <div class="wrap">
        <img src="assets/img/Campuestohan1.jpeg" alt="" />
        <div class="cap">
          <h2>Campuestohan Highland Resort</h2>
          <p class="fee">
              Campuestohan Highland Resort, 
              a new tourist destination in Negros Occidental province....
          </p>
          <a href="includes/destinations/Campuestohan.php"><button class="btn">Learn More</button></a>
        </div>
      </div>

      <div class="wrap">
        <img src="assets/img/Carbin.jpg" alt="" />
        <div class="cap">
          <h2>Carbin Reef</h2>
          <p class="fee">
            Located off the coast of Sagay in Negros Occidental province, Carbin Reef is a massive....
          </p>
          <a href="includes/destinations/Kawasan falls.php"><button class="btn">Learn More</button></a>
        </div>
      </div>

      <div class="wrap">
        <img src="assets/img/Lakawon.png" alt="" />
        <div class="cap">
          <h2>Lakawon Island</h2>
          <p class="fee">
            The 13-hectare (32-acre) island of Lakawon lies just off the coast of Cadiz and is shaped like a banana.
            On a pristine stretch of....
          </p>
          <a href="includes/destinations/Lakawon Island.php"><button class="btn">Learn More</button></a>
        </div>
      </div>

      <div class="wrap" id="nagpatong">
        <img src="assets/img/Nacpan.png" alt="" />
        <div class="cap">
          <h2>Nacpan Beach</h2>
          <p class="fee">
            Four kilometers of white sand and coconut trees line Nacpan Beach, which is surrounded by turquoise waters.
            It is situated 17 kilometers north of El Nido, the capital of Palawan's...
          </p>
          <a href="includes/destinations/Nacpan Beach.php"><button class="btn">Learn More</button></a>
        </div>
      </div>

      <div class="wrap">
        <img src="assets/img/Barracuda.png" alt="" />
        <div class="cap">
          <h2>Barracuda Lake</h2>
          <p class="fee">
            Barracuda Lake resembles a fantasy world in comparison. To reach Barracuda Lake, you must first navigate
            a path winding through spectacularly craggy rocks, which looks like something...
          </p>
          <a href="includes/destinations/Barracuda Lake.php"><button class="btn">Learn More</button></a>
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
      $(document).scroll(function() {
        var $nav = $("._nav");

        $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
      });
    });
  </script>
  <!-- <script>
    // Mobile Onclick
    var wrap = document.querySelectorAll(".wrap");
    wrap.forEach(element => {
      
      element.addEventListener('click', () => {
        wrap.forEach(e => { 
          e.lastElementChild.style.opacity = "0";
        });
        var target = element.lastElementChild;
        target.style.opacity = "1";
      })
    });
  </script> -->

</body>

</html>