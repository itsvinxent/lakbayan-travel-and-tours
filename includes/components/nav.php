<nav class="_nav" id="navbar">
  <input type="checkbox" id="check" />
  <label for="check" class="checkbtn">
    <i class="fas fa-bars"></i>
  </label>
  <label for="check" class="closebtn">
    <i class="fas fa-times"></i>
  </label>
  <label class="logo"><img 
    <?php 
      if ($_SESSION['active'] == 's-dest' || $_SESSION['active'] == 's-pack' || $_SESSION['active'] == 'chat-main' || $_SESSION['active'] == 'email' ) { 
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
          $class = "active";
          if ($sessionName == 'index') {
            $class = "active ret-home";
          }
          return "class='$class' href='#'";
        } 

        if ($_SESSION['active'] == 's-pack') {
          if ($ispack) {
            $class = 'active';
          }
        }
        if ($_SESSION['active'] == 's-pack' || $_SESSION['active'] == 'chat-main' || $_SESSION['active'] == 'email') {
          $href = "../../$pagename.php";
          return "class='$class' href='$href'";
        } 

        return "class='$class' href='$href'";

      }

    ?>
  <ul class="main-list">
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
    <!-- <span id="nav-icons-set"> -->
    <?php 
    include __DIR__.'/../../backend/connect/dbCon.php';
      // if (isset($_SESSION['utype']) and $_SESSION['utype'] == 'user') {
      //   echo '<li>
      //           <a href="includes/components/cart.php" style="padding: 13px 0;"><img style="width: 40px; height: 40px;" src="https://img.icons8.com/plasticine/100/null/worldwide-delivery.png"/></a>
      //         </li>';
      // }
      if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] == true) {
        if (isset($_SESSION['utype']) and $_SESSION['utype'] != 'admin') {
          echo "<li class='cht nav-icons'>
                  <a " .setClass('chat-main', 'backend/chat/chatmain', 0)." style='padding: 13px 0;'><img style='width: 40px; height: 40px;' src='https://img.icons8.com/plasticine/100/null/sent.png'/></a>
                </li>";
        }

        $show_notification = "SELECT * FROM notification_tbl WHERE notification_to='$_SESSION[id]' ORDER BY notification_id DESC";
        $show_fresh = "SELECT * FROM notification_tbl WHERE notification_to='$_SESSION[id]' AND notification_status = 0 ORDER BY notification_id DESC";
        $result = mysqli_query($conn, $show_notification);
        $resultfresh = mysqli_query($conn, $show_fresh);
        echo '<li class="notification nav-icons" id="notification">
                <a style="padding: 13px 0;">
                  <img id="bell-icon" style="width: 40px; height: 40px;" src="https://img.icons8.com/plasticine/100/null/appointment-reminders.png"/>';
        if (mysqli_num_rows($resultfresh) != 0) {
          echo "<span id='notif_count'>".mysqli_num_rows($resultfresh)."</span>";
        }

        echo '</a>
                <div class="notification__wrapper" id="notification__wrapper">
                <ul class="notification__dropdown" id="notification__dropdown">';
      
                  if(mysqli_num_rows($result)>0){
                    foreach($result as $item){
                   
                      echo  '<li>
                        <span>';
                        if($item['notification_status']==0)
                        echo '<b class="highlight">'.ucfirst($item['notification_category']).':</b> '.$item['notification_content'].'</span>
                      </li>';
                        else   echo '<b>'.ucfirst($item['notification_category']).':</b> '.$item['notification_content'].'</span>
                        </li>';
                    
                    } 
                   }else {
                      echo  '<li>
                        <span>No new notifications</span>
                      </li>';
                   }
             echo '</ul>
                   </div>
            </li>';

      }
    ?>
    
    
    <?php
    
    if ($_SESSION['active'] == 'index') {
      if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] == true) {
        echo "<li class='usrlog nav-icons' id='usericon'> <a id='modalOpen' style='padding: 13px 0;'>";
      } else {
        echo "<li class='usrlog nav-icons' id='goto'><a class='logn' style='padding: 13px 0;'>";
      }
    } else {
      if (isset($_SESSION['isLoggedIn']) and $_SESSION['isLoggedIn'] == true) {
        echo "<li class='usrlog nav-icons' id='usericon'> <a class='logn' style='padding: 13px 0;'>";
      } else {
        echo "<li class='usrlog nav-icons'> <a id='modalOpen'class='logn' style='padding: 13px 0;'>";
      }
    }

    ?>
    <!-- <img src="https://img.icons8.com/external-febrian-hidayat-gradient-febrian-hidayat/64/000000/external-user-user-interface-febrian-hidayat-gradient-febrian-hidayat.png" /></a></li> -->
    <img src="https://img.icons8.com/plasticine/100/null/test-account.png"/></a></li>
    <!-- </span> -->
  </ul>
  <?php 
    $prefix = "";
    if ($_SESSION['active'] == 's-pack' || $_SESSION['active'] == 'chat-main') {
      $prefix = "../../";
    }
    echo<<<END
        <div class="dropdown" id="dropdown">
          <ul style="list-style-type: none;">
    END;
    if (isset($_SESSION['active']) and $_SESSION['active'] != 'u-profile') {
     echo<<<END
            <a href="{$prefix}user-profile.php">
              <li style="margin-bottom: 10px;">
                <img src="https://img.icons8.com/plasticine/100/null/automatic.png"/>
                Profile Settings
              </li>
            </a>
        END;
    }
    if (isset($_SESSION['utype']) and $_SESSION['utype'] == 'manager' and $_SESSION['active'] != 'a-profile') {
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
  $(document).on('click', function (event) {
    if ($("#usericon, #dropdown").has(event.target).length === 0) {
      $dropdown.removeClass("show");
    }
  
    if (!$(event.target).closest('#navbar ul').length && $("#navbar ul").css("right") == '0px' && $('#check').prop('checked') == true || $(event.target).closest('#notif-icon').length)  {
      $('#check').prop('checked', false);
      $(".nav-icons").css("opacity", "1");
      $(".nav-icons").css("pointer-events", "none");
    }

    if (!$(event.target).closest('#notification__dropdown').length && $(event.target)[0] != $('#bell-icon')[0]) {
      $("#notification__dropdown").removeClass("show");
      $("#notification__wrapper").removeClass("show");
    }
  });

  $("#notification").on("click", () =>{
    $("#notification__dropdown").toggleClass("show");
    $("#notification__wrapper").toggleClass("show");
    // Remove Unread Notif Count
    $('#notif_count').css('display', 'none');
    // $('#check').prop('checked', false);
  })

  $(document).ready(()=>{
    $("#notification").on("click",()=>{
      $.ajax({
        url: "<?php echo $prefix;?>backend\\notifications\\notification_read.php",
        success: (res)=>{
          $("#notification a span").text(0)
        }
        
      })
    })

    $("#check").change(function() {
      if(this.checked) {
        $(".nav-icons").css("opacity", "0");
        // $(".nav-icons").css("transition", "opacity .5s");
        $(".nav-icons").css("pointer-events", "none");

        $("#notification__dropdown").removeClass("show");
        $("#notification__wrapper").removeClass("show");

      } else {
        $(".nav-icons").css("opacity", "1");
        // $(".nav-icons").css("transition", "opacity .5s");
        $(".nav-icons").css("pointer-events", "auto");

      }
    });
  })
  </script>
</nav>