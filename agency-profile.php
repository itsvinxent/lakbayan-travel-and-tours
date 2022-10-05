<?php
session_start();
$_SESSION['active'] = 'profile';
if (isset($_SESSION['isLoggedIn']) == false) {
  $_SESSION['isLoggedIn'] = false;
} else if ($_SESSION['utype'] != 'manager'){
  echo '<meta http-equiv="refresh" content="0;URL=../../user-profile.php" />';
}

$whereamI = 3;
$isAgency = true;
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css">
  <link rel="stylesheet" href="assets/css/chatbox.css">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="assets/img/logo.png" />
  <title>Profile | Lakbayan Travels and Tours</title>
</head>

<body>
<?php
  include 'includes/components/nav.php';
  include 'backend/auth/getagency.php';

 
  $disEmail = $_SESSION['setEmail'];
  $disDesc = $_SESSION['setDesc'];
  $disAdd = $_SESSION['setAdd'];
  $disTelNum = $_SESSION['setTelNumber'];
  $disMName = $_SESSION['setMName'];
  $disMContact = $_SESSION['setMContact'];
  ?>

  <section class="sections packages" id="packages">

    <div class="banner-half">
      <video src="assets/media/waves.mp4" muted loop autoplay preload="auto"></video>
    </div>

    <div class="profile-container">
      <div class="banner-logo">

        <form>
          <div class="image">
            <img src="assets/img/logo.png" alt="">
            <div class="middle">
              <div class="text"><i class="fas fa-pen"><input class="middle" type="file" name="aPicture" id="aPicture" accept="image/gif, image/jpeg, image/png" style="opacity: 0;"></i>Edit</div>
            </div>
          </div>
        </form>

        <div class="top">
          <span>  

          <?php

            echo '<h1 class="agency-name">'.$_SESSION['setName'].'</h1>
                  <p class="agency-email">'.$disEmail.'</p>';
          ?>

          </span>
          <span class="ico-container">
            <div class="ico">
              <a href="www.facebook.com" rel="noopener" target="_blank"><i class="fab fa-facebook-f"></i></a>
              <a href="wwww.twitter.com" rel="noopener" target="_blank"><i class="fab fa-twitter"></i></a>
              <a href="www.instagram.com" rel="noopener" target="_blank"><i class="fab fa-instagram"></i></a>
              <a href="www.lakbayan.com" rel="noopener" target="_blank"><i class="fas fa-globe"></i></a>
            </div>
          </span>
        </div>

        <?php

        
        echo 
        '<div class="desc">
          <p class="desc-body active" id="desc-body">'.$disDesc.'</p>
          <textarea class="desc-textarea" name="" id="desc-textarea"></textarea>
          <div class="desc-btn">
            <div class="edit-desc active" id="edit-desc-btn"><i class="fas fa-pen"></i></div>
            <div class="save-desc" id="save-desc-btn"><i class="fas fa-save"></i></div>
          </div>
        </div>'
        ?>
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
          <form action="backend\auth\updateprof.php" method="POST">
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

                <?php 
                echo '<span class="col-right active" id="">'.$_SESSION['setName'].'</span>';
                ?>

                <span class="col-right-edit">
                  <input type="text" name="profName" id="" value="">
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

                <?php
                echo '<span class="col-right active" name="profAdd">'.$disAdd.'</span>';
                ?>

                <span class="col-right-edit">
                  <input type="text" name="profAdd" id="" value="">
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

                <?php
                echo '<span class="col-right active">'.$disEmail.'</span>';
                ?>

                <span class="col-right-edit">
                  <input type="text" name="profEmail" id="" value="">
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

                <?php
                echo '<span class="col-right active">'.$disTelNum.'</span>'
                ?>
                <span class="col-right-edit">
                  <input type="text" name="profTel" id="" value="">
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

                <?php 
                echo '<span class="col-right active">'.$disMName.'</span>';
                ?>

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
                <?php

                echo '<span class="col-right active">'.$disMContact.'</span>';

                ?>
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

                <?php
                echo '<span class="col-right active">'.$disEmail.'</span>';
                ?>
                
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
        <button class="create-button" id="modalBOpen">Create a New Package</button>

          <?php 
            while($row = mysqli_fetch_array($qry_packages))
            {
            ?>

            <div class="card-container">
              <div class="wrap">
                <div class="image">
                  
                 <?php
                 echo '<img src="data:image/jpg;base64,'.base64_encode($row['packageImg_Name']).'" alt=""/>';
                 ?>
                </div>

                <div class="cap">
                  <h2><?php echo $row['packageTitle']?></h2>
                  <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                  </div>
                  <div class="data">
                    <?php echo $row['packageDescription']?>
                  </div>
                </div>

                <div class="func-btn">
                  <span class="func-edit">
                    <div class="buttn"><i class="fas fa-pen"></i></div>
                  </span>
                  <span class="func-delete">
                    <div class="buttn"><i class="fas fa-trash"></i></div>
                  </span>

                  <span class="earnings">
                    <p class="amt"><?php echo $row['fresult']?></p>
                    <p style="font-size: 12px;">PER PERSON</p>
                  </span>
                </div>
              </div>
            </div>
              
            <?php 
            }
            ?>

          <!-- <div class="card-container">
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

              <div class="func-btn">
                <span class="func-edit">
                  <div class="buttn"><i class="fas fa-pen"></i></div>
                </span>
                <span class="func-delete">
                  <div class="buttn"><i class="fas fa-trash"></i></div>
                </span>

                <span class="earnings">
                  <p class="amt">P7,500</p>
                  <p style="font-size: 12px;">PER PERSON</p>
                </span>
              </div>
            </div>
          </div>

          <div class="card-container">
            <div class="wrap">
              <div class="image">
                <img src="assets/img/tri 1.jpg" alt="" />
              </div>

              <div class="cap">
                <h2>Tri-City (Bacolod - Silay - Talisay) Exclusive Day Tour</h2>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                </div>
                <div class="data">
                  Get to know more about the rich history and cultural heritage of Negros. This trip focuses on the Spanish heritage and the history of the sugarcane industry and haciendas of Negros. You will visit heritage houses, museums and century old churches guided by our DOT accredited tour guides.
                </div>
              </div>

              <div class="func-btn">
                <span class="func-edit">
                  <div class="buttn"><i class="fas fa-pen"></i></div>
                </span>
                <span class="func-delete">
                  <div class="buttn"><i class="fas fa-trash"></i></div>
                </span>

                <span class="earnings">
                  <p class="amt">P3,161</p>
                  <p style="font-size: 12px;">PER PERSON</p>
                </span>
              </div>
            </div>
          </div>

          <div class="card-container">
            <div class="wrap">
              <div class="image">
                <img src="assets/img/Ruinsmain.jpeg" alt="" />
              </div>

              <div class="cap">
                <h2>The Ruins Day Tour</h2>
                <div class="rating">
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i cl ass="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="data">
                  The Ruins of Talisay City has become famous for its naturally ruined beauty. The Ruins was built to memorialize the great love of a husband to his departed wife. Currently, the family of the grandson of Mercedes, Mr. Raymund Javellana, owns and maintains The Ruins.
                </div>
              </div>
              <div class="func-btn">
                <span class="func-edit">
                  <div class="buttn"><i class="fas fa-pen"></i></div>
                </span>
                <span class="func-delete">
                  <div class="buttn"><i class="fas fa-trash"></i></div>
                </span>

                <span class="earnings">
                  <p class="amt">P2,100</p>
                  <p style="font-size: 12px;">PER PERSON</p>
                </span>
              </div>
            </div>
          </div> -->

        </div>
        <div class="bmodal-container" id="bmodal_container">
          <div class="booking-modal">
            <h1>Package Creation</h1>
            <p>Enter the details of the package to be listed here in the website.</p>
            <input type="hidden" name="loc" value="campuestohan" />
            <input placeholder="Package Name" required />
            <input placeholder="Price per Person" required />
            <input placeholder="Phone Number" required />
            <input placeholder="Reservations" required />
            <input type="number" min="1" max="10" name="persons" placeholder="Cancellation Limit (Hours)" required>
            <input type="number" min="1" max="4" name="duration" placeholder="Duration" required>
            <textarea name="msg" id="msg" rows="10" placeholder="Description and Inclusions (500 words max)"></textarea>

            <div class="buttons">
              <button id="modalLogin" class="modal-login">Add Package</button>
              <a id="modalBClose" class="btn">Close</a>
            </div>
          </div>
        </div>
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
        <div id="history" data-tab-content class="data-tab-content">
          <table class="user-table">
            <thead>
              <tr>
              <th>Booking Date</th>
                <th>Name</th>
                <th>Travel Package</th>
                <th># of Persons</th>
                <th># of Days</th>
                <th>Trip Date</th>
                <th>Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>08/23/22</td>
                <td>John Mark De Ocampo</td>
                <td>Campuestohan Highland Resort</td>
                <td>5</td>
                <td>3</td>
                <td>9/11/22</td>
                <td>P10,500</td>
                <td>
                  <a href="travel-order.php">Travel Order</a>
                </td>
              </tr>
              <tr>
                <td>08/23/22</td>
                <td>Han Solo</td>
                <td>Lakawon Island Day Tour</td>
                <td>2</td>
                <td>2</td>
                <td>9/05/22</td>
                <td>P15,000</td>
                <td>
                  <a href="travel-order.php">Travel Order</a>
                </td>
              </tr>
              <tr>
                <td>08/23/22</td>
                <td>Ben Kenobi</td>
                <td>Lakawon Island Day Tour</td>
                <td>5</td>
                <td>2</td>
                <td>9/18/22</td>
                <td>P30,000</td>
                <td>
                  <a href="travel-order.php">Travel Order</a>
                </td>
              </tr>
              <tr>
                <td>08/23/22</td>
                <td>Paolo Benjamin Guico</td>
                <td>Tri-City (Bacolod - Silay - Talisay) Exclusive Day Tour</td>
                <td>9</td>
                <td>3</td>
                <td>9/25/22</td>
                <td>P35,000</td>
                <td>
                  <a href="travel-order.php">Travel Order</a>
                </td>
              </tr>
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