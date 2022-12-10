<?php
include "backend/package/packages_display.php";
include "backend/connect/dbCon.php";

include "backend\auth\getagency.php";
?>
<script>
  var $nav = $("._nav");
  $nav.toggleClass("scrolled");
</script>
<link rel="stylesheet" href="assets/css/profile-edit.css">
<link rel="stylesheet" href="assets/css/travel-order.css">

<section class="sections profile-view" id="profile-view" style="margin-top: 5rem;">
  <div class="profile-view-container">
    <div class="nav-vertical">
      <div class="user">
        <img src="<?php echo 'assets/img/users/travelagent/' . $_SESSION['setID'] . '/pfp/' . $_SESSION['setPfPicture']; ?>" alt="" style="height: 100px">
        <div style="display: flex; justify-content: center; gap: 5px; align-items: center;">
          <p style="font-size: 17px; font-weight: bold;"><?php echo $_SESSION['setName'] ?></p>
          <?php if ($_SESSION['setVerStat'] == 'verified') {?>
          <span class="material-symbols-outlined" >
            verified
          </span>
          <?php } ?>
        </div>
        <span style="font-size: 13px;"><i class="far fa-eye" style="margin-right: 3px;"></i><a href="agency-profile.php?mode=view">View As Visitor</a></span>
      </div>
      <ul class="tabs">
        <li data-tab-target="#info" class="tab active" id="acc-active">
          <img src="https://img.icons8.com/plasticine/50/000000/name.png" />
          My Account
        </li>
        <?php 
        if ($_SESSION['setVerStat'] == 'verified') { 
          echo<<<END
            <li data-tab-target="#dashboard" class="tab" id="load-charts">
          END;
        } else {
          echo<<<END
            <li class="tab" style="cursor: not-allowed; opacity: .7;">
          END;
        }
        ?>
          <img src="https://img.icons8.com/plasticine/50/null/analytics.png"/>
          My Stats
        </li>
        <?php 
        if ($_SESSION['setVerStat'] == 'verified') { 
          echo<<<END
            <li data-tab-target="#package" class="tab" id="pack-active" onclick="returnForm()">
          END;
        } else {
          echo<<<END
            <li class="tab" style="cursor: not-allowed; opacity: .7;" id="pack-active">
          END;
        }
        ?>
          <img src="https://img.icons8.com/plasticine/50/000000/package.png" />
          My Packages
        </li>
        <?php 
        if ($_SESSION['setVerStat'] == 'verified') { 
          echo<<<END
            <li data-tab-target=".booking" class="tab" id="sub-book-active">
          END;
        } else {
          echo<<<END
            <li class="tab" style="cursor: not-allowed; opacity: .7;" id="sub-book-active">
          END;
        }
        ?>
          <img src="https://img.icons8.com/plasticine/50/000000/transaction-list.png" />
          My Transactions
        </li>
      </ul>
    </div>

    <div class="main-panel" style="position: relative; width: 100%;">
      <div class="tab-content" id="tab-content">
        <!-- Dashboard -->
        <?php include "includes/tabs/dashboard.php"; ?>

        <!-- My Account Tab -->
        <?php include "includes/tabs/account-tab.php"; ?>

        <!-- Packages List Tab -->
        <?php include "includes/tabs/package-tab.php"; ?>

        <!-- Create Packages Tab -->
        <?php include "includes/tabs/createpkg-tab.php"; ?>

        <!-- Bookings Tab -->
        <?php include "includes/tabs/bookings-tab.php"; ?>

        <!-- Travel Order Tab -->
        <?php include "includes/tabs/travel-order-tab.php"; ?>
        
      </div>
      <div class="save-container" id="save-ch-btn" style="display: none;">
        <div class="button-container">
          <input type="submit" name='submitupdate' class="saveform-btn" form="myaccountform" value="Save Changes" />
          <button class="discardform-btn">Discard Changes</button>
        </div>
      </div>

    </div>

  </div>

</section>