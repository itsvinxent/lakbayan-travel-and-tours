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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <title>Lakbayan</title>
</head>

<body>
  <?php
  include __DIR__.'/includes/components/nav.php';
  // include __DIR__.'/includes/components/accountModal.php';
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
          <form name="sign-up-form" id="sign-up-form" action="backend/auth/signup.php" method="POST">
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
            <input type="hidden" name="trav-preferences" id="trav-preferences">
            <button class="reg-user" type="button" name="Submit">Next</button>
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
            <a class="remodal-open" style="cursor: pointer;">Forgot your password?</a>
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
          <form name="msign-up-form" id="msign-up-form" action="backend/auth/signup.php" method="post">
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
            <input type="hidden" name="trav-preferences" id="mtrav-preferences">
            <button class="reg-user" type="button" name="Submit">Next</button>
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
            <a class="remodal-open" style="cursor: pointer;">Forgot your password?</a>
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
  <!-- Password Reset Modal -->
  <div class="modal-container" id="re-modal_container">
        <div class="user-modal">
            <h1>Reset Password</h1>
            <p>Enter the email you used when you created your Lakbayan Account and we'll send you a link to reset your account.</p>
            <form action="backend/auth/recoverpass.php" method="POST">
              <br><input type="email" name="recovery-email" id="recovery-email"><br>
              <div class="buttons">
                <button type="submit" id="recoverAccount" class="modal-login">Recover</button>
                <a id="modalBClose" class="btn">Cancel</a>
              </div>
            </form>
        </div>
    </div>
    <script>
      $('.remodal-open').on("click", function() {
        $("#re-modal_container").addClass("show");
      });
      
      $('#modalBClose').on("click", function() {
        $("#re-modal_container").removeClass("show");
      });

      $("#re-modal_container").on('click', function (e) {
        if ($("#re-modal_container").has(e.target).length === 0) {
          $("#re-modal_container").removeClass("show");
        }
      });    
  </script>
  <section class="main-page user-pref">
    <div class="login-banner">
      <video src="assets/media/plane.mp4" muted loop autoplay preload="auto"></video>

      <div class="pref-form-container">
        <div class="page-one" id="page-one">
          <h1>Traveler Profile</h1>
          <p>Please select your preferred destination types.</p>
          <div class="checklist">
            <input type="checkbox" id="beaches" name="select-preferences" value="Beaches and Resorts">
            <label class="choice" for="beaches">
              <img src="assets/img/beaches.jpg" alt="">
              <div class="text">Beaches and Resorts</div>
            </label>
            <input type="checkbox" id="mountain" name="select-preferences" value="Mountains">
              <label class="choice" for="mountain">
              <img src="assets/img/mountains.jpg" alt="">
              <div class="text">Mountains</div>
            </label>
            <input type="checkbox" id="island" name="select-preferences" value="Islands">
              <label class="choice" for="island">
              <img src="assets/img/islands.jpg" alt="">
              <div class="text">Islands</div>
            </label>
            <input type="checkbox" id="animal" name="select-preferences" value="Animal Life">
            <label class="choice" for="animal">
              <img src="assets/img/animals.jpg" alt="">
              <div class="text">Animal Life</div>
            </label>
            <input type="checkbox" id="recreation" name="select-preferences" value="Recreation">
            <label class="choice" for="recreation">
              <img src="assets/img/recreation.jpg" alt="">
              <div class="text">Recreation</div>
            </label>
            <input type="checkbox" id="history" name="select-preferences" value="Historical Landmarks">
            <label class="choice" for="history">
              <img src="assets/img/history.jpeg" alt="">
              <div class="text">Historical Landmarks</div>
            </label>
          </div>
          <span class="bot-cont" style="display: flex; justify-content: space-between;">
            <span class="btn-cont" style="display: flex; margin-top: 10px;">
              <input type="checkbox" name="" id="terms" style="cursor: pointer; display: block; margin-right: 10px;">
              <label for="terms" style="cursor: pointer;">
                I have read the <a href="includes/components/terms-and-conditions.php" style="text-decoration: underline; color: var(--first-color); font-weight: bold;"> Terms and Conditions</a>
              </label>
            </span>
            <button id="complete-reg" type="submit" disabled>Register</button>
          </span>
          
        </div>
      </div>

      <script>
        checkbox = document.getElementById("terms");
        button = document.getElementById('complete-reg');
        var travPref = '#trav-preferences';
        $('#terms').on('change', function(e) {
          if ($(this).is(":checked")) {
            $('#complete-reg').prop("disabled", false);
          } else {
            $('#complete-reg').prop("disabled", true);
          }
        });

        $("#page-one input[type='checkbox']").prop('checked', false); 

        
      </script>
    </div>
  </section>


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
    window.onbeforeunload = function () {
      document.body.style.overflow = 'visible';
      window.scrollTo(0, 0);
      document.body.style.overflow = 'hidden';

      $("#page-one input[name='select-preferences']").each(function() {
        $(this).prop("checked", false);
      });

      $('#terms').prop("checked", false);
      $('#complete-reg').prop("disabled", true);
    }; 
    $(function() {

      function scrollOnClick(pagePos) {
        let pagePositon = pagePos;
        document.body.style.overflow = 'visible';
        $('html, body').stop().animate({
          scrollTop: $scrollItems.eq(pagePositon).offset().top
        }, 400); 
        document.body.style.overflow = 'hidden';
      }

      var pagePositon = 0,
        sectionsSeclector = 'section',
        $scrollItems = $(sectionsSeclector),
        offsetTolorence = 30,
        pageMaxPosition = $scrollItems.length - 1;
        // scrollByButton = false;
      //Map the sections:
      $scrollItems.each(function(index, ele) {
        $(ele).attr("debog", index).data("pos", index);
      });

      // Bind to scroll
      $(window).bind('scroll', upPos);

      //Move on click:
      $('#goto a').click(function(e) {
        if ($(this).hasClass('logn') && pagePositon + 1 <= pageMaxPosition) {
          // scrollByButton = true;
          scrollOnClick(1)
        }
        if ($(this).hasClass('ret-home') && pagePositon - 1 >= 0) {
          // scrollByButton = true;
          scrollOnClick(0);
        }
        if ($(this).hasClass('sign-up btn') && pagePositon + 1 <= pageMaxPosition) {
          // scrollByButton = true;
          scrollOnClick(2);
        }
      })
      
      $(window).resize(function() {
        scrollOnClick(pagePositon);
      });

      var container = '#sign-up-container';
      var $container;

      function setContainer() {
        if ($('#container').css('display') == 'none') {
          container = '#msign-up-container';
          travPref = '#mtrav-preferences';
        } else {
          container = '#sign-up-container';
          travPref = '#trav-preferences';
        }

        $container = $(container);
        
        $('#login').find($container).find("button").click(function(e){
          if($container.find('input[name="fname"]').val() == '' || 
            $container.find('input[name="lname"]').val() == '' ||
            $container.find('input[name="email"]').val() == '' ||
            $container.find('input[name="password"]').val() == '') {
              $container.find("input").each(function() {
                if ($(this).val() == '')
                  $(this).addClass("missing");
              })
              alert('All fields must be filled up before proceeding!')
            } else {
              // $('.pref-form-container').css('opacity', '1');
              // scrollByButton = true;
              scrollOnClick(2);
            }
        });

        $container.find("input").bind('click change', function() {
          $(this).removeClass("missing");
        });

        $("#complete-reg").on('click', function(event) {
            event.preventDefault();
            getPref = $("#page-one input[name='select-preferences']:checked").map(function(){
              return $(this).val();
            }).get();
            console.log(getPref)
            $(travPref).val(getPref);
            if (getPref.length > 0) {
              if (container === '#msign-up-container') {
                $('#msign-up-form').submit();
              } else {
                $('#sign-up-form').submit();
              }
            }
            else 
              alert('Please select atleast ONE (1) preferred destination type.');
        });
      }
      
      window.addEventListener("resize", function() {
        // var width = window.innerWidth;
        setContainer();  
      });

      setContainer();

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