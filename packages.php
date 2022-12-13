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
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
  <link rel="icon" href="assets/img/logo.png" />
  <title>Packages | Lakbayan Travels and Tours</title>
</head>

<body>
  <?php
  include 'includes/components/nav.php';
  include 'includes/components/accountModal.php';
  include 'backend/connect/dbCon.php';

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
    }
    $_SESSION['booking-stat'] = 'none';
  }

  ?>
  <script>
    $('#modalBClose').on("click", function() {
      $("#amodal_container").removeClass("show");
    });

    $("#amodal_container").on('click', function (e) {
      if ($("#amodal_container").has(e.target).length === 0) {
        $("#amodal_container").removeClass("show");
      }
    });    
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
      <div class="filter-container" id="filter-container">
        <h3>FILTER RESULTS</h3>
        <div class="filter filter-rating">
          <p class="header">Rating</p>
          <input type="checkbox" name="rating" id="5s" class="rating-inp" value="5">
          <label for="5s" class="rating-label">
            <div class="rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              only
            </div>
          </label>

          <input type="checkbox" name="rating" id="4s" class="rating-inp" value="4">
          <label for="4s" class="rating-label">
            <div class="rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
              & Up
            </div>
          </label>

          <input type="checkbox" name="rating" id="3s" class="rating-inp" value="3">
          <label for="3s" class="rating-label">
            <div class="rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              & Up
            </div>
          </label>

          <input type="checkbox" name="rating" id="2s" class="rating-inp" value="2">
          <label for="2s" class="rating-label">
            <div class="rating">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              & Up
            </div>
          </label>

          <!-- style="display: none;" -->
          <input type="checkbox" name="rating" id="1s" class="rating-inp" value="1">
          <label for="1s" class="rating-label">
            <div class="rating">
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              & Up
            </div>
          </label>
        </div>
        <div class="filter filter-duration">
          <p class="header">Duration</p>
          <input type="range" min="0" max="14" step="1" value="0">
          <p class="days">Day(s): 0</p>
        </div>
        <div class="filter filter-price">
          <p class="header">Price</p>
          <div class="inputs">
            <input type="number" placeholder="MIN" id="price-min">
            <p>to</p>
            <input type="number" placeholder="MAX" id="price-max">
          </div>
          <p id="range-err-msg" style="display: none; color: red; font-size: 12px; text-align: center; padding-top: 10px">Please apply a proper range value.</p>
          <button class="apply-filter" id="apply-price">APPLY</button>
        </div>

        <script>
          var rating = 0,
            duration = 0,
            price_min = 0,
            price_max = 0;
          var filter_req, filter_timeout;
          var postdata = {
            is_filtering: true,
            rating: 0,
            duration: 0
          }

          // Rating
          $(".rating-inp").change(function() {
            var checkbox = this;
            var count = 0,
              rating = 0;
            if ($(this).is(":checked"))
              this.labels[0].firstElementChild.classList.remove('active');

            $(".rating-inp").each(function() {
              if (this == checkbox & $(checkbox).is(":checked")) {
                this.labels[0].firstElementChild.classList.add('active');
                count++;
              } else {
                $(this).prop('checked', false);
                this.labels[0].firstElementChild.classList.remove('active');
              }
            })

            rating = (count == 0) ? 0 : $(this).val()

            postdata['rating'] = rating;
            filterTimeout();

          });

          // Duration
          $('input[type="range"]').on('input', function() {
            $(this).next()[0].innerHTML = "Day(s): " + $(this).val()
            duration = $(this).val()

            postdata['duration'] = duration;
            filterTimeout();



          });

          // Price
          $("#apply-price").click(function() {
            price_min = ($('#price-min').val() == undefined || $('#price-min').val() == "") ? 0 : $('#price-min').val();
            price_max = ($('#price-max').val() == undefined || $('#price-max').val() == "") ? 0 : $('#price-max').val();

            if (price_min == 0 && price_max == 0) {
              $("#range-err-msg").css('display', 'block');
              delete postdata.price_min;
              delete postdata.price_max;
            } else {
              if (price_min > price_max && price_max != 0) {
                $("#range-err-msg").css('display', 'block');
                delete postdata.price_min;
                delete postdata.price_max;
              } else {
                $("#range-err-msg").css('display', 'none');
                postdata['price_min'] = price_min;
                postdata['price_max'] = price_max;
                filterTimeout();

              }
            }
          });

          function filterTimeout() {
            if (filter_timeout) {
              clearTimeout(filter_timeout);
            }
            if (filter_req) {
              filter_req.abort();
            }

            filter_timeout = setTimeout(function() {
              filterPackages().then(function(data) {
                $('#card-container').empty();
                $('#card-container').html(data);
              });
            }, 500);
          }

          function filterPackages() {
            filter_req = $.ajax({
              url: 'backend/package/packages_search.php',
              method: 'POST',
              data: postdata,
              async: true,
              context: this,
              beforeSend: function() {
                $('#loading').css('display', 'flex');
                $('#card-container').css('display', 'none');
              },
              complete: function() {
                $('#loading').css('display', 'none');
                $('#card-container').css('display', 'flex');
              }
            });

            return filter_req;
          }
        </script>
      </div>
      <div class="right">
        <div class="searchbar" style="margin-bottom: 3rem;">
          <input type="text" name="search" id="search" autocomplete="off" placeholder="Search by Location or Travel Agency Name" class="field" style=" background: white;" />
          <div id="output"></div>
          <span class="ico"><i class="fas fa-search"></i></span>
        </div>
        <div class="card-container" id="card-container">
          <?php
          include_once "backend/package/packages_display.php";
          include_once __DIR__."/backend/package/collaborative_filtering.php";
          include_once __DIR__."/backend/package/contentbased_filtering.php";

          $result = array();
          $resultContent = array();

          if ($_SESSION['isLoggedIn'] != false){
            $result = getCollabRecommendation($_SESSION['id']);
            $resultContent = getContentBasedRecommend($_SESSION['id']);
          };

          $query_string = "SELECT PK.*, 
                                  FORMAT(PK.packagePrice, 0) AS fresult, 
                                  DATEDIFF(packageEndDate, packageStartDate) AS packagePeriod, 
                                  AI.*, 
                                  AG.agencyName ";
          if(!empty($result))   {$query_string .= ", CASE ";} //COLLAB-BASED      
          
          foreach($result as $key => $results){
              $query_string .= 'WHEN PK.packageID='.$key.' THEN 1 ';
          }            
          if(!empty($result))   {$query_string .= " END AS 'priority' ";}

          if(!empty($resultContent)) {$query_string .= ", CASE ";} //CONTENT-BASED

          foreach($resultContent as $key => $resultContents){
            $query_string .= 'WHEN PK.packageTitle= \''.$key.'\' THEN 1 ';
          }

          if(!empty($resultContent)) {$query_string .= " END AS 'preferred' ";}

          $query_string .= "FROM  package_tbl AS PK 
                            INNER JOIN  agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                            INNER JOIN  packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom
                            WHERE (packageImg_Name LIKE 'PCK-F%' OR packageImg_Name IS NULL) AND PK.is_deleted = 0 AND PK.packageStatus = 0
                            GROUP BY AI.packageIDFrom ";
          
          // IF THERES COLLABORATIVE BASED FILTERING
          if(!empty($result))   {$query_string .= "ORDER BY priority DESC";}
          // IF THERE CONTENT BASED
          if(!empty($resultContent) && empty($result)) {$query_string .= "ORDER BY preferred DESC";} //WITHOUT COLLAB
          if(!empty($resultContent))   {$query_string .= ", preferred DESC";}

          

          fetch_packages($query_string, $conn, false);

          ?>

        </div>
        <div class="loading" id="loading" style="display: none; justify-content: center; margin: auto;">
          <img src="assets/img/loading.gif" alt="">
        </div>
        <script>
          var searchTimeout;
          var searchReq;

          $("#search").on('keyup', function () {
            
            var query = $(this).val();
            
            if (searchTimeout) {
              clearTimeout(searchTimeout);
            }
            if (searchReq) {
              searchReq.abort();
            }

            searchTimeout = setTimeout(function () {
              if (query.length >= 2) {
                $("#card-container").empty();
                searchPackages(query).then(function(data) {
                $('#card-container').empty();
                $('#card-container').html(data);
              });
              }
            }, 500);

          });

          function searchPackages(query) {
            searchReq = $.ajax({
              url: 'backend/package/packages_search.php',
              method: 'POST',
              data: {
                query: query
              },
              async: true,
              context: this,
              beforeSend: function() {
                $('#loading').css('display', 'flex');
                $('#card-container').css('display', 'none');
              },
              success: function() {
                $('#loading').css('display', 'none');
                $('#card-container').css('display', 'flex');
              }
            });

            return searchReq;
          }

          // var wrappers = document.querySelectorAll('.wrapper');
          // wrappers.forEach(wrapper => {
          //   $(wrapper).on('click', function() {
          //     let selectedPackID = $(this).children()[0].value;
          //     window.location.href = "includes/packages/details.php?packageid=" + selectedPackID;
          //   });
          // });
          
        </script>
        <script src="https://kit.fontawesome.com/7846b9013f.js" crossorigin="anonymous"></script>

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

  <script>
    $(function() {
      $(document).scroll(function() {
        var $nav = $("._nav");

        $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
      });
    });
    $(document).on('click', function(event) {
      var checkbox = document.getElementById('filter-en');
      var menu = document.getElementById('mobile-filter-container');

      if (!$(event.target).closest('#mobile-filter-container').length &
        $('#mobile-filter-container').css('left') == '0px') {
        checkbox.checked ^= 1;
      }


    });
  </script>

  <script>
    var elem = document.querySelector('input[type="range"]');

    var rangeValue = function() {
      var newValue = elem.value;
      var target = document.querySelector('.days');
      target.innerHTML = "Day(s): " + newValue;
    }

    elem.addEventListener("input", rangeValue);
  </script>
</body>

</html>