<?php
session_start();
$_SESSION['active'] = 'pack';
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
  ?>

  <section class="sections packages" id="packages">

    <div class="banner-half">
      <video src="assets/media/waves.mp4" muted loop autoplay preload="auto"></video>
    </div>

    <div class="profile-container">
      <div class="banner-logo">
        <div class="image">
          <img src="assets/img/logo.png" alt="">
          <div class="middle">
            <div class="text"><i class="fas fa-pen"></i>Edit</div>
          </div>
        </div>
        <div class="top">
          <span>
            <h1 class="agency-name">Lakbayan Travel and Tours</h1>
            <p class="agency-email">lakbayantravels@gmail.com</p>
          </span>
          <span class="ico-container">
            <div class="ico">
              <a href="facebook.com"><i class="fab fa-facebook-f"></i></a>
              <a href="twitter.com"><i class="fab fa-twitter"></i></a>
              <a href="instagram.com"><i class="fab fa-instagram"></i></a>
              <a href="lakbayan.com"><i class="fas fa-globe"></i></a>
            </div>
          </span>
        </div>

        <div class="desc">
          <p class="desc-body active" id="desc-body">Lakbayan Travel and Tours will provide a convenient and premium travel and tour service for local destination in the Philippines, specifically in the Negros Occidental province. Lakbayan Travel and Tours offers tourists the destinations that they would love and relax in. We also provide essential information to clients so that they are familiar with the culture of their chosen places. "Lakbayan" or Lakbay Bayan travel & tours is a website that allows visitors to conveniently browse tourist spots.</p>
          <textarea class="desc-textarea" name="" id="desc-textarea"></textarea>
          <div class="desc-btn">
            <div class="edit-desc active" id="edit-desc-btn"><i class="fas fa-pen"></i></div>
            <div class="save-desc" id="save-desc-btn"><i class="fas fa-save"></i></div>
          </div>
        </div>
      </div>

      <div class="nav">
        <ul class="tabs">
          <li data-tab-target="#info" class="tab active">Company Information</li>
          <li data-tab-target="#package" class="tab">Travel Packages</li>
          <li data-tab-target="#history" class="tab">Transaction History</li>
        </ul>
      </div>

      <div class="tab-content">
        <div id="info" data-tab-content class=" data-tab-content active">
          <form action="go.php" method="POST">
            <div class="top">
              <span>
                <h1>Agency Details</h1>
              </span>
              <span id="save-ch-btn" class="save-ch-btn">
                <button>Save Changes</button>
              </span>
            </div>
            <div class="details">
              <div class="row top">
                <span class="col-left">Name</span>
                <span class="col-right active">Lakbayan Travel and Tours</span>
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
                <span class="col-right active">Amara Compound, Brgy. Mayamot, Antipolo City</span>
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
                <span class="col-right active">lakbayantravels@gmail.com</span>
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
                <span class="col-left">Telephone #</span>
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
                <span class="col-right active">www.facebook.com/lakbayantravelandtours</span>
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
                <span class="col-right active">www.twitter.com/lakbayantravelandtours</span>
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
                <span class="col-right active">www.instagram.com/lakbayantravelandtours</span>
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
                <span class="col-left">Youtube</span>
                <span class="col-right active">None</span>
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

            <h1>Manager Information</h1>
            <div class="details">
              <div class="row top">
                <span class="col-left">Name</span>
                <span class="col-right active">Juan Dela Cruz</span>
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
                <span class="col-left">Contact #</span>
                <span class="col-right active">0961-432-9680</span>
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
                <span class="col-left">Email</span>
                <span class="col-right active">jdc_lakbayan@gmail.com</span>
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
            <div class="wrap">
              <div class="image">
                <img src="assets/img/Lakawon1.jpg" alt="" />
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
              <div class="functions">

              </div>
              <!-- <div class="price">
                <p>FROM</p>
                <p class="pr">P7,500.00</p>
                <a class="book-btn" href="includes/packages/lakawon.php">BOOK NOW</a>
              </div> -->
            </div>
          </div>
        </div>

        <div id="history" data-tab-content class="data-tab-content">
          <table>
            <thead>
              <tr>
                <th>Booking Date</th>
                <th>Name</th>
                <th>Travel Package</th>
                <th>Number of Persons</th>
                <th>Trip Date</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
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