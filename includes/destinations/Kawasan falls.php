<?php 
  session_start(); 
  $_SESSION['active'] = 's-dest';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../assets/css/dest-spec.css" />
    <link rel="stylesheet" href="../../assets/css/slider.css" />
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <link rel="stylesheet" href="../../assets/css/modal.css" />
    <link rel="stylesheet" href="../../assets/css/footer.css" />
    
    <!-- Font Awesome CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
      integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="icon" href="../../assets/img/logo.png" />
    <title>Destinations | Lakbayan Travels and Tours</title>
  </head>
  <body>
    <?php 
      include '../components/nav.php';
      include '../components/accountModal.php';
    ?>
    <section class="destination-pages">
      <div class="banner-half">
        <video
          src="../../assets/media/sea.mp4"
          muted
          loop
          autoplay
          preload="auto"
        ></video>
        <div class="text">
          <h1>Destinations</h1>
          <h2>
            Here are some of the featured destinations included in the packages.
          </h2>
        </div>
      </div>

      <div class="header">
        <a href="../../destinations.php">
          <span>
              <i class="fas fa-angle-left"></i>
          </span>
          <span>
            <p>Back to Destinations</p>
          </span>
        </a>
      </div>
        <h1 class="loc">Kawasan Falls</h1>
      
      
      <div class="content">
        <div class="right">
            <!-- image slider -->
            <div class="slider">
                <div class="slides">
                    <input type="radio" name="nav-btn" id="btn1">
                    <input type="radio" name="nav-btn" id="btn2">
                    <input type="radio" name="nav-btn" id="btn3">

                     
                    <div class="slide first">
                        <img src="../../assets/img/Kawasan1.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="../../assets/img/Kawasan2.jpg" alt="">
                    </div>
                    <div class="slide">
                        <img src="../../assets/img/Kawasan3.jpg" alt="">
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
            
            <div class="paragraph">
              <p>Barangay Matutinao in Badian, Cebu, is home to the multi-tiered waterfall system known as the Kawasan Falls. In Badian, it is without a doubt the most popular tourist attraction.

                At the foot of the Mantalongon Mountain Range, Kawasan Falls is renowned for its beautiful turquoise water. It is located just one kilometer from the national road of Badian and at least four hours from Osmea Peak of Dalaguete. Before reaching the Matutinao River and the Taon Strait, the water from Kandayvic Spring cascades through several layers of waterfalls before cooling to an icy temperature.
                
                Swimming in one of the deep natural pools is a popular pastime at the waterfalls. The first cascade is about 40 meters high, while the second is about 20 meters high and can be reached in about ten minutes of trekking.
              </p>
            </div>
            
            
        </div>
        <div class="left">
          <h3>Hot Tourist Destinations</h3>
          <div class="card">
            <img src="../../assets/img/bantayan2.jpg" alt="">
            <span><a href="Bantayan Island.php"><p class="dest">Bantayan Island</p><p class="location">Northernmost Cebu</p></a></span>  
          </div>
          <div class="card">
            <img src="../../assets/img/Magellan1.jpg" alt="">
            <span><a href="Magellan's cross.php"><p class="dest">Magellan's Cross</p><p class="location">Cebu City</p></a></span>  
          </div>
          <div class="card">
            <img src="../../assets/img/Museo2.jpg" alt="">
            <span><a href="Museo sugbo.php"><p class="dest">Museo Sugbo</p><p class="location">Cebu City</p></a></span>  
          </div>
          <div class="card">
            <img src="../../assets/img/Nacpan2.jpg" alt="">
            <span><a href="Nacpan Beach.php"><p class="dest">Nacpan Beach</p><p class="location">El Nido</p></a></span>  
          </div>
          <div class="card">
            <img src="../../assets/img/Barracuda2.jpg" alt="">
            <span><a href="Barracuda Lake.php"><p class="dest">Barracuda Lake</p><p class="location">Coron</p></a></span>  
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
            <li><a href="../../index.php">Home</a></li>
            <li><a href="../../destinations.php">Destinations</a></li>
            <li><a href="../../packages.php">Packages</a></li>
            <li><a href="../../about.php">About</a></li>
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
      $(function () {
        $(document).scroll(function () {
          var $nav = $("._nav");

          $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
        });
      });
    </script>
    <script src="../../assets/js/slider.js"></script>
  </body>
</html>
