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
  <link rel="stylesheet" href="../../assets/css/pack-spec.css" />
  <link rel="stylesheet" href="../../assets/css/slider.css" />
  <link rel="stylesheet" href="../../assets/css/style.css" />
  <link rel="stylesheet" href="../../assets/css/modal.css" />
  <link rel="stylesheet" href="../../assets/css/modal.css" />
  <link rel="stylesheet" href="../../assets/css/profile.css" />
  <link rel="stylesheet" href="../../assets/css/footer.css" />

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- flatpickr -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
  <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">


  <link rel="icon" href="../../assets/img/logo.png" />
  <title>Packages | Lakbayan Travels and Tours</title>
</head>

<body>
  <?php 
  include '../components/nav.php';
  include '../components/accountModal.php';
  include '../../backend/connect/dbCon.php';
  include '../../backend/package/packages_display.php';

  $packageID = $_GET['packageid'];
  // $query_string = "SELECT PK.*, FORMAT(PK.packagePrice, 0) AS fresult, 
  //                 DATEDIFF(packageEndDate, packageStartDate) AS packagePeriod, 
  //                 -- DATEDIFF(packageStartDate, packageCutoff) AS packageCutdiffdate,
  //                 -- TIMEDIFF(packageStartDate, packageCutoff) AS packageCutdifftime,
  //                 AI.*, AG.agencyName 
  //                 FROM traveldb.package_tbl AS PK 
  //                 INNER JOIN traveldb.agency_tbl AS AG ON AG.agencyID = PK.packageCreator
  //                 INNER JOIN traveldb.packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom
  //                 WHERE packageID = " . $packageID;

  // $qry_packages = mysqli_query($conn, $query_string);
  // $row = mysqli_fetch_array($qry_packages);

  $package_qry = "SELECT PK.*, AG.agencyName, AG.agencyTelNumber, AG.agencyEmail FROM traveldb.package_tbl AS PK INNER JOIN traveldb.agency_tbl AS AG ON AG.agencyID = PK.packageCreator WHERE PK.packageID = $packageID";
  $categ_qry = "SELECT * FROM traveldb.packagecateg_tbl where packageID_from = $packageID";
  $loc_qry =  "SELECT * FROM traveldb.packagedest_tbl INNER JOIN areas_tbl AS AT ON AT.cityID = packageAreasID WHERE packageDestID = $packageID";
  $img_qry = "SELECT * FROM traveldb.packageimg_tbl WHERE packageIDFrom = $packageID";
  $inc_qry = "SELECT * FROM traveldb.packageincl_tbl WHERE packageID_from = $packageID";

  $jsondata = fetch_package_by_id($package_qry, $categ_qry, $loc_qry, $img_qry, $inc_qry, $conn);
  $jsondata = json_decode($jsondata, true);
  $row = $jsondata['details'];
  
  $img = $jsondata['images'];
  $imgCount = count($img)-1;

  $incl = $jsondata['inclusions'];
  $inclCount = count($incl);

  $loc = $jsondata['location'];
  $locCount = count($loc);

  $categ = $jsondata['category'];
  $catCount = count($categ);

  ?>

  <section class="packages-pages">
    <div class="header">
      <a href="../../packages.php">
        <span>
          <i class="fas fa-angle-left"></i>
        </span>
        <span>
          <p style="font-size: 13px;">Back to Packages</p>
        </span>
      </a>
    </div>

    <div class="content">
      <div class="right">
        <div class="slider" style="margin-bottom: 10px;">
          <div class="slides">
            <?php 
              for ($i=1; $i <= $imgCount ; $i++) { 
                echo "<input type='radio' name='nav-btn' id='btn$i' />";
              }
            
              for ($i=1; $i <= $imgCount ; $i++) { 
                $i==1 ? $class = "slide first": $class = "slide";
                echo <<<END
                  <div class="$class">
                    <img src="../../assets/img/users/travelagent/{$row['packageCreator']}/package/{$row['packageID']}/img/$img[$i]" alt="" />
                  </div>
                END;
              }
            ?>

            <div class="nav-auto">
              <?php 
                for ($i=1; $i <= $imgCount ; $i++) { 
                  echo "<div class='auto-btn$i'></div>";
                }
              ?>
            </div>
          </div>
          <div class="nav-manual">
            <label for="" class="nav-btn prev-btn" id="prev-btn"><i id="prev-btn" class="fas fa-chevron-left"></i></label>
            <?php 
              for ($i=1; $i <= $imgCount ; $i++) { 
                echo "<label for='btn$i' class='manual-btn'></label>";
              }
            ?>
            <label for="" class="nav-btn next-btn"><i id="next-btn" class="fas fa-chevron-right"></i></label>
          </div>

          <script>
            var count = 1;
            document.getElementById('btn' + count).checked = true;

            document.getElementById("next-btn").onclick = function () { nextFunction(<?php echo $imgCount?>) };
            document.getElementById("prev-btn").onclick = function () { prevFunction(<?php echo $imgCount?>) };
          </script>
        </div>
        <div class="reservation">
          <!-- <div class="hearts">
            <div class="likecounter" style="display: flex; text-align: center;">
              <span style="margin-right: 10px; width: 25px;"><img src="https://img.icons8.com/material/24/F15B6C/hearts--v1.png"/></span>
              <p>people like this.</p>
            </div>
          </div> -->

          <div class="contact">
            <div style="display: flex; justify-content: space-between;">
              <span>
                <h1><?php echo $row['packageTitle'] ?></h1>
                <p style="font-size: 13px;">by <a href="../../agency-profile.php?mode=view&id=<?php echo $row['packageCreator']?>" style="text-decoration: underline;"><?php echo $row['agencyName'] ?></a></p>
              </span>
              <span style="margin-top: 5px;">
                <img src="https://img.icons8.com/material-outlined/24/null/hearts.png"/>
              </span>
            </div>

            <div style="display: flex; margin: 5px 0;">
              <div class="rating" style="color: var(--logo-yellow-dark);">
                <?php
                  $stars = 5;
                  for ($i = 0; $i < $row['packageRating']; $i++) {
                    echo '<i class="fas fa-star" style="padding-right: 3px;"></i>';
                    $stars--;
                  }
                  for ($i=0; $i < $stars; $i++) { 
                    echo '<i class="far fa-star" style="padding-right: 3px;"></i>';
                  }
                ?>
              </div>
              <p style="padding: 0 10px 0 7px;">•</p>
              <div style="display: flex; align-items: center;">
                <p><?php echo $row['packageHearts']?> people </p><img src="https://img.icons8.com/material/20/F15B6C/hearts--v1.png" style="padding: 0 5px;"/> <p>this.</p> 
                <?php //echo $row['packageRating']?>
              </div>
            </div>
            <div class="info" style="margin: 5px 0;">
              <span><i class="fas fa-phone-alt"></i></span>
              <p><?php echo $row['agencyTelNumber']?></p>
            </div>
            <div class="info" style="margin: 5px 0;">
              <span><i class="fas fa-envelope"></i></span>
              <p><?php echo $row['agencyEmail']?></p>
            </div>
            

          </div>

          <div class="booking">
            <span>
              <?php 
                $priceChild = (int) $row['packagePriceChild'];
                $priceSenior = (int) $row['packagePriceSenior'];
                if ( $priceChild == 0 and $priceSenior == 0) {
              ?>
              
                <h2>₱<?php echo $row['packagePrice'] ?></h2>
                <p style="font-size: 11px;">Per Person</p>
          
              <?php 
                } else {
              ?>
              
                Starts at  
                <h2>₱<?php echo $priceChild ?></h2>
                <p style="font-size: 11px;">Per Person</p>
              
              <?php 
                }
              ?>
            </span>
            

            <a id="modalBOpen" class="book-btn">Check Availability</a>
            <div class="justify">
              <p class="sml-txt">
                <span>Reserve now & pay later:</span>
                <span>Save your spot free of</span>
                <span>charge with flexible booking.</span>
              </p>
            </div>
          </div>
          <?php
            if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn']) {
              echo '<form action="../../backend/booking/booktrip.php" method="POST">';
            } else {
              echo '<form action="../../index.php#login">';
              $_SESSION['toSignIn'] = false;
            }
          ?>
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
            ?>
              <div class="booking-modal" style="width: 1000px;">
                <h1>Booking Information</h1>
                <p>Enter the following details and the Travel Agency will be notified of the booking information sent.</p>
                <div class="main" style="display: flex; margin-bottom: 1rem;">
                  <div class="calendar" id="calendar" style="pointer-events: none; margin-right: 15px;">
                    <div class="date-display" id="date-display" style="pointer-events: none;"></div>
                  </div>
                  <div class="classification" style="display: flex; flex-wrap: wrap; justify-content: center;">
                    <div class="form-group" style="width: 90%; margin-bottom: 1rem; border-bottom: 1px solid black;">
                      <?php 
                        $startdate = date_create($row['packageStartDate']);
                        $startdate = date_format($startdate,"D, M j, Y h:i A");
                        $enddate = date_create($row['packageEndDate']);
                        $enddate = date_format($enddate,"D, M j, Y h:i A");
                        
                        echo "<span style='font-weight: bold; font-size: 15px;'>Tour Schedule: $startdate to $enddate</span>";
                      ?>
                      <span id="partynum">Number of Selected Participants: 0/<?php echo $row['packagePersonMax']?></span>                  
                    </div>
                    <div class="form-group">
                      <span class="form-label">Number of Infants</span>
                      <h6>Ages 0 - 5</h6>
                      <select class="form-control">
                      </select>
                    </div>

                    <div class="form-group">
                      <span class="form-label">Number of Children</span>
                      <h6>Ages 6 - 17</h6>
                      <select class="form-control">
                      </select>
                    </div>

                    <div class="form-group">
                      <span class="form-label">Number of Adults</span>
                      <h6>Ages 18 - 60</h6>
                      <select class="form-control">
                      </select>
                    </div>

                    <div class="form-group">
                      <span class="form-label">Number of Senior</span>
                      <h6>Ages 61 +</h6>
                      <select class="form-control">
                      </select>
                    </div>
                  </div>
                </div>
                <div class="buttons">
                  <button id="modalLogin" class="modal-login" >Book Now</button>
                  <a id="modalBClose" class="btn">Close</a>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
          <?php echo "</form>"; ?>
          <script src="../../assets/js/search-filters.js"></script>
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

            var displayCal = $('#date-display').flatpickr({
                monthSelectorType: "static",
                yearSelectorType: "static",
                dateFormat: "D, M d Y h:i K",
                mode: "range",
                inline: true
            });

            $('#calendar').css('pointer-events', 'unset');
            displayCal.setDate([new Date('<?php echo $row['packageStartDate']?>'), new Date('<?php echo $row['packageEndDate']?>')]);
            $('#calendar').css('pointer-events', 'none');

            function setOptions(max) {
              $('.form-control').each(function() {
                for (let index = 0; index <= max; index++) {
                  var $select = $("<option>", {
                          "value": index,
                          "text": index
                        }, );
                  $(this).append($select);
                }                
              });
            }

            function getTotal() {
              var currentVal = 0;
              $('.form-control').each(function() {
                var val = $(this).val();
                if (val != null) {
                  currentVal += parseInt(val);
                }
              });
              return currentVal;
            }

            var minselection = <?php echo $row['packagePersonMin']?>;
            var maxselection = <?php echo $row['packagePersonMax']?>;
            setOptions(maxselection);

            $('.form-control').on('change', function() {
              var selection = this;
              var total = getTotal();

              if (total > maxselection) {
                alert('The selected number of participants must not exceed ' + maxselection + ".");
                $(selection).val(0);
                total = total - (total - maxselection);
              }
              $('#partynum').text('Number of Selected Participants: ' + total + '/' + maxselection);
              // else if (total == 10) {
              //   $('.form-control').each(function() {
              //     if ($(this)[0] != $(selection)[0]) {
              //       $(this).prop('disabled', 'disabled');
              //     }
                  
              //   });
              // } else {
              //   $('.form-control').each(function() {
              //     $(this).prop('disabled', false);
              //   });
              // }
            });
          </script>
        </div>
      </div>

      <div class="left">
        <div style="padding-bottom: 15px;">
          <h2>About</h2>
          <p style="text-align: justify;"><?php echo $row['packageDescription'] ?></p>
          </div>
        <div style="padding: 15px 0; border-top: 1px solid white;">
          <h2>Inclusions</h2>
          <?php 
            for ($i=0; $i < $inclCount; $i++) { 
              echo "<div class='info' style='margin: 5px 0;'>
              <span><i class='fas fa-check'></i></span>
              <p>$incl[$i]</p>
              </div>";
            }
          ?>
        </div>
        <div style="padding: 15px 0; border-top: 1px solid white;">
          <h2>Locations</h2>
          <?php 
            for ($i=0; $i < $locCount; $i++) { 
              echo "<div class='info' style='margin: 5px 0;'>
              <span><i class='fas fa-map-marker-alt'></i></span>
              <p>$loc[$i]</p>
              </div>";
            }
          ?>
        </div>
        <div style="padding: 15px 0; border-top: 1px solid white;">
          <h2>Categories</h2>
          <?php 
            for ($i=0; $i < $catCount; $i++) { 
              echo "<div class='info' style='margin: 5px 0;'>
              <span><i class='fas fa-compass'></i></span>
              <p>$categ[$i]</p>
              </div>";
            }
          ?>
        </div>
      </div>
    </div>

    <div class="snapshot">
      <h1>Package Snapshot</h1>
      <div class="box-container">
        <div class="box">
          <!-- <i class="far fa-money-bill-alt"></i> -->
          <img src="../../assets/img/icons8-income-48.png" alt="" />
          <h3>Price</h3>
          <?php 
            $priceChild = (int) $row['packagePriceChild'];
            $priceSenior = (int) $row['packagePriceSenior'];
            if ( $priceChild == 0 and $priceSenior == 0) {
            ?>
            <p>
              ₱<?php echo $row['packagePrice'] ?> <br>
              Per Person
            </p>
            <?php 
            } else {
            ?>
            <p>
              Starts at
              ₱<?php echo $priceChild ?> <br>
              Per Person
            </p>
            <?php 
            }
            ?>
        </div>
        <div class="box">
          <!-- <i class="far fa-clock"></i> -->
          <img src="../../assets/img/icons8-process-64.png" alt="" width="48px" />
          <h3>Duration</h3>
          <p>
            <?php 
              $starting_date = new DateTime($row['packageStartDate']);
              $ending_date = new DateTime($row['packageEndDate']);
              $difference = $starting_date->diff($ending_date);
              if ($difference->days != 0) {
                echo $difference->days . ' day(s)';
              } else {
                echo $difference->h . ' hour(s)';
              }
            ?> 
          </p>
        </div>
        <div class="box">
          <!-- <i class="fas fa-bed"></i> -->
          <img src="../../assets/img/crowd.png" style="width: 48px;" alt="" />
          
          <h3>Participants</h3>
          <p>
            Up to <?php echo $row['packagePersonMax'];?> people in this trip
          </p>
        </div>
        <div class="box">
          <!-- <i class="fas fa-plane-slash"></i> -->
          <img src="../../assets/img/icons8-map-64.png" alt="" width="48px" />
          <h3>Cancellation</h3>
          <p>
            Free cancellation <br />
            <?php 
              $starting_date = new DateTime($row['packageStartDate']);
              $cutoff_date = new DateTime($row['packageCutoff']);
              $difference = $cutoff_date->diff($starting_date);
              if ($difference->days != 0) {
                echo $difference->days . ' day(s)';
              } else {
                echo $difference->h . ' hour(s)';
              }
            ?> 
            before Tour Start Date
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
              <p class="dest">Lakawon Island</p>
              <p class="location">Cadiz</p>
            </a></span>
        </div>
        <div class="card">
          <img src="../../assets/img/kawasan 2.jpg" alt="" />
          <span><a href="tri.php">
              <p class="dest">Tri-city Bacolod Day Tour</p>
              <p class="location">Talisay City</p>
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

  <script>
    var $nav = $("._nav");
    $nav.toggleClass("scrolled");
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