<?php
include __DIR__."/../../backend/package/packages_display.php";
include __DIR__."/../../backend/connect/dbCon.php";

include __DIR__."/../../backend/auth/getuser.php";
?>
<link rel="stylesheet" href="assets/css/profile-edit.css">
<link rel="stylesheet" href="assets/css/travel-order.css">

<script>
  var $nav = $("._nav");
  $nav.toggleClass("scrolled");
</script>

<section class="sections profile-view" id="profile-view" style="margin-top: 5rem;">

  <div class="profile-view-container">
    <div class="nav-vertical">
    <div class="user">  
        <!-- <img src="assets/img/logo.png" alt="" style="height: 100px"> -->
        <img <?php echo 'src="assets/img/users/traveler/'.$_SESSION['id'].'/pfp/'.$_SESSION['profpic'].'"' ?>  alt="" style="height: 100px">
        <!-- <p style="font-size: 17px; font-weight: bold;">Lakbayan Travel and Tours</p> -->
        <p style="font-size: 17px; font-weight: bold;"><?php echo $_SESSION['fullname']?></p>
        <span style="font-size: 13px;"><i class="far fa-eye" style="margin-right: 3px;"></i><a href="user-profile.php?mode=view">View As Visitor</a></span>
      </div>
      <ul class="tabs">
        <li data-tab-target="#info" class="tab active">
          <img src="https://img.icons8.com/plasticine/50/000000/name.png" />
          My Account
        </li>
        <li data-tab-target="#package" class="tab" id="sub-book-active">
          <img src="https://img.icons8.com/plasticine/50/000000/transaction-list.png" />
          My Transactions
        </li>
      </ul>
    </div>

    <div class="main-panel" style="position: relative; width: 100%;">
      <div class="tab-content" id="tab-content">
        <!-- My Account Tab -->
        <div id="info" data-tab-content class=" data-tab-content active">
          <form id="editform" action="backend\auth\updateuserprofile.php" method="POST" style="padding-bottom: 3rem;" enctype="multipart/form-data">
            <div class="profile-banner">
              <!-- <img id="img-banner" src="assets/img/islands.jpg" alt=""> -->
              <img id="img-banner" <?php echo 'src="assets/img/users/traveler/'.$_SESSION['id'].'/banner/'.$_SESSION['userbanner'].'"' ?> alt=""> 
              <input type="file" name="aBanner" id="aBanner" accept="image/gif, image/jpeg, image/png" style="display: none;">
              <input type="hidden" name="bannerfile" id="bannerfile">
              <label for="aBanner">
                <div class="banner-hover">
                  <div class="text" for="aBanner">
                    <i class="fas fa-pen"></i>Edit
                  </div>
                </div>
              </label>
            </div>

            <div class="banner-logo">
              <div class="image" style="left: 13%">
                <!-- <img id="img-pic" src="assets/img/logo.png" alt=""> -->
                <img id="img-pic" <?php echo 'src="assets/img/users/traveler/'.$_SESSION['id'].'/pfp/'.$_SESSION['profpic'].'"' ?> alt="">
                <input type="file" name="aPicture" id="aPicture" accept="image/gif, image/jpeg, image/png" style="display: none;">
                <input type="hidden" name="picturefile" id="picturefile">
                <label for="aPicture">
                  <div class="middle">
                    <div class="text">
                      <i class="fas fa-pen"></i>Edit
                    </div>
                  </div>
                </label>
              </div>
            </div>

            <h1>Account Information</h1>
            <div class="details">
              <input type="hidden" name="id" id="user_id">
              <div class="row top">
                <span class="col-left">First Name</span>

                <!-- <span class="col-right active"><p>John Mark</p></span> -->
                <span class="col-right active"><p><?php echo $_SESSION['fname']?></p></span>
                <span class="col-right-edit">
                  <input type="text" name="fname" id="fname" value="">
                  <input type="hidden" value="<?php echo $_SESSION['fname']?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

              <div class="row">
                <span class="col-left">Last Name</span>
                <!-- <span class="col-right active"><p>De Ocampo</p></span> -->
                 <span class="col-right active"><p><?php echo $_SESSION['lname']?></p></span>
                <span class="col-right-edit">
                  <input type="text" name="lname" id="lname" value="">
                  <input type="hidden" value="<?php echo $_SESSION['lname']?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

              <div class="row">
                <span class="col-left">Email</span>
                <!-- <span class="col-right active" id=""><p>ocampomark@gmail.com</p></span> -->
                <span class="col-right active" id=""><p><?php echo $_SESSION['email']?></p></span>
                <span class="col-right-edit">
                  <input type="text" name="email" id="email" value="">
                  <input type="hidden" value="<?php echo  $_SESSION['email']?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

              <div class="row">
                <span class="col-left">Password</span>
                <!-- <span class="col-right active" id=""><p>jgh3bz5</p></span> -->
                <span class="col-right active" id=""><p><?php //echo $_SESSION['password']?>**********</p></span>
                <span class="col-right-edit">
                  <input type="text" name="pass" id="password" value="">
                  <input type="hidden" value="<?php //echo $_SESSION['password']?>**********">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

            </div>

            <h1>Personal Information</h1>
            <div class="details">
              <div class="row">
                <span class="col-left">Birthday</span>
                <!-- <span class="col-right active" id=""><p>08-20-2001</p></span> -->
                <span class="col-right active" id=""><p><?php echo $_SESSION['birthday']?></p></span>
                <span class="col-right-edit">
                  <input type="datetime-local" name="bday" id="bday" value="">
                  <input type="hidden" value="<?php echo $_SESSION['birthday']?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
                <script>
                  flatpickr("#bday", {
                    dateFormat: "m-d-Y",
                    defaultDate: <?php echo "'08-20-2001'"?>
                  });
                </script>
              </div>

              <div class="row">
                <span class="col-left">Age</span>
                <!-- <span class="col-right active" id=""><p>21</p></span> -->
                <span class="col-right active" id=""><p><?php echo $_SESSION['age']?></p></span>
                <span class="col-right-edit">
                  <input type="number" name="age" id="age" value="">
                  <input type="hidden" value="<?php echo $_SESSION['age']?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

              <div class="row">
                <span class="col-left">Gender</span>
                <!-- <span class="col-right active" id=""><p>male</p></span> -->
                <span class="col-right active" id=""><p><?php echo $_SESSION['gender']?></p></span>
                <span class="col-right-edit">
                  <select name="gender" id="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Rather not say</option>
                  </select>
                  <input type="hidden" value="<?php echo $_SESSION['gender']?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

              <div class="row">
                <span class="col-left">Address</span>
                <!-- <span class="col-right active" id=""><p>Cooper Street, Quezon City</p></span> -->
                <span class="col-right active" id=""><p><?php echo $_SESSION['address']?></p></span>
                <span class="col-right-edit">
                  <input type="text" name="address" id="address" value="">
                  <input type="hidden" value="<?php echo $_SESSION['address']?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

              <div class="row">
                <span class="col-left">Telephone #</span>
                <!-- <span class="col-right active" id=""><p>09996547874</p></span> -->
                <span class="col-right active" id=""><p><?php echo $_SESSION['contact']?></p></span>
                <span class="col-right-edit">
                  <input type="text" name="contact" id="contact" value="">
                  <input type="hidden" value="<?php echo $_SESSION['contact']?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

              <div class="row">
                <span class="col-left">Race</span>
                <!-- <span class="col-right active" id=""><p>hehe</p></span> -->
                <span class="col-right active" id=""><p><?php echo $_SESSION['race']?></p></span>
                <span class="col-right-edit">
                  <input type="text" name="race" id="race" value="">
                  <input type="hidden" value="<?php echo $_SESSION['race']?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

              <div class="row">
                <span class="col-left">Nationality</span>
                <!-- <span class="col-right active" id=""><p>Filipino</p></span> -->
                <span class="col-right active" id=""><p><?php echo $_SESSION['nationality']?></p></span>
                <span class="col-right-edit">
                  <input type="text" name="nationality" id="nationality" value="">
                  <input type="hidden" value="<?php echo $_SESSION['nationality']?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

              <div class="row">
                <span class="col-left">Religion</span>
                <!-- <span class="col-right active" id=""><p>Roman Catholic</p></span> -->
                <span class="col-right active" id=""><p><?php echo $_SESSION['religion']?></p></span>
                <span class="col-right-edit">
                  <input type="text" name="religion" id="religion" value="">
                  <input type="hidden" value="<?php echo $_SESSION['religion']?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

            </div>
          </form>
        </div>

        <!-- My Transactions Tab -->
        <div id="package" data-tab-content class="data-tab-content booking">
          <div class="package-search component">
            <div class="name">
              <span><label for="b-package-name">Package Name</label></span>
              <span><input type="search" name="b-package-name" id="b-package-name" placeholder="Enter Package Name"></span>
            </div>
            <div class="dur">
              <span><label for="b-package-transact">TRN</label></span>
              <span><input type="number" name="b-package-transact" id="b-package-transact" placeholder="Enter Transaction Number"></span>
            </div>
            <div class="cat">
              <span><label for="b-package-category">Package ID</label></span>
              <span><input type="number" name="b-package-id" id="b-package-id" placeholder="Enter Package ID"></span>
            </div>
            <div class="cust">
              <span><label for="package-customer">Customer Name</label></span>
              <span><input class="package-customer" type="text" name="package-customer" id="package-customer" placeholder="Enter Customer Name"></span>
            </div>

            <div class="buttons">
              <span><button id="b-get-search">Search</button></span>
              <span><button id="b-reset-search">Reset</button></span>
            </div>
          </div>


          <div class="main-content component" style="margin-top: 10px;">
            <div class="availability-filter">
              <span>
                <input class="stat-inp" type="radio" name="stat-fil" value="s-all" id="s-all" style="display: none;">
                <label for="s-all"><span>All</span></label>
              </span>
              <span>
                <input class="stat-inp" type="radio" name="stat-fil" value="s-unpaid" id="s-unpaid" style="display: none;">
                <label for="s-unpaid"><span>Unpaid</span></label>
              </span>
              <span>
                <input class="stat-inp" type="radio" name="stat-fil" value="s-processing" id="s-processing" style="display: none;">
                <label for="s-processing"><span>Processing</span></label>
              </span>
              <span>
                <input class="stat-inp" type="radio" name="stat-fil" value="s-completed" id="s-completed" style="display: none;">
                <label for="s-completed"><span>Completed</span></label>
              </span>
              <span>
                <input class="stat-inp" type="radio" name="stat-fil" value="s-cancelled" id="s-cancelled" style="display: none;">
                <label for="s-cancelled"><span>Cancelled</span></label>
              </span>
            </div>

            <div id="fullb-table" class="fulltable">
              <?php
              $query_string = "SELECT IQ.*, CONCAT(US.fname, ' ',US.lname) AS fullname, BK.*, PK.packageTitle
                                  FROM  inquiry_tbl AS IQ
                                  INNER JOIN  user_tbl AS US ON IQ.id_user = US.id
                                  INNER JOIN  booking_tbl AS BK ON IQ.id = BK.inquiryInfoID 
                                  INNER JOIN  package_tbl AS PK ON IQ.packageID = PK.packageID
                                  WHERE IQ.id_user = {$_SESSION['id']}";
              fetch_bookingtbl($query_string, $conn);

              ?>
            </div>
            <script src="assets/js/travel-order.js"></script>

          </div>

          <script src="assets/js/search-filters.js"></script>
          <script>
            $('#s-all').prop('checked', true);
            $('#s-all').next().addClass('active');


            $('#b-get-search').on('click', function() {
              pack_name = $('#b-package-name').val();
              pack_transact = $('#b-package-transact').val();
              pack_id = $('#b-package-id').val();
              pack_customer = $('#package-customer').val();
              bookingpostdata['logged_user'] = 'user';

              booking_data_input();

              if (count != 0) {
                filterTimeout(bookingpostdata, '#fullb-table');
              }
              count = 4;

            });

            $('#b-reset-search').on('click', function() {
              bookingpostdata = {
                is_filtering: false,
                booking: true,
                logged_user: 'user'
              }

              filterTimeout(bookingpostdata, '#fullb-table');
            });

            // Transaction Status Filter
            filterTable(".stat-inp", 'status', bookingpostdata)
          </script>

        </div>

        <!-- Travel Order Tab -->
        <?php include __DIR__."/../../includes/tabs/travel-order-tab.php"; ?>

    </div>
    <div class="save-container" id="save-ch-btn" style="display: none;">
      <div class="button-container">
        <button type="submit" name='submit' class="saveform-btn" form="editform">Save Changes</button>
        <button type="button" class="discardform-btn">Discard Changes</button>
      </div>
    </div>

  </div>



  </div>

</section>