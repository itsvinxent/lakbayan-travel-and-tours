<?php
  include 'backend/auth/getagency.php';

  $disMEmail = $_SESSION['setMEmail'];
  $disEmail = $_SESSION['setEmail'];
  $disDesc = $_SESSION['setDesc'];
  $disAdd = $_SESSION['setAdd'];
  $disTelNum = $_SESSION['setTelNumber'];
  $disMName = $_SESSION['setMName'];
  $disMContact = $_SESSION['setMContact'];

  if(isset($_GET['id'])){
    $viewID = $_GET['id'];

    $display = view_other($conn, $viewID);

    $displaypack = view_otherpack($conn, $viewID);
    
    if($display == null){
      echo '<meta http-equiv="refresh" content="0;URL=agency-profile.php" />';
    }
  }else{
    $viewID = $_SESSION['setID'];
    
    $display = view_other($conn, $viewID);
    $displaypack = view_otherpack($conn, $viewID);
  }
?>
<script>
  $(function() {
    $(document).scroll(function() {
      var $nav = $("._nav");

      $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
    });
  });
</script>
<section class="sections profile-view" id="profile-view">

    <div class="banner-half">
      <?php
       echo '<img id="img-banner" src="assets/img/users/travelagent/'.$display['agencyID'].'/banner/'.$display['agencyBanner'].'" alt="">';
      ?>
    </div>

    <div class="profile-container">
      <div class="banner-logo">
          <div class="image">
            <?php 

              echo '<img src="assets/img/users/travelagent/'.$display['agencyID'].'/pfp/'.$display['agencyPfPicture'].'" alt="">';
            ?>
          </div>

        <div class="top">
          <span>  
          <?php
            echo '<div style="display: flex; gap: 10px; align-items: center;">
                    <h1 class="agency-name">'.$display['agencyName'].'</h1>';
            if ($_SESSION['setVerStat'] == 'verified') {
              echo '<span class="material-symbols-outlined" style="font-size: 30px;">
                        verified
                    </span>';
            }
            echo '</div>
                  <p class="agency-email">'.$display['agencyEmail'].'</p>';
          ?>

          </span>
          <span class="ico-container">
            <div class="ico">
              <a href="www.facebook.com" rel="noopener" target="_blank"><i class="fab fa-facebook-f"></i></a>
              <a href="wwww.twitter.com" rel="noopener" target="_blank"><i class="fab fa-twitter"></i></a>
              <a href="www.instagram.com" rel="noopener" target="_blank"><i class="fab fa-instagram"></i></a>
              <a href="www.lakbayan.com" rel="noopener" target="_blank"><i class="fas fa-globe"></i></a>
            </div>
          </span>
        </div>

        <?php

        
        echo 
        '<div class="desc" style="pointer-events: none;">
          <p class="desc-body active" id="desc-body">'.$display['agencyDescription'].'</p>
        </div>'
        ?>
      </div>

      <div class="nav">
        <ul class="tabs">
          <li data-tab-target="#info" class="tab active">Company Information</li>
          <li data-tab-target="#package" class="tab">Travel Packages</li>
        </ul>
      </div>

      <div class="tab-content">
        <div id="info" data-tab-content class=" data-tab-content active">
            <div class="top">
              <span>
                <h1>Agency Details</h1>
              </span>
            </div>
            <div class="details">
              <div class="row top">
                <span class="col-left">Name</span>
                <?php 
                echo '<span class="col-right active" id="">'.$display['agencyName'].'</span>';
                ?>
              </div>

              <div class="row">
                <span class="col-left">Address</span>
                <?php
                echo '<span class="col-right active" name="profAdd">'.$display['agencyAddress'].'</span>';
                ?>
              </div>

              <div class="row">
                <span class="col-left">Email</span>
                <?php
                echo '<span class="col-right active">'.$display['agencyEmail'].'</span>';
                ?>
              </div>

              <div class="row bot">
                <span class="col-left">Telephone #</span>
                <?php
                echo '<span class="col-right active">'.$display['agencyTelNumber'].'</span>'
                ?>
              </div>
            </div>

            <h1>Manager Information</h1>
            <div class="details">
              <div class="row top">
                <span class="col-left">Name</span>
                <?php 
                echo '<span class="col-right active">'.$display['fullname'].'</span>';
                ?>
              </div>
              <div class="row">
                <span class="col-left">Contact #</span>
                <?php
                echo '<span class="col-right active">'.$display['contactnumber'].'</span>';
                ?>
              </div>
              <div class="row bot">
                <span class="col-left">Email</span>
                <?php
                echo '<span class="col-right active">'.$display['email'].'</span>';
                ?>
              </div>
            </div>
        </div>

        <div id="package" data-tab-content class="data-tab-content">
          <?php 
            while($row = mysqli_fetch_array($displaypack))
            {
            ?>

            <div class="card-container">
              <div class="wrap">
                <div class="image">
                  
                 <?php
                  if (isset($row['packageImg_Name'])){
                    echo '<img src="assets/img/users/travelagent/'.$row['packageCreator'].'/package/'.$row['packageID'].'/img/'.$row['packageImg_Name'].'" alt=""/>';}
                  else echo '<img src="assets/img/Missing.jpeg" alt=""/>';
                 ?>
                </div>

                <div class="cap">
                  <h2><?php echo $row['packageTitle']?></h2>
                  <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                  </div>
                  <div class="data">
                    <?php echo $row['packageDescription']?>
                  </div>
                </div>

                <div class="func-btn">
                  <!-- <span class="func-edit">
                    <div class="buttn"><i class="fas fa-pen"></i></div>
                  </span>
                  <span class="func-delete">
                    <div class="buttn"><i class="fas fa-trash"></i></div>
                  </span> -->

                  <span class="earnings">
                    <p class="amt"><?php echo $row['fresult']?></p>
                    <p style="font-size: 12px;">PER PERSON</p>
                  </span>
                </div>
              </div>
            </div>
              
            <?php 
            } echo '<center><p style="padding: 10px 0px 0px 0px;"> No more packages to display</p></center>';
            ?>

        </div>
        
      </div>


    </div>

  </section>