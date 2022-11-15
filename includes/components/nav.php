<nav class="_nav">
  <input type="checkbox" id="check" />
  <label for="check" class="checkbtn">
    <i class="fas fa-bars"></i>
  </label>
  <label for="check" class="closebtn">
    <i class="fas fa-times"></i>
  </label>
  <label class="logo"><img 
    <?php 
      if ($_SESSION['active'] == 's-dest' || $_SESSION['active'] == 's-pack') { 
        echo 'src="../../assets/img/logo.png"';
      } else {
        echo 'src="assets/img/logo.png"';
      }
    ?>>Lakbayan</label>
    <?php 
      function setClass($sessionName, $pagename, $ispack) {
        $class = "";
        $href="$pagename.php";

        if ($_SESSION['active'] == $sessionName) {
          if ($sessionName == 'index') {
          $class = "active ret-home";
          }
          $class = "active";
          return "class='$class' href='#'";
        } 

        if ($_SESSION['active'] == 's-pack') {
          if ($ispack) {
            $class = 'active';
          }
          $href = "../../$pagename.php";
          return "class='$class' href='$href'";
        } 

        return "class='$class' href='$href'";

      }
      
    ?>
  <ul>
    <li id="goto"><a <?php echo setClass('index', 'index', 0);?> >Home</a></li>
    <!-- <li><a dest?>>Destinations</a></li> -->
    <li>
      <a <?php echo setClass('pack', 'packages', 1);?>>Packages</a>
    </li>
    <li>
      <a <?php echo setClass('map', 'covid', 0);?>>Covid-19</a>
    </li>
    <li>
      <a <?php echo setClass('about', 'about', 0);?>>About Us</a>
    </li>
    <?php 
      if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] == true) {
        echo<<<END
        <li>
        <a style="padding: 13px 0;"><img style="width: 40px; height: 40px;" src="https://img.icons8.com/plasticine/100/null/appointment-reminders.png"/></a>
        </li>
        <li>
          <a href="includes/components/cart.php" style="padding: 13px 0;"><img style="width: 40px; height: 40px;" src="https://img.icons8.com/plasticine/100/null/worldwide-delivery.png"/></a>
        </li>
        <li>
          <a href="#" style="padding: 13px 0;"><img style="width: 40px; height: 40px;" src="https://img.icons8.com/plasticine/100/null/sent.png"/></a>
        </li>
        END;
      }
    ?>
    
    
    <?php
    
    if ($_SESSION['active'] == 'index') {
      if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] == true) {
        echo "<li id='usericon'> <span id='modalOpen'>";
      } else {
        echo "<li id='goto'>";
      }
    } else {
      if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] == true) {
        echo "<li id='usericon'> <span class='logn'>";
      } else {
        echo "<li> <span id='modalOpen'class='logn'>";
      }
    }

    ?>
    <!-- <img src="https://img.icons8.com/external-febrian-hidayat-gradient-febrian-hidayat/64/000000/external-user-user-interface-febrian-hidayat-gradient-febrian-hidayat.png" /></a></li> -->
    <img src="https://img.icons8.com/plasticine/100/null/test-account.png"/></span></li>
  </ul>
  <?php 
    $prefix = "";
    if ($_SESSION['active'] == 's-pack') {
      $prefix = "../../";
    }
    echo<<<END
        <div class="dropdown" id="dropdown">
          <ul style="list-style-type: none;">
    END;
    if (isset($_SESSION['active']) and $_SESSION['active'] != 'profile') {
     echo<<<END
            <a href="{$prefix}user-profile.php">
              <li style="margin-bottom: 10px;">
                <img src="https://img.icons8.com/plasticine/100/null/automatic.png"/>
                Profile Settings
              </li>
            </a>
        END;
    }
    if (isset($_SESSION['utype']) and $_SESSION['utype'] == 'manager') {
      echo<<<END
            <a href="{$prefix}agency-profile.php">
              <li style="margin-bottom: 10px;">
                <img src="https://img.icons8.com/plasticine/100/null/travel-card.png"/>
                Travel Agency
              </li>
            </a>
        END;
      }
      echo<<<END
            <a href="{$prefix}backend/auth/signout.php">
              <li>
                <img src="{$prefix}assets/img/icons8-shutdown-100.png"/>
                Log Out
              </li>
            </a>
          </ul>
        </div>
      END;
  ?>
  <script>
  const $usericon = $("#usericon");
  const $dropdown = $("#dropdown");
  $usericon.on("click", function() {
    $dropdown.toggleClass("show");
  });
  $(document).on('click', function (e) {
    if ($("#usericon, #dropdown").has(e.target).length === 0) {
      $dropdown.removeClass("show");
    }
  });
  </script>
</nav>