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
        <p style="font-size: 17px; font-weight: bold;"><?php echo $_SESSION['setName'] ?></p>
        <span style="font-size: 13px;"><i class="far fa-eye" style="margin-right: 3px;"></i><a href="agency-profile.php?mode=view">View As Visitor</a></span>
      </div>
      <ul class="tabs">
        <li data-tab-target="#info" class="tab active" id="acc-active">
          <img src="https://img.icons8.com/plasticine/50/000000/name.png" />
          My Account
        </li>
        <li data-tab-target="#package" class="tab" style="margin-bottom: 5px;" id="pack-active" onclick="returnForm()">
          <img src="https://img.icons8.com/plasticine/50/000000/package.png" />
          My Packages
        </li>
        <li data-tab-target=".booking" class="tab" id="sub-book-active">
          <img src="https://img.icons8.com/plasticine/50/000000/transaction-list.png" />
          My Transactions
        </li>
      </ul>
    </div>

    <div class="main-panel" style="position: relative; width: 100%;">
      <div class="tab-content" id="tab-content">
        <!-- My Account Tab -->
        <?php include "includes/account-tab.php"; ?>

        <!-- Packages List Tab -->
        <?php include "includes/package-tab.php"; ?>

        <!-- Create Packages Tab -->
        <?php include "includes/createpkg-tab.php"; ?>

        <!-- Bookings Tab -->
        <?php include "includes/bookings-tab.php"; ?>

        <!-- Travel Order Tab -->
        <?php include "includes/travel-order-tab.php"; ?>
        
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