<?php
session_start();
$_SESSION['active'] = 'pack';
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
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/footer.css">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="assets/img/logo.png" />
  <title>Packages | Lakbayan Travels and Tours</title>
</head>

<body>
  <?php
  include 'includes/components/nav.php';
  include 'includes/components/accountModal.php';

  if ($_SESSION['booking-stat'] != 'none') {
    if ($_SESSION['booking-stat'] == 'success') {
      echo <<<END
        <div class="modal-container show" id="amodal_container">
        <div class='modal'>
          <h1>Hooray!</h1>
          <p>Your booking information has been sent. We'll contact you as soon as possible.</p>
          <div class="buttons">
            <a id="modalBClose" class="btn">Got it!</a>
          </div>
        </div>
        </div>  
        END;
      $_SESSION['booking-stat'] = 'none';
    } else {
      echo <<<END
        <div class="modal-container show" id="amodal_container">
        <div class='modal'>
          <h1>Oops!</h1>
          <p>We are not able to process your inquiry. Maybe try again later?</p>
          <div class="buttons">
            <a id="modalBClose" class="btn">Alright!</a>
          </div>
        </div>
        </div>  
        END;
      $_SESSION['booking-stat'] = 'none';
    }
  }

  ?>
  <script>
    const emodal_container = document.getElementById('amodal_container');
    const eclose = document.getElementById('modalBClose');

    eclose.addEventListener('click', () => {
      emodal_container.classList.remove('show');
    })
  </script>

  <section class="sections packages" id="destinations">
    <div class="banner-half">
      <video src="assets/media/falls.mp4" muted loop autoplay preload="auto"></video>
      <div class="text">
        <input type="text" placeholder="Where'd you wanna go?" class="field" />
        <span class="ico"><i class="fas fa-search"></i></span>
      </div>
    </div>

    <div class="package-container">
      <div class="filter-container">
        <h3>FILTER RESULTS</h3>
        <div class="filter filter-rating">
          <p class="header">Rating</p>
          <div class="rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
          </div>
          <div class="rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
              & Up
          </div>
          <div class="rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              & Up
          </div>
          <div class="rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              & Up
          </div>
          <div class="rating">
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              & Up
          </div>
        </div>
        <div class="filter filter-duration">
          <p class="header">Duration</p>
          <input type="range" min="1" max="14" step="1" value="0">
          <p class="days">Day(s): 1</p>
        </div>
        <div class="filter filter-price">
          <p class="header">Price</p>
          <div class="inputs">
            <input type="text" placeholder="MIN">
            <p>to</p>
            <input type="text" placeholder="MAX">
          </div>
          <button class="apply-filter">APPLY</button>
        </div>
      </div>
      <div class="card-container">
        <div class="wrapper">
          <div class="border"><a href="includes/packages/lakawon.php">LEARN MORE</a></div>
          <div class="image">
            <img src="assets/img/Lakawon1.jpg" alt="">
          </div>
          <div class="content">
            <h2>Lakawon Island Day Tour</h2>
            <p style="font-size: 12px;">by <a href="agency-profile.php">Lakbayan Travel and Tours</a></p>
            <div class="rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="price">
              <p class="amt">P2,100</p>
              <p style="font-size: 12px;">PER PERSON</p>
            </div>
          </div>
          <div class="learn-btn">
              <a href="includes/packages/lakawon.php">LEARN MORE</a>
          </div>
        </div>

        <div class="wrapper">
          <div class="border"><a href="includes/packages/lakawon.php">LEARN MORE</a></div>
          <div class="image">
            <img src="assets/img/Campuestohan1.jpeg" alt="">
          </div>
          <div class="content">
            <h2>Campuestohan Highland Resort</h2>
            <p style="font-size: 12px;">by <a href="agency-profile.php">Lakbayan Travel and Tours</a></p>
            <div class="rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="price">
              <p class="amt">P2,100</p>
              <p style="font-size: 12px;">PER PERSON</p>
            </div>
          </div>
          <div class="learn-btn">
              <a href="includes/packages/campuestohan.php">LEARN MORE</a>
          </div>
        </div>

        <div class="wrapper">
          <div class="border"><a href="includes/packages/lakawon.php">LEARN MORE</a></div>
          <div class="image">
            <img src="assets/img/tri 1.jpg" alt="">
          </div>
          <div class="content">
            <h2>Tri-City (Bacolod - Silay - Talisay) Exclusive Day Tour</h2>
            <p style="font-size: 12px;">by <a href="agency-profile.php">Lakbayan Travel and Tours</a></p>
            <div class="rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="price">
              <p class="amt">P2,100</p>
              <p style="font-size: 12px;">PER PERSON</p>
            </div>
          </div>
          <div class="learn-btn">
              <a href="includes/packages/tri.php">LEARN MORE</a>
          </div>
        </div>

        <div class="wrapper">
          <div class="border"><a href="includes/packages/lakawon.php">LEARN MORE</a></div>
          <div class="image">
            <img src="assets/img/Ruinsmain.jpeg" alt="">
          </div>
          <div class="content">
            <h2>The Ruins Day Tour</h2>
            <p style="font-size: 12px;">by <a href="agency-profile.php">Lakbayan Travel and Tours</a></p>
            <div class="rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="price">
              <p class="amt">P2,100</p>
              <p style="font-size: 12px;">PER PERSON</p>
            </div>
          </div>
          <div class="learn-btn">
              <a href="includes/packages/ruins.php">LEARN MORE</a>
          </div>
        </div>

        <div class="wrapper">
          <div class="border"></div>
          <div class="image">
            <img src="assets/img/Ruinsmain.jpeg" alt="">
          </div>
          <div class="content">
            <h2>The Ruins Day Tour</h2>
            <p style="font-size: 12px;">by <a href="agency-profile.php">Lakbayan Travel and Tours</a></p>
            <div class="rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
            <div class="price">
              <p class="amt">P2,100</p>
              <p style="font-size: 12px;">PER PERSON</p>
            </div>
          </div>
          <div class="learn-btn">
              <a href="includes/packages/ruins.php">LEARN MORE</a>
          </div>
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

  <script>
    var elem = document.querySelector('input[type="range"]');

    var rangeValue = function(){
      var newValue = elem.value;
      var target = document.querySelector('.days');
      target.innerHTML = "Day(s): " + newValue;
    }

    elem.addEventListener("input", rangeValue);
  </script>
</body>

</html>