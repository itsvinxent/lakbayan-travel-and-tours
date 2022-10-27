<?php
include "backend/package/packages_display.php";
include "backend/connect/dbCon.php";

include "backend/auth/getuser.php";
?>
<link rel="stylesheet" href="assets/css/profile-edit.css">

<section class="sections profile-view" id="profile-view">

  <div class="banner-half" style="height: 25vh;">
    <video src="assets/media/waves.mp4" muted loop autoplay preload="auto" style="height: 25vh;"></video>
    <div class="text">
      <h1>Profile Page</h1>

    </div>
  </div>

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
        <li data-tab-target="#history" class="tab">
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
                 <span class="col-right active"><?php echo $_SESSION['lname']?></span>
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
                <span class="col-right active" id=""><p><?php echo $_SESSION['password']?></p></span>
                <span class="col-right-edit">
                  <input type="text" name="pass" id="password" value="">
                  <input type="hidden" value="<?php echo $_SESSION['password']?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                  <div class="bg">
                    <i class="fas fa-save"></i>
                  </div>
                </span>
              </div>

              <div class="row">
                <span class="col-left">Usertype</span>
                <span class="col-right active" id=""><p>User</p></span>
                <span class="col-right-edit">
                  <select name="usertype" id="utype" required>
                    <option value="user">User</option>
                    <option value="manager">Agency Manager</option>
                    <option value="admin">Administrator</option>
                  </select>
                  <input type="hidden" value="<?php echo "user"?>">
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

      </div>

      <div id="history" data-tab-content class="data-tab-content">
        <table class="user-table">
          <thead>
            <tr>
              <th>Booking Date</th>
              <th>Name</th>
              <th>Travel Package</th>
              <th># of Persons</th>
              <th># of Days</th>
              <th>Trip Date</th>
              <th>Total</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>08/23/22</td>
              <td>John Mark De Ocampo</td>
              <td>Campuestohan Highland Resort</td>
              <td>5</td>
              <td>3</td>
              <td>9/11/22</td>
              <td>P10,500</td>
              <td>
                <a href="travel-order.php">Travel Order</a>
              </td>
            </tr>
            <tr>
              <td>08/23/22</td>
              <td>Han Solo</td>
              <td>Lakawon Island Day Tour</td>
              <td>2</td>
              <td>2</td>
              <td>9/05/22</td>
              <td>P15,000</td>
              <td>
                <a href="travel-order.php">Travel Order</a>
              </td>
            </tr>
            <tr>
              <td>08/23/22</td>
              <td>Ben Kenobi</td>
              <td>Lakawon Island Day Tour</td>
              <td>5</td>
              <td>2</td>
              <td>9/18/22</td>
              <td>P30,000</td>
              <td>
                <a href="travel-order.php">Travel Order</a>
              </td>
            </tr>
            <tr>
              <td>08/23/22</td>
              <td>Paolo Benjamin Guico</td>
              <td>Tri-City (Bacolod - Silay - Talisay) Exclusive Day Tour</td>
              <td>9</td>
              <td>3</td>
              <td>9/25/22</td>
              <td>P35,000</td>
              <td>
                <a href="travel-order.php">Travel Order</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

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