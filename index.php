<?php
session_start();
$_SESSION['active'] = 'index';
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
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="assets/css/scroll-snap.css">
  <link rel="stylesheet" href="assets/css/modal.css">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="assets/img/logo.png">

  <title>Lakbayan Travels and Tours</title>
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
            if(!$_SESSION['isLoggedIn']) { 
              echo "class=\"logn\"";
            } else {
              echo "href=\"destinations.php\"";
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
        <div class="form-container sign-up-container">
          <form name="sign-up-form" action="backend/auth/signup.php" method="post">
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
            <button type="submit" name="Submit" value="Submit">Sign Up</button>
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
            <a href="#">Forgot your password?</a>
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
          pagePositon++;
          $('html, body').stop().animate({
            scrollTop: $scrollItems.eq(pagePositon).offset().top
          }, 400);
          document.body.style.overflow = 'hidden';
        }
        if ($(this).hasClass('logp') && pagePositon - 1 >= 0) {
          document.body.style.overflow = 'visible';
          pagePositon--;
          $('html, body').stop().animate({
            scrollTop: $scrollItems.eq(pagePositon).offset().top
          }, 300);
          document.body.style.overflow = 'hidden';
          return false;
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