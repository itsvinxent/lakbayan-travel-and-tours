<?php
session_start();
$_SESSION['active'] = 's-pack';
if(isset($_SESSION['isLoggedIn']) == false) {
  $_SESSION['isLoggedIn'] = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../assets/css/style.css" />
  <link rel="stylesheet" href="../../assets/css/modal.css" />

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- flatpickr -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />

  <link rel="icon" href="../../assets/img/logo.png" />
  <title>Packages | Lakbayan Travels and Tours</title>
</head>

<body>
  <?php 
  include '../components/nav.php';
  include '../components/accountModal.php';
  ?>

  <section class="packages-pages">
    <div class="banner-half">
      <video src="../../assets/media/falls.mp4" muted loop autoplay preload="auto"></video>
      <div class="text">
        <h1>Packages</h1>
        <h2>PAY LESS FOR YOU TRAVELS WITH DISCOUNTED BUNDLES</h2>
      </div>
    </div>

    <div class="header">
      <a href="../../packages.php">
        <span>
          <i class="fas fa-angle-left"></i>
        </span>
        <span>
          <p>Back to Packages</p>
        </span>
      </a>
    </div>

    <div class="content">
      <div class="right">
        <div class="slider">
          <div class="slides">
            <input type="radio" name="nav-btn" id="btn1" />
            <input type="radio" name="nav-btn" id="btn2" />
            <input type="radio" name="nav-btn" id="btn3" />

            <div class="slide first">
              <img src="../../assets/img/Lakawon.png" alt="" />
            </div>
            <div class="slide">
              <img src="../../assets/img/Lakawon2.jpg" alt="" />
            </div>
            <div class="slide">
              <img src="../../assets/img/Lakawon3.jpg" alt="" />
            </div>

            <div class="nav-auto">
              <div class="auto-btn1"></div>
              <div class="auto-btn2"></div>
              <div class="auto-btn3"></div>
            </div>
          </div>
          <div class="nav-manual">
            <label for="" class="nav-btn prev-btn" id="prev-btn"><i id="prev-btn" class="fas fa-chevron-left"></i></label>
            <label for="btn1" class="manual-btn"></label>
            <label for="btn2" class="manual-btn"></label>
            <label for="btn3" class="manual-btn"></label>
            <label for="" class="nav-btn next-btn"><i id="next-btn" class="fas fa-chevron-right"></i></label>
          </div>
        </div>
        <?php
        if (isset($_SESSION['isLoggedIn']) == true) {
          if ($_SESSION['isLoggedIn'] == true) {
            echo '<form action="../../backend/booking/booktrip.php" method="POST">';
          } else {
            echo '<form action="../../index.php#login">';
            $_SESSION['toSignIn'] = false;
          }
        } else {
          echo '<form action="../../index.php#login">';
          $_SESSION['toSignIn'] = false;
        }
        ?>

        <div class="reservation">
          <div class="contact">
            <div class="info">
              <span><i class="fas fa-map-marker-alt"></i></span>
              <p>Locations included</p>
            </div>
            <a href="#" style="margin-left: 25px">Lakawon Island Resort</a>
            <div class="info">
              <span><i class="fas fa-phone-alt"></i></span>
              <p>Telephone No/s.</p>
            </div>
            <p style="margin-left: 25px">0961 285 3038</p>
            <p style="margin-left: 25px">0999 432 9680</p>
          </div>
          <div class="booking">
            <div class="info">
              <span><i class="far fa-calendar-alt"></i></span>

              <input type="datetime-local" name="resdate" placeholder="Select Starting Date" />

            </div>

            <p>Book in advance</p>
            <a id="modalBOpen" class="book-btn">Check Availability</a>
            <div class="justify">
              <p class="sml-txt">
                <span>Reserve now & pay later:</span>
                <span>Save your spot free of</span>
                <span>charge with flexible booking.</span>
              </p>
            </div>
          </div>
          <div class="bmodal-container" id="bmodal_container">
            <?php if ($_SESSION['isLoggedIn'] == false) {
              echo "<div class='modal'>
                <h1>Login Required!</h1>
                <p>We're glad that you've chosen us for your travel needs. But first, login your account and start booking with us!</p>
                <button id='modalLogin' class='modal-login'>Sign In Now</button>
                <a id=\"modalBClose\" class=\"btn\">Maybe next time</a>
              </div>";
            } else {
              $lname = $_SESSION['lname'];
              $fname = $_SESSION['fname'];
              $email = $_SESSION['email'];
              echo "
                <div class=\"booking-modal\">
                <h1>Booking Information</h1>
                <p>Enter the following details and our team will contact you if the location is available on your chosen date.</p>
                  <input type=\"hidden\" name=\"loc\" value=\"lakawon\"/>
                  <input id=\"fname\" type=\"text\" name=\"fname\" placeholder=\"First Name\" value=\"$fname\" required/>
                  <input id=\"lname\" type=\"text\" name=\"lname\" placeholder=\"Last Name\" value=\"$lname\" required/>
                  <input type=\"email\" name=\"email\" placeholder=\"Email\" value=\"$email\" required />
                  <input type=\"text\" name=\"number\" placeholder=\"Contact Number\" required/>
                  <input type=\"number\" min=\"1\" max=\"10\" name=\"persons\" placeholder=\"No. of Persons\" required>
                  <input type=\"number\" min=\"1\" max=\"4\" name=\"duration\" placeholder=\"No. of Days\" required>
                  <textarea name=\"msg\" id=\"msg\" rows=\"10\" placeholder=\"Any other messages? (100 characters maximum)\"></textarea>

                <div class=\"buttons\">
                  <button id=\"modalLogin\" class=\"modal-login\" >Book Now</button>
                  <a id=\"modalBClose\" class=\"btn\">Close</a>
                </div>
              </div>";
            }
            ?>
          </div>
          <?php echo "</form>"; ?>
          <script>
            const bopen = document.getElementById('modalBOpen');
            const bmodal_container = document.getElementById('bmodal_container');
            const bclose = document.getElementById('modalBClose');

            bopen.addEventListener('click', () => {
              bmodal_container.classList.add('show');
            })

            bclose.addEventListener('click', () => {
              bmodal_container.classList.remove('show');
            })
          </script>
        </div>
      </div>

      <div class="left">
        <h1>Lakawon Island Day Tour</h1>
        <h2>About:</h2>

        <p style="text-align: justify;">
        Lakawon, also called Llacaon, is a 16-hectare, banana-shaped island off the coast of Cadiz in the northern portion of Negros Occidental, a province in the 
        Negros Island Region of the Philippines. It is the home of TawHai, the biggest floating bar in Asia. 
        <br>
        At Lakawon, an air of tranquility is adorned with shady coconut trees, and there is no better spot to watch the gentle waves far from the noise and congestion of the modern world. 
        The distinctive atmosphere is evident throughout the resort, from the warm and welcoming staff to the woven roofs of the cottage.
        </p>
        <p>
          <br />
          Inclusions:<br />
          - Transportation of traveler<br />
          - Hotel Reservation<br />
          - Entrance Fees<br />
          - Local Driver<br />
        </p>
      </div>
    </div>

    <div class="snapshot">
      <h1>Package Snapshot</h1>
      <div class="box-container">
        <div class="box">
          <!-- <i class="far fa-money-bill-alt"></i> -->
          <img src="../../assets/img/icons8-income-48.png" alt="" />
          <h3>Price</h3>
          <p>
            P7,500.00 <br />
            Per Person
          </p>
        </div>
        <div class="box">
          <!-- <i class="far fa-clock"></i> -->
          <img src="../../assets/img/icons8-process-64.png" alt="" width="48px" />
          <h3>Duration</h3>
          <p>1 day Tour</p>
        </div>
        <div class="box">
          <!-- <i class="fas fa-bed"></i> -->
          <img src="../../assets/img/icons8-bed-48.png" alt="" />
          <h3>Rooms</h3>
          <p>
            Hotel Reservations
          </p>
        </div>
        <div class="box">
          <!-- <i class="fas fa-plane-slash"></i> -->
          <img src="../../assets/img/icons8-map-64.png" alt="" width="48px" />
          <h3>Cancellation</h3>
          <p>
            Free cancellation <br />
            24hrs prior to arrival
          </p>
        </div>
      </div>
    </div>

    <div class="recommendations">
      <h1>Packages Worth Checking</h1>
      <div class="card-container">
        <div class="card">
          <img src="../../assets/img/Underground2.jpg" alt="" />
          <span> <a href="ilaya.php">
              <p class="dest">Ilaya Resort</p>
              <p class="location">Silay</p>
            </a></span>
        </div>
        <div class="card">
          <img src="../../assets/img/Nacpan2.jpg" alt="" />
          <span> <a href="nabila.php">
              <p class="dest">Nabulao Beach and Dive Resort</p>
              <p class="location">Sipalay</p>
            </a></span>
        </div>
        <div class="card">
          <img src="../../assets/img/bantayan2.jpg" alt="" />
          <span><a href="campuestohan.php">
              <p class="dest">Campuestohan Highland Resort</p>
              <p class="location">Mt. Makawili, Talisay City</p>
            </a></span>
        </div>
        <div class="card">
          <img src="../../assets/img/kawasan 2.jpg" alt="" />
          <span><a href="tri.php">
              <p class="dest">Tri-city Bacolod Day Tour</p>
              <p class="location">Bacolod City</p>
            </a></span>
        </div>
      </div>
    </div>
  </section>

  <footer class="site-footer">
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
          <li><a href="../../index.html">Home</a></li>
          <li><a href="../../destinations.html">Destinations</a></li>
          <li><a href="../../packages.html">Packages</a></li>
          <li><a href="../../about.html">About</a></li>
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

  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- flatpickr -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <script>
    $(function() {
      $(document).scroll(function() {
        var $nav = $("._nav");

        $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
      });
    });
  </script>
  <script>
    flatpickr("input[type=datetime-local]", {
      dateFormat: "D, M d Y",
      minDate: "today",
      defaultDate: "today"
    });
  </script>
  <script src="../../assets/js/slider.js"></script>
</body>

</html>