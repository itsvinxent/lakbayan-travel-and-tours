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
    include __DIR__.'/includes/components/nav.php';
    ?>

    <?php
    include __DIR__."/../../backend/package/packages_display.php";
    include __DIR__."/../../backend/admin/agency_display.php";
    include __DIR__."/../../backend/admin/user_display.php";
    include __DIR__."/../../backend/connect/dbCon.php";

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
                    <li data-tab-target=".user-acc" class="tab active" id="acc-active">
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
                <div class="tab-content pack-active" id="tab-content">
                    <!-- Account Tab -->
                    <?php include __DIR__."/../../includes/tabs/user-tab.php"; ?>

                    <!-- Verifications Tab -->
                    <?php include __DIR__."/../../includes/tabs/verify-tab.php"; ?>
                    
                    <!-- Packages List Tab -->
                    <?php include __DIR__."/../../includes/tabs/package-tab.php"; ?>

                    <!-- Create Packages Tab -->
                    <?php include __DIR__."/../../includes/tabs/createpkg-tab.php"; ?>

                    <!-- Bookings Tab -->
                    <?php include __DIR__."/../../includes/tabs/bookings-tab.php"; ?>

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