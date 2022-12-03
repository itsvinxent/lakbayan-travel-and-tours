<?php
session_start();
if (isset($_SESSION['utype'])) {
    if ($_SESSION['utype'] == 'user' || $_SESSION['utype'] == 'manager') {
        header("location: index.php");
        exit;
    }
} else {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/profile-edit.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/travel-order.css">
    <link rel="stylesheet" href="assets/css/notifications.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/footer.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css">
    <link rel="stylesheet" href="assets/css/chatbox.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="assets/img/logo.png" />

    <!-- jQuery CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_green.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title>Administrator | Lakbayan Travels and Tours</title>
</head>

<body>
    <?php
    include 'includes/components/nav.php';
    ?>

    <?php
    include "backend/package/packages_display.php";
    include "backend/connect/dbCon.php";

    ?>
    <script>
        var $nav = $("._nav");
        $nav.toggleClass("scrolled");
    </script>

    <section class="sections profile-view" id="profile-view" style="margin-top: 5rem;">
        <div class="profile-view-container">
            <div class="nav-vertical">
                <div class="user">
                    <img src="https://img.icons8.com/plasticine/100/000000/test-account.png" />
                    <p style="font-size: 17px; font-weight: bold;">Administrator</p>
                </div>
                <ul class="tabs">
                    <li data-tab-target="#info" class="tab active" id="acc-active">
                        <img src="https://img.icons8.com/plasticine/50/000000/name.png" />
                        Accounts
                    </li>
                    <li data-tab-target=".verifications" class="tab sub" id="verifications" style="position: relative;">
                        <img src="https://img.icons8.com/plasticine/25/000000/verified-account.png" />
                        Verifications
                        <span class="notif-badge-sml" id="pending-vercount"></span>
                        <script>
                            function getPending() {
                                $.ajax({
                                    url: 'backend/notifications/badges.php',
                                    method: 'POST',
                                    data: {
                                        getPending: 'true'
                                    },
                                    async: true,
                                    context: this,
                                    success: function(data) {
                                        if (parseInt(data) > 99) 
                                            data = "99+";
                                        $('#pending-vercount').text(data)
                                    }
                                });
                            }
                            getPending();
                        </script>
                    </li>
                    <li data-tab-target=".packages" class="tab" style="margin-bottom: 5px;" id="pack-active">
                        <img src="https://img.icons8.com/plasticine/50/000000/package.png" />
                        Packages
                    </li>
                    <li data-tab-target=".booking" class="tab" id="sub-book-active">
                        <img src="https://img.icons8.com/plasticine/50/000000/transaction-list.png" />
                        Transactions
                    </li>
                </ul>
            </div>

            <div class="main-panel" style="position: relative; width: 100%;">
                <div class="tab-content" id="tab-content">
                    <!-- Account Tab -->
                    <div id="info" data-tab-content class=" data-tab-content active">
                        <div class="content-users">
                            <?php include 'backend/admin/user_display.php'; ?>
                        </div>
                    </div>

                    <!-- Edit Account Modal -->
                    <div class="modal-container" id="emodal_container">
                        <div class="tab-content" style="width: 70%;">
                            <div id="info" data-tab-content class=" data-tab-content active">
                                <form id="editform" action="backend\auth\updateprof.php" method="POST">
                                    <div class="profile-banner">
                                        <img id="img-banner" src="assets/img/islands.jpg" alt="">
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
                                            <img id="img-pic" src="assets/img/logo.png" alt="">
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
                                            <span class="col-right active" id="">
                                                <input type="text" name="fname" id="fname" value="">
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="col-left">Last Name</span>
                                            <span class="col-right active" id="">
                                                <input type="text" name="lname" id="lname" value="">
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="col-left">Email</span>
                                            <span class="col-right active" id="">
                                                <input type="text" name="email" id="email" value="">
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="col-left">Password</span>
                                            <span class="col-right active" id="">
                                                <input type="text" id="password" value="">
                                                <input type="hidden" name="pass" id="pass">
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="col-left">Usertype</span>
                                            <span class="col-right active" id="">
                                                <select name="usertype" id="utype" required>
                                                    <option value="user">User</option>
                                                    <option value="manager">Agency Manager</option>
                                                    <option value="admin">Administrator</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                    <h1>Personal Information</h1>
                                    <div class="details">
                                        <div class="row">
                                            <span class="col-left">Birthday</span>
                                            <span class="col-right active" id="">
                                                <input type="datetime-local" name="bday" id="bday" value="">
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="col-left">Age</span>
                                            <span class="col-right active" id="">
                                                <input type="number" name="age" id="age" value="">
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="col-left">Gender</span>
                                            <span class="col-right active" id="">
                                                <select name="gender" id="gender" required>
                                                    <option value="" disabled selected hidden>Sex</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Rather not say</option>
                                                </select>
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="col-left">Address</span>
                                            <span class="col-right active" id="">
                                                <input type="text" name="address" id="address" value="">
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="col-left">Telephone #</span>
                                            <span class="col-right active" id="">
                                                <input type="text" name="contact" id="contact" value="">
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="col-left">Race</span>
                                            <span class="col-right active" id="">
                                                <input type="text" name="race" id="race" value="">
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="col-left">Nationality</span>
                                            <span class="col-right active" id="">
                                                <input type="text" name="nationality" id="nationality" value="">
                                            </span>
                                        </div>

                                        <div class="row">
                                            <span class="col-left">Religion</span>
                                            <span class="col-right active" id="">
                                                <input type="text" name="religion" id="religion" value="">
                                            </span>
                                        </div>

                                    </div>
                                    <div class="edit-buttons" style="margin-top: 2rem;">
                                        <button type="submit" id="modalLogin" class="edit-modal-login">Save Changes</button>
                                        <a id="modalEClose" class="btn">Close</a>
                                    </div>
                                </form>
                            </div>


                        </div>

                        <script>
                            // const eopen = document.getElementById('modalEOpen');
                            const eopeners = Array.from(document.getElementsByClassName('uedit-btn'));
                            const emodal_container = document.getElementById('emodal_container');
                            const eclose = document.getElementById('modalEClose');

                            eopeners.forEach(eopen => {
                                eopen.addEventListener('click', function handleClick(event) {
                                    emodal_container.classList.add('show');

                                    // Reset Form
                                    document.getElementById("editform").reset();

                                    $tr = $(this).closest('tr');

                                    var data = $tr.children('td').map(function() {
                                        return $(this).text();
                                    }).get();

                                    $('#user_id').val(data[0]);

                                    $('#img-pic').attr('src', 'assets/img/users/traveler/' + data[0] + '/pfp/' + data[15]);
                                    $('#fname').val(data[1]);
                                    $('#lname').val(data[2]);
                                    $('#email').val(data[3]);
                                    $('#password').val(data[4]);
                                    $('#pass').val(data[4]);
                                    $('#utype').val(data[5]);
                                    $('#bday').val(data[8]);
                                    $('#gender').val(data[9]);
                                    $('#age').val('');
                                    $('#address').val(data[10]);
                                    $('#nationality').val(data[11]);
                                    $('#race').val(data[12]);
                                    $('#religion').val(data[13]);
                                    $('#contact').val(data[14]);
                                    $('#picturefile').val(data[15]);
                                    // $('#bannerfile').val(data[15]);

                                    var inpf = document.querySelectorAll('.inputfile');
                                    inpf.forEach(input => {
                                        input.nextElementSibling.querySelector('span').innerHTML = data[14];
                                    });

                                });
                            });


                            eclose.addEventListener('click', () => {
                                emodal_container.classList.remove('show');
                                document.getElementById("editform").reset();
                            })
                        </script>
                    </div>

                    <!-- Delete Account Modal -->
                    <div class="modal-container" id="udmodal_container">
                        <div class="user-modal">
                            <h1>Confirmation</h1>
                            <p>You are about to <strong>delete</strong> an account. By doing this, all of this user's transactions will be deleted as well. Type in "I Understand" to confirm. </p>
                            <br><input type="text" name="uconfirm" id="uconfirm" placeholder="I Understand"><br>
                            <form action="" method="POST" id="udel-action">
                                <div class="buttons">
                                    <button type="submit" id="umodalDelete" class="modal-login">Delete Account</button>
                                    <a id="modalDClose" class="btn">Cancel</a>
                                </div>
                            </form>
                        </div>
                        <script>
                            // const eopen = document.getElementById('modalEOpen');
                            const udopeners = Array.from(document.getElementsByClassName('udelete-btn'));
                            const udmodal_container = document.getElementById('udmodal_container');
                            const udclose = document.getElementById('modalDClose');
                            const uform = document.getElementById('udel-action');
                            const uconfirm = document.getElementById('uconfirm')

                            udopeners.forEach(dopen => {
                                dopen.addEventListener('click', function handleClick(event) {
                                    udmodal_container.classList.add('show');

                                    $tr = $(this).closest('tr');

                                    var data = $tr.children('td').map(function() {
                                        return $(this).text();
                                    }).get();

                                    uform.action = "backend/admin/user_delete.php?id=" + data[0]


                                });
                            });

                            document.getElementById('umodalDelete').disabled = true;
                            uconfirm.addEventListener('input', function() {
                                if (this.value == "I Understand") {
                                    document.getElementById('umodalDelete').disabled = false;
                                } else {
                                    document.getElementById('umodalDelete').disabled = true;
                                }
                            });

                            udclose.addEventListener('click', () => {
                                $(uconfirm).val('');
                                udmodal_container.classList.remove('show');
                            })
                        </script>
                    </div>

                    <!-- Verifications Tab -->
                    <?php include "includes/tabs/verify-tab.php"; ?>
                    
                    <!-- Packages List Tab -->
                    <?php include "includes/tabs/package-tab.php"; ?>

                    <!-- Create Packages Tab -->
                    <?php include "includes/tabs/createpkg-tab.php"; ?>

                    <!-- Bookings Tab -->
                    <?php include "includes/tabs/bookings-tab.php"; ?>

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


    <footer class="site-footer">
        <div class="container">
            <div class="logo">
                <img src="assets/img/logo.png" alt="" />
            </div>
            <div class="abt">
                <h1>About</h1>
                <p>Lakbayan Travel and Tours will provide a convenient and
                    premium travel and tour service for local destinations in the
                    Philippines. Lakbayan Travel and Tours offers tourists destinations
                    that they would love and relax in. We also provide essential
                    information to clients so that they are familiar with the culture of
                    their chosen places.</p>
            </div>
            <div class="quick-links">
                <h1>Quick Links</h1>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="destinations.php">Destinations</a></li>
                    <li><a href="packages.php">Packages</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </div>
            <div class="soc-med">
                <h1>Contact Us</h1>
                <div class="contact">
                    <div class="info">
                        <span><i class="fas fa-phone-alt"></i></span>
                        <p>0961 285 3038</p>
                    </div>
                    <div class="info">
                        <span><i class="fas fa-map-marker-alt"></i></span>
                        <p>Manila, Philippines</p>
                    </div>
                </div>

                <div class="icons">
                    <a href="facebook.com"><i class="fab fa-facebook-f"></i></a>
                    <a href="twitter.com"><i class="fab fa-twitter"></i></a>
                    <a href="instagram.com"><i class="fab fa-instagram"></i></a>
                    <a href="youtube.com"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/js/agency-profile.js"></script>

</body>

</html>