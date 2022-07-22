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
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/modal.css">

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
    if($_SESSION['booking-stat'] == 'success') {
      echo<<<END
        <div class="modal-container show" id="amodal_container">
        <div class='modal'>
          <h1>Hooray!</h1>
          <p>Your booking inquiry has been sent. We'll contact you as soon as possible.</p>
          <div class="buttons">
            <a id="modalBClose" class="btn">Got it!</a>
          </div>
        </div>
        </div>  
        END;
      $_SESSION['booking-stat'] = 'none';
    } else {
      echo<<<END
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
        <h1>Packages</h1>
        <h2>PAY LESS FOR YOU TRAVELS WITH DISCOUNTED BUNDLES</h2>
      </div>
    </div>

    <div class="card-container">
      <div class="wrap">
        <div class="image">
          <img src="assets/img/Lakawon1.jpg" alt="" />
          <div class="heart">
            <div class="h_container">
              <i id="heart" class="far fa-heart"></i>
            </div>
          </div>

        </div>

        <div class="cap">
          <h2>Lakawon Island Day Tour</h2>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <div class="data">
            Lakawon, also called Llacaon, is a 16-hectare, banana-shaped island off the coast of Cadiz in the northern portion of Negros Occidental, a province in the 
            Negros Island Region of the Philippines. It is the home of TawHai, the biggest floating bar in Asia. 
          </div>
        </div>
        <div class="price">
          <p>FROM</p>
          <p class="pr">P7,500.00</p>
          <a class="book-btn" href="includes/packages/lakawon.php">BOOK NOW</a>
        </div>
      </div>
    </div>

    <div class="card-container">
      <div class="wrap">
        <div class="image">
          <img src="assets/img/Campuestohan1.jpeg" alt="" />
          <div class="heart">
            <div class="h_container">
              <i id="heart" class="far fa-heart"></i>
            </div>
          </div>

        </div>

        <div class="cap">
          <h2>Campuestohan Highland Resort</h2>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <div class="data">
          The Campuestohan Highland Resort is situated at the foot of Mt. Makawili, on the border of Bacolod and Talisay. Swimming pools and a wave pool with bubbles are available at this themed entertainment park.
          </div>
        </div>
        <div class="price">
          <p>FROM</p>
          <p class="pr">P2,350.00</p>
          <a class="book-btn" href="includes/packages/campuestohan.php">BOOK NOW</a>
        </div>
      </div>
    </div>

    <div class="card-container">
      <div class="wrap">
        <div class="image">
          <img src="assets/img/tri 1.jpg" alt="" />
          <div class="heart">
            <div class="h_container">
              <i id="heart" class="far fa-heart"></i>
            </div>
          </div>

        </div>

        <div class="cap">
          <h2>Tri-City (Bacolod - Silay - Talisay) Exclusive Day Tour</h2>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <div class="data">
            Get to know more about the rich history and cultural heritage of Negros. This trip focuses on the Spanish heritage and the history of the sugarcane industry and haciendas of Negros. You will visit heritage houses, museums and century old churches guided by our DOT accredited tour guides.
          </div>
        </div>
        <div class="price">
          <p>FROM</p>
          <p class="pr">P3,161.25</p>
          <a class="book-btn" href="includes/packages/tri.php">BOOK NOW</a>
        </div>
      </div>
    </div>

    <div class="card-container">
      <div class="wrap">
        <div class="image">
          <img src="assets/img/Ilaya1.jpg" alt="" />
          <div class="heart">
            <div class="h_container">
              <i id="heart" class="far fa-heart"></i>
            </div>
          </div>

        </div>

        <div class="cap">
          <h2>Bacolod Ilaya Resort</h2>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <div class="data">
            Ilaya, located in the hilly area of Silay City, is one of the newest additions to Negros' must-see sites. With its Balinese-inspired architectural design perched atop a breathtaking vista of Silay, the Guimaras strait, and nearby islands, it is certainly a relaxing area to wallow in the wonderful splendor of nature, with the island of Panay further into the horizon.
          </div>
        </div>
        <div class="price">
          <p>FROM</p>
          <p class="pr">P2,200.00</p>
          <a class="book-btn" href="includes/packages/ilaya.php">BOOK NOW</a>
        </div>
      </div>
    </div>

    <div class="card-container">
      <div class="wrap">
        <div class="image">
          <img src="assets/img/Ruinsmain.jpeg" alt="" />
          <div class="heart">
            <div class="h_container">
              <i id="heart" class="far fa-heart"></i>
            </div>
          </div>
        </div>

        <div class="cap">
          <h2>The Ruins Day Tour</h2>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <div class="data">
          The Ruins of Talisay City has become famous for its naturally ruined beauty. The Ruins was built to memorialize the great love of a husband to his departed wife. Currently, the family of the grandson of Mercedes, Mr. Raymund Javellana, owns and maintains The Ruins.
          </div>
        </div>
        <div class="price">
          <p>FROM</p>
          <p class="pr">P2,100.00</p>
          <a class="book-btn" href="includes/packages/ruins.php">BOOK NOW</a>
        </div>
      </div>
    </div>

    <div class="card-container">
      <div class="wrap">
        <div class="image">
          <img src="assets/img/Nabulao1.jpg" alt="" />
          <div class="heart">
            <div class="h_container">
              <i id="heart" class="far fa-heart"></i>
            </div>
          </div>
        </div>

        <div class="cap">
          <h2>Nabila Beach and Dive Resort</h2>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
          </div>
          <div class="data">
            Featuring a free private carpark, a diving centre and a restaurant, Nabulao Beach And Dive Resort can be found within 9 km from the centre of Sipalay. The venue also offers airport transfer, 24-hour front desk assistance and concierge service.
          </div>
        </div>
        <div class="price">
          <p>FROM</p>
          <p class="pr">P4,500.00</p>
          <a class="book-btn" href="includes/packages/nabila.php">BOOK NOW</a>
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
  
</body>

</html>