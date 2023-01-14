<?php
  include __DIR__.'/../../backend/auth/getagency.php';

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
    <?php if (isset($display['agencyBanner'])) 
        {
        echo '<img id="img-banner" src="assets/img/users/travelagent/'.$display['agencyID'].'/banner/'.$display['agencyBanner'].'" alt="">';
        }
        else {
        echo '<img id="img-banner" src="assets/img/users/travelagent/DefaultBannerAgent.jpg" alt="">';
        }
        ?> 
    </div>

    <div class="profile-container">
      <div class="banner-logo">
          <div class="image">
            <?php if (isset($display['agencyPfPicture'])) 
                {
                echo '<img id="img-banner" src="assets/img/users/travelagent/'.$display['agencyID'].'/pfp/'.$display['agencyPfPicture'].'" alt="">';
                }
                else {
                echo '<img id="img-banner" src="assets/img/users/travelagent/DefaultAgent.png" alt="">';
                }
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
            echo '</div>';
                  // <p class="agency-email">'.$display['agencyEmail'].'</p>';
            
            $ratingsummary_query_string = "SELECT * FROM  agencyrating_tbl WHERE agencyID= $viewID";
            $sqlquery = mysqli_query($conn, $ratingsummary_query_string);
            $ratingCounts = mysqli_fetch_array($sqlquery);
            $totalWeight = 0;
            $totalReviews = 0;
            if ($ratingCounts != 0){
              $rating_count_array = array(
                5 => $ratingCounts['5_star'],
                4 => $ratingCounts['4_star'],
                3 => $ratingCounts['3_star'],
                2 => $ratingCounts['2_star'],
                1 => $ratingCounts['1_star']
              );

              

              foreach ($rating_count_array as $weight => $numberofReviews) {
              $WeightMultipliedByNumber = $weight * $numberofReviews;
              $totalWeight += $WeightMultipliedByNumber;
              $totalReviews += $numberofReviews;
              } 
              $averageRating = $totalWeight / $totalReviews;
            }


            // echo "<div>$averageRating out of 5 <i class='fas fa-star' style='padding-right: 3px; color: var(--logo-yellow-dark);'></i> ($totalReviews)</div>";
          ?>
          <div class="rating agency" style="font-size: 20px; display: flex;">
            <?php
              $stars = 5;
              
              if ($ratingCounts != 0){
              $wholeNum = floor($averageRating);
              $decimal = $averageRating - $wholeNum;

              for ($i = 0; $i < $wholeNum; $i++) {
                echo '<i class="fas fa-star"></i>';
                $stars--;
              }

              if ($decimal != 0) {
                if ($decimal <= 0.5) {
                  echo '<i class="fas fa-star-half-alt"></i>';
                } else {
                  echo '<i class="fas fa-star"></i>';
                }
                $stars--;
              }
              }

              for ($i=0; $i < $stars; $i++) { 
                  echo '<i class="far fa-star"></i>';
              }
            ?>
            <?php echo "<p style='font-size: 16px;'>($totalReviews Ratings)</p>";?>
          </div>
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