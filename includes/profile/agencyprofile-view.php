<?php
  include 'backend/auth/getagency.php';

  $disEmail = $_SESSION['setEmail'];
  $disDesc = $_SESSION['setDesc'];
  $disAdd = $_SESSION['setAdd'];
  $disTelNum = $_SESSION['setTelNumber'];
  $disMName = $_SESSION['setMName'];
  $disMContact = $_SESSION['setMContact'];
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
      <img id="img-banner" src="assets/img/islands.jpg" alt="">
    </div>

    <div class="profile-container">
      <div class="banner-logo">
          <div class="image">
            <img src="assets/img/logo.png" alt="">
          </div>

        <div class="top">
          <span>  
          <?php

            echo '<h1 class="agency-name">'.$_SESSION['setName'].'</h1>
                  <p class="agency-email">'.$disEmail.'</p>';
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
        '<div class="desc">
          <p class="desc-body active" id="desc-body">'.$disDesc.'</p>
          <textarea class="desc-textarea" name="" id="desc-textarea"></textarea>
          <div class="desc-btn">
            <div class="edit-desc active" id="edit-desc-btn"><i class="fas fa-pen"></i></div>
            <div class="save-desc" id="save-desc-btn"><i class="fas fa-save"></i></div>
          </div>
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
                echo '<span class="col-right active" id="">'.$_SESSION['setName'].'</span>';
                ?>
              </div>

              <div class="row">
                <span class="col-left">Address</span>
                <?php
                echo '<span class="col-right active" name="profAdd">'.$disAdd.'</span>';
                ?>
              </div>

              <div class="row">
                <span class="col-left">Email</span>
                <?php
                echo '<span class="col-right active">'.$disEmail.'</span>';
                ?>
              </div>

              <div class="row bot">
                <span class="col-left">Telephone #</span>
                <?php
                echo '<span class="col-right active">'.$disTelNum.'</span>'
                ?>
              </div>
            </div>

            <h1>Manager Information</h1>
            <div class="details">
              <div class="row top">
                <span class="col-left">Name</span>
                <?php 
                echo '<span class="col-right active">'.$disMName.'</span>';
                ?>
              </div>
              <div class="row">
                <span class="col-left">Contact #</span>
                <?php
                echo '<span class="col-right active">'.$disMContact.'</span>';
                ?>
              </div>
              <div class="row bot">
                <span class="col-left">Email</span>
                <?php
                echo '<span class="col-right active">'.$disEmail.'</span>';
                ?>
              </div>
            </div>
        </div>

        <div id="package" data-tab-content class="data-tab-content">
          <?php 
            while($row = mysqli_fetch_array($qry_packages))
            {
            ?>

            <div class="card-container">
              <div class="wrap">
                <div class="image">
                  
                 <?php
                 echo '<img src="data:image/jpg;base64,'.base64_encode($row['packageImg_Name']).'" alt=""/>';
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
                  <span class="func-edit">
                    <div class="buttn"><i class="fas fa-pen"></i></div>
                  </span>
                  <span class="func-delete">
                    <div class="buttn"><i class="fas fa-trash"></i></div>
                  </span>

                  <span class="earnings">
                    <p class="amt"><?php echo $row['fresult']?></p>
                    <p style="font-size: 12px;">PER PERSON</p>
                  </span>
                </div>
              </div>
            </div>
              
            <?php 
            }
            ?>

        </div>
        
      </div>


    </div>

  </section>