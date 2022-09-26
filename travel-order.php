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
  <title>Travel Order | Lakbayan Travels and Tours</title>
</head>

<body>
  <?php
  include 'includes/components/nav.php';
  include 'includes/components/accountModal.php';
  ?>

  <section class="sections t-order" id="t-order">
    <div class="banner-half">
      <video src="assets/media/falls.mp4" muted loop autoplay preload="auto"></video>
      <div class="text">
        <input type="text" placeholder="Where'd you wanna go?" class="field" />
        <span class="ico"><i class="fas fa-search"></i></span>
      </div>
    </div>

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
      <div class="spec-content">
        <h1>Payment Status</h1>
        <p id="status" style="text-align: justify;">
          The payment for this booking is currently <strong>pending</strong>. Please select one of th following payment methods available.
        </p>
        <h1 class="amt">P15,000</h1>
        <p class="pen">PENDING AMOUNT</p>

        <div class="payment active" id="payment">
          <div class="main gcash">
            <h1>GCash</h1>
            <div>
              <p>Method #1: GCash Payment Portal</p>
              <button>Pay Now!</button>
            </div>
            <div>
              <p>Method #2: QR Code Scan</p>
              <p style="text-align: justify;">Scan this QR Code using your GCash Mobile App.</p>
              <img src="assets/img/LakbayanQRCode.jpg" alt="">
            </div>
          </div>

          <div class="main right">
            <div class="bank">
              <h1>Bank Accounts</h1>
              <div>
                <p style="font-weight: bold;">BDO</p>
                <p>Account Name: Juan Dela Cruz</p>
                <p>Account Number: 001930300485</p>
              </div>
              <div>
                <p style="font-weight: bold;">BPI</p>
                <p>Account Name: Juan Dela Cruz</p>
                <p>Account Number: 122672310817</p>
              </div>
            </div>
            <div class="trans">
              <h1>Money Transfer</h1>
              <p style="font-weight: bold;">Palawan Express</p>
              <p>Name: Juan Dela Cruz</p>
              <p>Number: 0999-432-9680</p>
              <br>
            </div>
            <div class="receipt" id="receipt">
              <p style="text-align: justify;">Please upload the receipt/proof of transaction for the chosen payment method here.</p>
              <input type="file" name="" id="">
              <button onclick="changeStatus()">Submit</button>
            </div>
          </div>
        </div>

        <div class="payment-agency" id="payment-agency">
          <div class="cont">
            <h1>Receipt Submitted</h1>
            <img src="assets/img/receipt.jpg" alt="">
          </div>
          <div class="details">
            <h1>Customer Information</h1>

            <p style="margin-top: 1rem;">Name: John Mark De Ocampo</p>
            <p>Travel Package: Campuestohan Highland Resort</p>
            <p>Number of Persons: 5</p>
            <p>Number of Days: 3</p>
            <p>Trip Date: September 11, 2022</p>

            <button onclick="confirm()">Confirm Payment</button>
          </div>

        </div>

        <button onclick="viewAgency()">Change View</button>
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
    function changeStatus() {
      var text = document.getElementById('status');
      text.innerHTML = "The payment for this booking <strong>has been sent</strong>. Please wait for the confirmation of the Travel Agency if the payment has been received."
    }

    function viewAgency() {
      var text = document.getElementById('status');
      text.innerHTML = "The payment for this booking <strong>has been sent</strong>. Please review the submitted proof and confirm the payment."
      
      var usercontainer = document.getElementById('payment');
      var agencycontainer = document.getElementById('payment-agency');

      usercontainer.classList.remove('active');
      agencycontainer.classList.add('active');
    }

    function confirm() {
      var text = document.getElementById('status');
      text.innerHTML = "The payment for this booking <strong>has been confirmed</strong> by the Travel Agency."
      
      var usercontainer = document.getElementById('payment');
      var agencycontainer = document.getElementById('payment-agency');
      var statusbar = document.getElementById('thisbar');
      var status = document.getElementById('thisicon');
      var receipt = document.getElementById('receipt');

      usercontainer.classList.add('active');
      agencycontainer.classList.remove('active');
      statusbar.classList.remove('gray');
      statusbar.classList.add('green');
      status.classList.remove('gray');
      status.classList.add('green');
      receipt.style.display = "none";
    }
  </script>

</body>

</html>