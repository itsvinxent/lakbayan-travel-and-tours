<?php
session_start();
$_SESSION['active'] = 'profile';
if (isset($_SESSION['isLoggedIn']) == false) {
  $_SESSION['isLoggedIn'] = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/modal.css">
  <link rel="stylesheet" href="assets/css/profile.css">
  <link rel="stylesheet" href="assets/css/admin.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/footer.css">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="assets/img/logo.png" />
  <title>Profile | Lakbayan Travels and Tours</title>
</head>

<body>
  <?php
    include 'includes/components/nav.php';
    include 'includes/components/accountModal.php';
  ?>

  <section class="sections profile-user" id="packages">

    <div class="banner-half profile">
      <video src="assets/media/waves.mp4" muted loop autoplay preload="auto"></video>
    </div>

    <div class="profile-container">
      <div class="banner-logo profile">
        <div class="image">
          <img src="assets/img/JM.jpeg" alt="">
          <div class="middle">
            <div class="text"><i class="fas fa-pen"></i>Edit</div>
          </div>
        </div>
        <div class="top">
          <span>
            <h1 class="agency-name">John Mark De Ocampo</h1>
            <p>@jdelacruz</p>
          </span>
          <span class="ico-container">
            
          </span>
        </div>

      </div>

      <div class="nav">
        <ul class="tabs">
          <li data-tab-target="#info" class="tab active">Traveler Information</li>
          <li data-tab-target="#package" class="tab">Bookings</li>
        </ul>
      </div>

      <div class="tab-content">
        <div id="info" data-tab-content class=" data-tab-content active">
          <form action="go.php" method="POST">
            <div class="top">
              <span>
                <h1>User Details</h1>
              </span>
              <span id="save-ch-btn" class="save-ch-btn">
                <button>Save Changes</button>
              </span>
            </div>
            <div class="details">
              <div class="row top">
                <span class="col-left">Name</span>
                <span class="col-right active">John Mark De Ocampo</span>
                <span class="col-right-edit">
                  <input type="text" name="" id="" value="">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

              <div class="row">
                <span class="col-left">Address</span>
                <span class="col-right active">Quezon City</span>
                <span class="col-right-edit">
                  <input type="text" name="" id="" value="">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

              <div class="row">
                <span class="col-left">Email</span>
                <span class="col-right active">jdelacruz@gmail.com</span>
                <span class="col-right-edit">
                  <input type="text" name="" id="" value="">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

              <div class="row bot">
                <span class="col-left">Phone #</span>
                <span class="col-right active">0999-543-8579</span>
                <span class="col-right-edit">
                  <input type="text" name="" id="" value="">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>
            </div>

            <h1>Social Media Accounts</h1>
            <div class="details">
              <div class="row top">
                <span class="col-left">Facebook</span>
                <span class="col-right active">www.facebook.com/jdelacruz</span>
                <span class="col-right-edit">
                  <input type="text" name="" id="" value="">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>
              <div class="row">
                <span class="col-left">Twitter</span>
                <span class="col-right active">www.twitter.com/jdcr2456</span>
                <span class="col-right-edit">
                  <input type="text" name="" id="" value="">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>
              <div class="row">
                <span class="col-left">Instagram</span>
                <span class="col-right active">www.instagram.com/jdcr2456</span>
                <span class="col-right-edit">
                  <input type="text" name="" id="" value="">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>
            </div>

            <h1>Travel Preferences</h1>
            <div class="details">
              <div class="row top">
                <span class="col-left">Beaches and Resorts</span>
              </div>
              <div class="row">
                <span class="col-left">Historical and Cultural Landmarks</span>
              </div>
            </div>
            <!-- <div class="left">
              <div class="image">
                <img src="assets/img/logo.png" alt="">
                <div class="middle">
                  <div class="text"><i class="fas fa-pen"></i>Edit</div>
                </div>
              </div>
            </div> -->
          </form>
        </div>

        <div id="package" data-tab-content class="data-tab-content">
          <div class="card-container">
            <div class="wrap user">
              <div class="image">
                <img src="assets/img/Lakawon1.jpg" alt="" />
              </div>

              <div class="cap">
                <h2 class="title">Lakawon Island Day Tour</h2>
                <p>Price: P7,500 per person</p>
                <p>Booking Status: Checking Availability</p>
                <!-- <p>Persons: 2</p>
                <p>Duration: 2 day(s)</p>
                <p>Booked Date: September 5, 2022</p> -->
              </div>

              <div class="func-btn">
                <span class="cost">
                  <p class="amt">P15,000</p>
                  <p style="font-size: 12px;">TOTAL BILL</p>
                </span>
                <span class="check-order">
                  <a href="">Travel Order</a>
                </span>
              </div>
            </div>
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

  <script src="assets/js/agency-profile.js"></script>

</body>

</html>