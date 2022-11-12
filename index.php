<?php
session_start();
$_SESSION['active'] = 'index';
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
  <link rel="stylesheet" href="assets/css/scroll-snap.css">
  <link rel="stylesheet" href="assets/css/modal.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/login.css">


  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="assets/img/logo.png">

  <title>Lakbayan</title>
</head>

<body>
  <?php
  include 'includes/components/nav.php';
  include 'includes/components/accountModal.php';
  ?>
  <section class="main-page vidban">
    <div id="bann" class="banner">
      <video src="assets/media/waves.mp4" muted loop autoplay preload="auto"></video>
      <div id="goto" class="text">
        <h1>Explore without limits</h1>
        <h2>Your travel starts here, with us.</h2>
        <a <?php
            if (!$_SESSION['isLoggedIn']) {
              echo "class=\"logn\"";
            } else {
              echo "href=\"packages.php\"";
            }
            ?>>Learn More</a>
      </div>
    </div>
  </section>
  <section id="login" class="main-page login">
    <div class="login-banner">
      <video src="assets/media/Foggy.mp4" muted loop autoplay preload="auto"></video>

      <div <?php
            if (isset($_SESSION['toSignIn'])) {
              if ($_SESSION['toSignIn'] == true) {
                echo 'class="container"';
              } else {
                echo 'class="container right-panel-active"';
              }
            } else {
              echo 'class="container"';
            }
            ?> id="container">
        <div class="form-container sign-up-container" id="sign-up-container">
          <form name="sign-up-form" action="backend/auth/signup.php" method="post">
          <!-- <form> -->
            <h1>Create Account</h1>
            <!-- <div class="social-container">
              <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
              <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your email for registration</span> -->
            <div class="names">
              <input type="text" name="fname" placeholder="First Name" class="fname" required />
              <input type="text" name="lname" placeholder="Last Name" class="lname" required />
            </div>
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button class="reg-user" type="submit" name="Submit" value="Submit">Sign Up</button>
            <a href="agencyreg.php" style="color: black; text-decoration: underline;">Register as a Travel Agency</a>

          </form>
        </div>
        <div class="form-container sign-in-container">
          <form name="sign-in-form" action="backend/auth/signin.php" method="post">
            <h1>Sign in</h1>
            <!-- <div class="social-container">
              <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
              <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your account</span> -->
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <!-- <a href="#">Forgot your password?</a> -->
            <button type="submit">Sign In</button>
          </form>
        </div>
        <div class="overlay-blur"></div>
        <div class="overlay-container">
          <div class="overlay">
            <div class="overlay-panel overlay-left">
              <h1>Greetings, Traveler!</h1>
              <p>Already have an account? Login and start your journey with us.</p>
              <button class="ghost" id="signIn">Login Here</button>
            </div>
            <div class="overlay-panel overlay-right">
              <h1>Welcome!</h1>
              <p>To plan and book trips with us, you need an account first.</p>
              <button class="ghost" id="signUp">Sign Up Now</button>
            </div>
          </div>
        </div>
      </div>

      <div id="mobile-container" class="container">
        <div class="form-container sign-up-container" id="msign-up-container">
          <form name="sign-up-form" action="backend/auth/signup.php" method="post">
          <!-- <form> -->
            <h1>Create Account</h1>
            <!-- <div class="social-container">
              <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
              <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your email for registration</span> -->
            <div class="names">
              <input type="text" name="fname" placeholder="First Name" class="fname" required />
              <input type="text" name="lname" placeholder="Last Name" class="lname" required />
            </div>
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button class="reg-user" type="submit" name="Submit" value="Submit">Sign Up</button>
            <a href="agencyreg.php" style="color: black; text-decoration: underline;">Register as a Travel Agency</a>

          </form>
        </div>
        <div class="form-container sign-in-container" id="msign-in-container">
          <form name="sign-in-form" action="backend/auth/signin.php" method="post">
            <h1>Sign in</h1>
            <!-- <div class="social-container">
              <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
              <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your account</span> -->
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <a href="#">Forgot your password?</a>
            <button type="submit">Sign In</button>
          </form>
        </div>

        <div class="switch" id="switch">
          <i class="fas fa-arrow-right" id="arr-right"></i>
        </div>
        <script>
          const switchB = document.getElementById('switch');
          const arr = document.getElementById('arr-right');
          const su = document.getElementById('msign-up-container');
          const si = document.getElementById('msign-in-container');

          switchB.addEventListener('click', () => {
            if (arr.style.transform == "scaleX(-1)") {
              su.style.transform = "translate(100%, 0)";
              si.style.transform = "translate(0, 0)";
              arr.style.transform = "scaleX(1)";
              arr.style.transition = "transform .3s ease-in"
            } else {
              su.style.transform = "translate(0, 0)";
              si.style.transform = "translate(-100%, 0)";
              arr.style.transform = "scaleX(-1)";
              arr.style.transition = "transform .3s ease-in"
            }

          });
        </script>

      </div>

    </div>
    <script>
      const signUpButton = document.getElementById('signUp');
      console.log(signUpButton);
      const signInButton = document.getElementById('signIn');
      const container = document.getElementById('container');

      signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
      });

      signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
      });
    </script>
  </section>
  <!-- <section class="main-page user-pref">
    <div class="login-banner">
      <video src="assets/media/plane.mp4" muted loop autoplay preload="auto"></video>

      <div class="pref-form-container">
        <div class="page-one" id="page-one">
          <h1>Traveler Profile</h1>
          <p>Please select your preferred destination types.</p>
          <div class="checklist">
            <input type="checkbox" id="beaches">
            <label class="choice" for="beaches">
              <img src="assets/img/beaches.jpg" alt="">
              <div class="text">Beaches and Resorts</div>
            </label>
            <input type="checkbox" id="mountain">
              <label class="choice" for="mountain">
              <img src="assets/img/mountains.jpg" alt="">
              <div class="text">Mountains</div>
            </label>
            <input type="checkbox" id="island" >
              <label class="choice" for="island">
              <img src="assets/img/islands.jpg" alt="">
              <div class="text">Islands</div>
            </label>
            <input type="checkbox" id="animal">
            <label class="choice" for="animal">
              <img src="assets/img/animals.jpg" alt="">
              <div class="text">Animal Life</div>
            </label>
            <input type="checkbox" id="recreation">
            <label class="choice" for="recreation">
              <img src="assets/img/recreation.jpg" alt="">
              <div class="text">Recreation</div>
            </label>
            <input type="checkbox" id="history">
            <label class="choice" for="history">
              <img src="assets/img/history.jpeg" alt="">
              <div class="text">Historical Landmarks</div>
            </label>
          </div>
          <button onclick="next_btn()">Next</button>
        </div>
        <div class="page-two" id="page-two">
          <h1>Traveler Profile</h1>
          <p class="description">Please add some of the places you've gone to.</p>
          <div class="text">
            <input type="text" placeholder="Search for a place" class="field" />
            <span class="ico"><i class="fas fa-search"></i></span>
          </div>
          <div class="places">
            <div class="place-card">
              <i class="fas fa-map-marker-alt"></i>
              <p>Manila, Philippines</p> <i class="fas fa-times"></i>
            </div>
            <div class="place-card">
              <i class="fas fa-map-marker-alt"></i>
              <p>Bacolod City (Negros Occidental)</p> <i class="fas fa-times"></i>
            </div>
            <div class="place-card">
              <i class="fas fa-map-marker-alt"></i>
              <p>Puerto Princesa (Palawan)</p> <i class="fas fa-times"></i>
            </div>
          </div>
          <label><input type="checkbox" name="" id="terms"> I have read the Terms and Conditions.</label>
          <span class="btn-cont">
            <p id="back-btn" onclick="prev_btn()">Go Back</p>
            <button id="complete-reg" class="complete-reg" disabled>Register Now</button>
          </span>
          
        </div>
      </div>

      <script>
          var pageone = document.getElementById("page-one");
          var pagetwo = document.getElementById("page-two");
        function next_btn() {
          pageone.style.opacity = 0;
          pageone.style.transform = "translate(-10%, 0)";


          // pageone.style.display = "none";
          // pagetwo.style.display = "block";
          pagetwo.style.opacity = 1;
          pagetwo.style.transform = "translate(0, 0)";
          pagetwo.style.transition = "opacity 1s ease-in";

        }
        
        function prev_btn() {
          pageone.style.opacity = 1;
          pageone.style.transform = "translate(0, 0)";
          pageone.style.transition = "all .1s ease-in";

          pagetwo.style.transition = "transform .1s ease-in";
          pagetwo.style.opacity = 0;
          pagetwo.style.transform = "translate(110%, 0)";
        }

        checkbox = document.getElementById("terms");
        button = document.getElementById('complete-reg');
        checkbox.addEventListener('change', function(e) {
          if (checkbox.checked) {
            button.disabled = false;
          } else {
            button.disabled = true;
          }
        });
      </script>
    </div>
  </section> -->



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script>
    $(document).on("change", "input[type='checkbox']", function() {
      $(this).next().toggleClass("active");
    });
  </script>
  <!-- <script>
    $(function() {
      $(document).scroll(function() {
        var $nav = $("._nav");

        $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
      });
    });
  </script> -->

  <script>
    $(function() {

      var pagePositon = 0,
        sectionsSeclector = 'section',
        $scrollItems = $(sectionsSeclector),
        offsetTolorence = 30,
        pageMaxPosition = $scrollItems.length - 1;

      //Map the sections:
      $scrollItems.each(function(index, ele) {
        $(ele).attr("debog", index).data("pos", index);
      });

      // Bind to scroll
      $(window).bind('scroll', upPos);

      //Move on click:
      $('#goto a').click(function(e) {
        if ($(this).hasClass('logn') && pagePositon + 1 <= pageMaxPosition) {
          document.body.style.overflow = 'visible';
          pagePositon=1;
          $('html, body').stop().animate({
            scrollTop: $scrollItems.eq(pagePositon).offset().top
          }, 400);
          document.body.style.overflow = 'hidden';
        }
        if ($(this).hasClass('ret-home') && pagePositon - 1 >= 0) {
          document.body.style.overflow = 'visible';
          pagePositon = 0;
          $('html, body').stop().animate({
            scrollTop: $scrollItems.eq(pagePositon).offset().top
          }, 400);
          document.body.style.overflow = 'hidden';
          return false;
        }
        if ($(this).hasClass('sign-up btn') && pagePositon + 1 <= pageMaxPosition) {
          document.body.style.overflow = 'visible';
          pagePositon = 2;
          $('html, body').stop().animate({
            scrollTop: $scrollItems.eq(pagePositon).offset().top
          }, 400);
          document.body.style.overflow = 'hidden';
        }
      });

      // $('#sign-up-container button').click(function(e) {
      //   if ($(this).hasClass('reg-user') && pagePositon + 1 <= pageMaxPosition) {
      //     document.body.style.overflow = 'visible';
      //     pagePositon = 2;
      //     $('html, body').stop().animate({
      //       scrollTop: $scrollItems.eq(pagePositon).offset().top
      //     }, 400);
      //     document.body.style.overflow = 'hidden';
      //   }
      // });

      $('#page-two button').click(function(e) {
        pagePositon = 0;
        if ($(this).hasClass('complete-reg') && pagePositon + 1 <= pageMaxPosition) {
          document.body.style.overflow = 'visible';
          pagePositon = 1;
          $('html, body').stop().animate({
            scrollTop: $scrollItems.eq(pagePositon).offset().top
          }, 400);
          document.body.style.overflow = 'hidden';
        }
      });


      //Update position func:
      function upPos() {
        var fromTop = $(this).scrollTop();
        var $cur = null;
        $scrollItems.each(function(index, ele) {
          if ($(ele).offset().top < fromTop + offsetTolorence) $cur = $(ele);
        });
        if ($cur != null && pagePositon != $cur.data('pos')) {
          pagePositon = $cur.data('pos');
        }
      }
    });
  </script>
</body>

</html>