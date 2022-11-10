<?php
session_start();
// $_SESSION['active'] = 'packages';
// if (isset($_SESSION['utype'])) {
//     if ($_SESSION['utype'] == 'user') {
//         header("location: index.php");
//         exit;
//     }
// } else {
//     header("location: index.php");
//     exit;
// }
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
                    <li data-tab-target=".content-verification" class="tab sub">
                        <img src="https://img.icons8.com/plasticine/25/000000/verified-account.png" />
                        Verifications
                    </li>
                    <li data-tab-target="#package" class="tab" style="margin-bottom: 5px;" id="pack-active">
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

                                    $('#img-pic').attr('src', 'assets/img/' + data[14]);
                                    $('#fname').val(data[1]);
                                    $('#lname').val(data[2]);
                                    $('#email').val(data[3]);
                                    $('#password').val(data[4]);
                                    $('#pass').val(data[4]);
                                    $('#utype').val(data[5]);
                                    $('#bday').val(data[6]);
                                    $('#gender').val(data[7]);
                                    $('#age').val(data[8]);
                                    $('#address').val(data[9]);
                                    $('#nationality').val(data[10]);
                                    $('#race').val(data[11]);
                                    $('#religion').val(data[12]);
                                    $('#contact').val(data[13]);
                                    $('#picturefile').val(data[14]);
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

                    <!-- Packages List Tab -->
                    <div id="package" data-tab-content class="data-tab-content">
                        <div class="package-search component">
                            <div class="name">
                                <span><label for="package-name">Package Name</label></span>
                                <span><input class="package-property" type="search" name="package-name" id="package-name" placeholder="Enter Package Name"></span>
                            </div>
                            <div class="dur">
                                <span><label for="package-duration">Duration</label></span>
                                <span><input type="number" name="package-duration" id="package-duration" min="1" max="14" placeholder="Enter Number of Days (1-14)"></span>
                            </div>
                            <div class="cat">
                                <span><label for="package-category">Category</label></span>
                                <span>
                                    <select name="package-category" id="package-category">
                                        <option value="" disabled selected hidden style="opacity: .5;">Select a Category</option>
                                        <option value="beaches">Beaches and Resorts</option>
                                        <option value="mountains">Mountains</option>
                                        <option value="islands">Islands</option>
                                        <option value="animals">Animal Life</option>
                                        <option value="recreation">Recreation</option>
                                        <option value="historical">Historical Landmarks</option>
                                    </select>
                                </span>
                            </div>
                            <div class="loc">
                                <span><label for="package-location">Location</label></span>
                                <span class="loc-search">
                                    <!-- <input type="text" name="package-location" id="package-location" placeholder="Enter a Location in the Philippines">
                                <div class="hints" style="max-height: 200px; overflow-y: scroll;"></div>
                                <div class="empty-hints"><span>No Results</span></div>
                                <div class="loading-hints"><span style="text-align: center; align-items:center;"><img src="assets/img/locsearchloading.gif" alt=""></span></div> -->
                                    <input type="text" name="package-location" id="package-location" placeholder="Enter a Location in the Philippines" list="sample" />
                                    <datalist id="sample">
                                        <?php
                                        $locquerystring = "SELECT DISTINCT City FROM areas_tbl;";
                                        $array = array();
                                        $query = mysqli_query($conn, $locquerystring);

                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $array[] = $row['City'];
                                        }

                                        for ($i = 0; $i < count($array); $i++) {
                                            echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
                                        }

                                        ?>
                                    </datalist>
                                </span>

                            </div>

                            <div class="buttons">
                                <span><button id="get-search">Search</button></span>
                                <span><button id="reset-search">Reset</button></span>
                            </div>
                        </div>


                        <div class="main-content component" style="margin-top: 10px;">
                            <div class="availability-filter">
                                <span>
                                    <input class="avail-inp" type="radio" name="avail-fil" value="a-all" id="a-all" style="display: none;">
                                    <label for="a-all"><span>All</span></label>
                                </span>
                                <span>
                                    <input class="avail-inp" type="radio" name="avail-fil" value="a-available" id="a-available" style="display: none;">
                                    <label for="a-available"><span>Available</span></label>
                                </span>
                                <span>
                                    <input class="avail-inp" type="radio" name="avail-fil" value="a-unlisted" id="a-unlisted" style="display: none;">
                                    <label for="a-unlisted"> <span>Unlisted</span> </label>
                                </span>
                            </div>
                            <div id="full-table" class="fulltable">
                                <?php
                                $query_string = "SELECT PK.*, FORMAT(PK.packagePrice, 0) AS fresult, DATEDIFF(packageEndDate, packageStartDate) AS packagePeriod, AI.*, AG.agencyName 
                                FROM traveldb.package_tbl AS PK 
                                INNER JOIN traveldb.agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                                INNER JOIN traveldb.packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom 
                                WHERE PK.is_deleted = 0
                                GROUP BY AI.packageIDFrom";

                                fetch_packagetbl($query_string, $conn, false);

                                ?>
                            </div>
                        </div>
                        <!-- Delete Travel Package Modal -->
                        <div class="modal-container" id="dmodal_container">
                            <div class="user-modal">
                                <h1>Confirmation</h1>
                                <p>You are about to <strong>delete</strong> a Travel Package. By doing this, all of the related transactions for this Travel Package will be cancelled/delete as well. Type in "I Understand" to confirm. </p>
                                <br><input type="text" name="confirm" id="confirm" placeholder="I Understand"><br>
                                <form action="" method="POST" id="del-action">
                                    <div class="buttons">
                                        <button type="submit" id="modalDelete" class="modal-login">Delete Account</button>
                                        <a id="modalClose" class="btn">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <script src="assets/js/search-filters.js"></script>
                        <script>
                            $('#a-all').prop('checked', true);
                            $('#a-all').next().addClass('active');

                            postdata['logged_user'] = 'admin';

                            $('#get-search').on('click', function() {
                                pack_name = $('#package-name').val();
                                pack_location = $('#package-location').val();
                                pack_cat = $('#package-category').val();
                                pack_duration = $('#package-duration').val();

                                package_data_input();

                                if (count != 0) {
                                    filterTimeout(postdata, '#full-table');
                                }
                                count = 4;

                            });

                            $('#reset-search').on('click', function() {
                                postdata = {
                                    is_filtering: true,
                                    logged_user: 'admin'
                                }

                                filterTimeout(postdata, '#full-table');
                            })

                            filterTable(".avail-inp", 'availability', postdata);

                            // const eopen = document.getElementById('modalEOpen');
                            const dopeners = Array.from(document.getElementsByClassName('delete-btn'));
                            const dmodal_container = document.getElementById('dmodal_container');
                            const dclose = document.getElementById('modalClose');
                            const form = document.getElementById('del-action');
                            const confirm = document.getElementById('confirm')

                            dopeners.forEach(dopen => {
                                dopen.addEventListener('click', function handleClick(event) {
                                    dmodal_container.classList.add('show');

                                    $tr = $(this).closest('tr');

                                    var data = $tr.children('td').map(function() {
                                        return $(this).text();
                                    }).get();

                                    form.action = "backend/package/package_delete.php?id=" + data[1]


                                });
                            });

                            document.getElementById('modalDelete').disabled = true;
                            confirm.addEventListener('input', function() {
                                if (this.value == "I Understand") {
                                    document.getElementById('modalDelete').disabled = false;
                                } else {
                                    document.getElementById('modalDelete').disabled = true;
                                }
                            });

                            dclose.addEventListener('click', () => {
                                dmodal_container.classList.remove('show');
                            });
                        </script>

                    </div>

                    <!-- Create Packages Tab -->
                    <div id="create-package" data-tab-content class="data-tab-content">
                        <form id="create-form" action="backend\package\package_add.php" method="POST" enctype="multipart/form-data">
                            <h1>Basic Travel Package Information</h1>
                            <p>Please input the important details about the Travel Package.</p>
                            <div class="details">
                                <div class="left">
                                    <div class="row">
                                        <span><label for="c-package-name"><span style="color: red;">*</span>Package Name</label></span>
                                        <span><input type="text" name="c-package-name" id="c-package-name" required></span>
                                    </div>
                                    <div class="row desc">
                                        <span><label for="c-package-desc"><span style="color: red;">*</span>Description</label></span>
                                        <span><textarea name="c-package-desc" id="c-package-desc" cols="30" rows="10"></textarea></span>
                                    </div>
                                    <div class="row">
                                        <span><label for="c-package-category"><span style="color: red;">*</span>Category</label></span>
                                        <span style="display: flex; align-items: center; margin-right: 0;">
                                            <!-- <input type="text" name="package-categories" id="package-categories" placeholder="Select a Category" list="cat-list" /> -->
                                            <select name="c-package-category" id="c-package-category">
                                                <!-- <datalist id="cat-list"> -->
                                                <option value="" disabled selected hidden style="opacity: .5;">Select a Category</option>
                                                <option value="beaches">Beaches and Resorts</option>
                                                <option value="mountains">Mountains</option>
                                                <option value="islands">Islands</option>
                                                <option value="animals">Animal Life</option>
                                                <option value="recreation">Recreation</option>
                                                <option value="historical">Historical Landmarks</option>
                                            </select>
                                            <input type="hidden" name="hidden-categories" id="hidden-categories" required></input>
                                            <!-- </datalist> -->
                                            <span id="add-cat" style="margin-left: 10px; cursor: pointer; display: none;"><i class="fas fa-plus"></i></span>

                                        </span>
                                        <span id="selected-cat-container" style="display:flex; justify-content: flex-end;grid-column: 1 / 3; text-align: unset; margin-right: 0;"></span>

                                        <script>
                                            var cat_array = [];
                                            var $catValue;
                                            $('#c-package-category').on('change', function() {
                                                $('#add-cat').css("display", "block");
                                                $catValue = $('#c-package-category option:selected').text();
                                            })

                                            $('#add-cat').on('click', function(e) {
                                                $('#c-package-category').val('');
                                                $(this).css("display", "none");

                                                if ((cat_array.length < 3) && (!cat_array.includes($catValue))) {
                                                    cat_array.push($catValue);
                                                    var $div = $("<div>", {
                                                        "class": "selected-loc",
                                                        "text": $catValue
                                                    });
                                                    // $div.click(function(){ /* ... */ });
                                                    $("#selected-cat-container").append($div);

                                                    var $close = $("<i>", {
                                                        "class": "fas fa-times remove-cat",
                                                        "style": "margin-left: 10px; font-size: 12px; cursor: pointer;"
                                                    })
                                                    document.getElementById("hidden-categories").value = cat_array;
                                                    $div.append($close);

                                                }

                                                document.querySelectorAll('.remove-cat').forEach(removebtn => {
                                                    $(removebtn).on('click', function() {
                                                        var remloc = removebtn.parentElement.innerText;
                                                        removebtn.parentElement.remove();
                                                        cat_array = cat_array.filter(function(letter) {


                                                            document.getElementById("hidden-categories").value = cat_array;


                                                            return letter !== remloc;
                                                        });

                                                        console.log(remloc);
                                                    });
                                                });

                                            });
                                        </script>

                                    </div>

                                    <div class="row" id="location-row">
                                        <span><label for="c-package-loc"><span style="color: red;">*</span>Locations</label></span>
                                        <span style="display: flex; align-items: center; margin-right: 0;">
                                            <input type="text" name="package-locations" id="package-locations" placeholder="Enter a Location in the Philippines" list="sample" />
                                            <datalist id="sample">
                                                <?php
                                                $locquerystring = "SELECT DISTINCT City FROM areas_tbl;";
                                                $array = array();
                                                $query = mysqli_query($conn, $locquerystring);

                                                while ($row = mysqli_fetch_assoc($query)) {
                                                    $array[] = $row['City'];
                                                }

                                                for ($i = 0; $i < count($array); $i++) {
                                                    echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
                                                }

                                                ?>
                                            </datalist>
                                            <input type="hidden" name="hidden-location" id="hidden-location"></input>
                                            <span id="add-loc" style="margin-left: 10px; cursor: pointer; display: none;"><i class="fas fa-plus"></i></span>

                                        </span>

                                        <span id="selected-loc-container" style="display:flex; justify-content: flex-end;grid-column: 1 / 3; text-align: unset; margin-right: 0;">

                                        </span>
                                        <script>
                                            var $currentVal;
                                            var loc_array = [];
                                            var matchCount = 0;
                                            $('#package-locations').on('input', function(e) {
                                                var $input = $(this),
                                                    val = $input.val();
                                                $currentVal = val
                                                list = $input.attr('list'),
                                                    match = $('#' + list + ' option').filter(function() {
                                                        return ($(this).val() === val);
                                                    });

                                                if (val.length === 0) {
                                                    $('#add-loc').css("display", "none");
                                                } else if (match.length > 0) {
                                                    $('#add-loc').css("display", "block");
                                                } else {
                                                    $('#add-loc').css("display", "none");
                                                }
                                            });

                                            $('#add-loc').on('click', function(e) {
                                                $('#package-locations').val('');
                                                $(this).css("display", "none");

                                                if ((loc_array.length < 3) && (!loc_array.includes($currentVal))) {
                                                    loc_array.push($currentVal);

                                                    var $div = $("<div>", {
                                                        "class": "selected-loc",
                                                        "text": $currentVal
                                                    }, );
                                                    // $div.click(function(){ /* ... */ });
                                                    $("#selected-loc-container").append($div);

                                                    var $close = $("<i>", {
                                                        "class": "fas fa-times remove-loc",
                                                        "style": "margin-left: 10px; font-size: 12px; cursor: pointer;"
                                                    })

                                                    document.getElementById("hidden-location").value = loc_array;
                                                    $div.append($close);
                                                }
                                                document.querySelectorAll('.remove-loc').forEach(removebtn => {
                                                    $(removebtn).on('click', function() {
                                                        var remloc = removebtn.parentElement.innerText;
                                                        removebtn.parentElement.remove();
                                                        loc_array = loc_array.filter(function(letter) {
                                                            document.getElementById("hidden-location").value = loc_array;
                                                            return letter !== remloc;
                                                        });
                                                    });
                                                });

                                            });
                                        </script>

                                    </div>

                                    <div class="row">
                                        <span><label for="c-package-category"><span style="color: red;">*</span>Inclusions</label></span>
                                        <span style="display: flex; align-items: center; margin-right: 0;">
                                            <input type="text" name="package-inclusions" id="package-inclusions" placeholder="Input Package Inclusions">
                                            <input type="hidden" name="hidden-inclusions" id="hidden-inclusions" required></input>
                                            <span id="add-inc" style="margin-left: 10px; cursor: pointer; display: none;"><i class="fas fa-plus"></i></span>

                                        </span>
                                        <span id="selected-inc-container" style="display:flex; justify-content: flex-end;grid-column: 1 / 3; text-align: unset; margin-right: 0;"></span>

                                        <script>
                                            var $currentInc;
                                            var inc_array = [];
                                            $('#package-inclusions').on('input', function(e) {
                                                var $input = $(this),
                                                    val = $input.val();
                                                $currentInc = val;

                                                if (val.length === 0) {
                                                    $('#add-inc').css("display", "none");
                                                } else {
                                                    $('#add-inc').css("display", "block");
                                                }
                                            });

                                            $('#add-inc').on('click', function(e) {
                                                $('#package-inclusions').val('');
                                                $(this).css("display", "none");

                                                if ((inc_array.length < 5) && (!inc_array.includes($currentInc))) {
                                                    inc_array.push($currentInc);

                                                    var $div = $("<div>", {
                                                        "class": "selected-loc",
                                                        "text": $currentInc
                                                    }, );
                                                    // $div.click(function(){ /* ... */ });
                                                    $("#selected-inc-container").append($div);

                                                    var $close = $("<i>", {
                                                        "class": "fas fa-times remove-inc",
                                                        "style": "margin-left: 10px; font-size: 12px; cursor: pointer;"
                                                    })

                                                    document.getElementById("hidden-inclusions").value = inc_array;
                                                    $div.append($close);
                                                }
                                                document.querySelectorAll('.remove-inc').forEach(removebtn => {
                                                    $(removebtn).on('click', function() {
                                                        var remloc = removebtn.parentElement.innerText;
                                                        removebtn.parentElement.remove();
                                                        inc_array = inc_array.filter(function(letter) {
                                                            document.getElementById("hidden-inclusions").value = inc_array;
                                                            return letter !== remloc;
                                                        });
                                                    });
                                                });

                                            });
                                        </script>


                                    </div>
                                </div>
                                <div class="right">
                                    <h3>Travel Package Images</h3>
                                    <div class="upload-container">
                                        <span style="text-align: center;">
                                            <input type="file" name="featured-img" id="featured-img" class="inputfile" accept="image/*" style="display: none;" required>
                                            <label id="label-featured" for="featured-img">
                                                <div class="upload-btn">
                                                    <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                                                </div>
                                            </label>
                                            <div class="uploaded" style="display: none;">
                                                <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                                            </div>
                                            <p class="img-name" style="font-size: 12px;">Featured Photo</p>
                                            <input type="hidden" value="Featured Photo">
                                            <input type="hidden" name="featured-img-name" id="featured-img-name">
                                        </span>
                                        <span style="text-align: center;">
                                            <input type="file" name="additional[]" id="img1" class="inputfile" accept="image/*" style="display: none;" required>
                                            <label id="label-img1" for="img1">
                                                <div class="upload-btn">
                                                    <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                                                </div>
                                            </label>
                                            <div class="uploaded" style="display: none;">
                                                <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                                            </div>
                                            <p class="img-name" style="font-size: 12px;">Image 1</p>
                                            <input type="hidden" value="Image 1">
                                            <input type="hidden" name="img1-name" id="img1-name">
                                        </span>
                                        <span style="text-align: center;">
                                            <input type="file" name="additional[]" id="img2" class="inputfile" accept="image/*" style="display: none;" required>
                                            <label id="label-img2" for="img2">
                                                <div class="upload-btn">
                                                    <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                                                </div>
                                            </label>
                                            <div class="uploaded" style="display: none;">
                                                <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                                            </div>
                                            <p class="img-name" style="font-size: 12px;">Image 2</p>
                                            <input type="hidden" value="Image 2">
                                            <input type="hidden" name="img2-name" id="img2-name">
                                        </span>
                                        <span style="text-align: center;">
                                            <input type="file" name="additional[]" id="img3" class="inputfile" accept="image/*" style="display: none;">
                                            <label id="label-img3" for="img3">
                                                <div class="upload-btn">
                                                    <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                                                </div>
                                            </label>
                                            <div class="uploaded" style="display: none;">
                                                <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                                            </div>
                                            <p class="img-name" style="font-size: 12px;">Image 3</p>
                                            <input type="hidden" value="Image 3">
                                            <input type="hidden" name="img3-name" id="img3-name">
                                        </span>
                                        <span style="text-align: center;">
                                            <input type="file" name="additional[]" id="img4" class="inputfile" accept="image/*" style="display: none;">
                                            <label id="label-img4" for="img4">
                                                <div class="upload-btn">
                                                    <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                                                </div>
                                            </label>
                                            <div class="uploaded" style="display: none;">
                                                <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                                            </div>
                                            <p class="img-name" style="font-size: 12px;">Image 4</p>
                                            <input type="hidden" value="Image 4">
                                            <input type="hidden" name="img4-name" id="img4-name">
                                        </span>
                                        <span style="text-align: center;">
                                            <input type="file" name="additional[]" id="img5" class="inputfile" accept="image/*" style="display: none;">
                                            <label id="label-img5" for="img5">
                                                <div class="upload-btn">
                                                    <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                                                </div>
                                            </label>
                                            <div class="uploaded" style="display: none;">
                                                <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                                            </div>
                                            <p class="img-name" style="font-size: 12px;">Image 5</p>
                                            <input type="hidden" value="Image 5">
                                            <input type="hidden" name="img5-name" id="img5-name">
                                        </span>

                                    </div>
                                </div>
                            </div>
                            <hr><br>
                            <h1>Availability</h1>
                            <div class="details" style="margin-top: 0; margin-bottom: 2rem;">
                                <div class="left avail">
                                    <!-- <span style="margin-bottom: 1rem;">
                
                                    </span> -->
                                    <p>Please indicate the important dates for the Tour Schedule.</p>

                                    <div class="row">
                                        <span>Tour Dates</span>
                                        <span>
                                            <input id="tourduration" type="date-local" name="resdate" placeholder="Select Tour Start" />
                                        </span>
                                    </div>
                                    <div class="row">
                                        <span>Cut-Off</span>
                                        <span>
                                            <input type="datetime-local" id="cutdate" name="cutdate" placeholder="Select Booking/Cancellation Cut-off" />
                                        </span>
                                    </div>
                                    <div class="row three">
                                        <div style="display: flex;">
                                            <span>
                                                Age Limit
                                            </span>
                                            <span class="toggle" style="position: relative;">
                                                <label class="toggleswitch">
                                                    <input id="agelimit-switch" name='isagelimited' type="checkbox" class="switch__input" checked>
                                                    <span class="slider-circle"></span>
                                                </label>
                                            </span>
                                        </div>
                                        <span><input type="number" name="agemin" id="agemin" placeholder="Minimum Age" min="1"></span>
                                        <span><input type="number" name="agemax" id="agemax" placeholder="Maximum Age"></span>
                                    </div>
                                    <script>
                                        $('#agelimit-switch').change(function() {
                                            console.log($('#agemin'));
                                            console.log($('#agemax'));
                                            if ($(this).prop("checked") === true) {
                                                $('#agemin').prop('disabled', false);
                                                $('#agemax').prop('disabled', false);
                                            } else {
                                                $('#agemin').prop('disabled', true);
                                                $('#agemax').prop('disabled', true);

                                                $('#agemin').css('cursor', 'not-allowed');
                                                $('#agemax').css('cursor', 'not-allowed');
                                            }
                                        });
                                    </script>
                                    <div class="row three">
                                        <span>Participant Limit</span>
                                        <span><input type="number" name="headmin" id="headmin" placeholder="Minimum #" min="1"></span>
                                        <span><input type="number" name="headmax" id="headmax" placeholder="Maximum #"></span>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="date-display" id="date-display" style="pointer-events: none;"></div>
                                </div>
                            </div>
                            <hr><br>
                            <h1>Pricing</h1>
                            <p>Setup various Pricing options for the Travel Package.</p>
                            <div class="details">
                                <div class="left price-fixed">

                                    <div class="row" style="align-items: unset;">
                                        <span>Pricing Method</span>
                                        <span>
                                            <select name="c-price-method" id="c-price-method">
                                                <option value="fixed">Fixed Pricing</option>
                                                <option value="person">Priced by Participant Type</option>
                                            </select>
                                            <span style="font-size: 12px; text-align: justify;">
                                                <p id="price-help">The amount to be inputted would be the fixed price of the Package.</p>
                                            </span>
                                        </span>

                                    </div>

                                    <div class="row desc" id="row-base">
                                        <span>Base Price</span>
                                        <span>
                                            <input type="number" name="price-adult" id="price-fixed" placeholder="PHP" min="1">
                                        </span>
                                    </div>

                                    <div class="row-var" id="row-var" style="display: none;">
                                        <div class="row">
                                            <span><label for="c-price-senior"><span style="color: red;">*</span>Price per Senior</label></span>
                                            <span><input type="number" name="c-price-senior" id="c-price-senior" placeholder="PHP"></span>
                                        </div>
                                        <div class="row">
                                            <span><label for="c-price-adult"><span style="color: red;">*</span>Price per Adult</label></span>
                                            <span><input type="number" name="c-price-adult" id="c-price-adult" placeholder="PHP"></span>
                                        </div>
                                        <div class="row">
                                            <span><label for="c-price-child"><span style="color: red;">*</span>Price per Child</label></span>
                                            <span><input type="number" name="c-price-child" id="c-price-child" placeholder="PHP"></span>
                                        </div>
                                    </div>

                                    <script>
                                        $('#c-price-method').change(function() {
                                            if ($(this).val() == 'person') {
                                                $('#row-var').css("display", "grid");
                                                $('#row-base').css("display", "none");
                                                $('#price-help').text("The pricing will vary depending on the age of the participant.")
                                            } else {
                                                $('#row-var').css("display", "none");
                                                $('#row-base').css("display", "grid");
                                                $('#price-help').text('The amount to be inputted would be the fixed price of the Package.')
                                            }
                                        });
                                    </script>
                                </div>
                                <div class="right" style="margin: 0 auto; width: 75%">
                                    <div class="payment-setting" style="display: grid; grid-template-rows: .3fr .5fr;">
                                        <div class="row" style="display: grid; grid-template-columns: 1fr .2fr;">
                                            <span>
                                                Enable Partial Payment
                                            </span>
                                            <span class="toggle" style="position: relative;">
                                                <label class="toggleswitch">
                                                    <input id="partial-switch" name='ispartial' type="checkbox" class="switch__input" checked>
                                                    <span class="slider-circle"></span>
                                                </label>
                                            </span>
                                        </div>
                                        <div class="row-setting" style="display: grid; grid-template-rows: .3fr .3fr; margin-top: 1rem;">
                                            <div id="radio-div">
                                                Set Partial Payment by:
                                                <span>
                                                    <span style=" display: grid; grid-template-columns: .1fr .4fr; align-items: center;">
                                                        <input type="radio" name="partial-method" value="percent" id="percentage" checked>
                                                        <label for="percentage" style="padding-left: 5px;">Percentage</label>
                                                    </span>
                                                    <span style=" display: grid; grid-template-columns: .1fr .4fr; align-items: center;">
                                                        <input type="radio" name="partial-method" value="exact" id="amount">
                                                        <label for="amount" style="padding-left: 5px;">Exact Amount</label>
                                                    </span>
                                                </span>
                                            </div>
                                            <div style="margin-top: .6rem; display: grid; grid-template-rows: .2fr .2fr;">
                                                <span id="partial-label">Input the Percentage</span>
                                                <span>
                                                    <input type="number" name="partial-amount" id="partial-amount">
                                                </span>
                                            </div>
                                        </div>
                                        <script>
                                            $('#partial-switch').change(function() {
                                                if ($(this).prop("checked") === true) {
                                                    $('.row-setting').css("display", "grid");

                                                } else {
                                                    $('.row-setting').css("display", "none");
                                                }
                                            });

                                            $('#radio-div').on("change", "input[name='partial-method']", function() {
                                                console.log("detected")
                                                if ($('#percentage').prop("checked") === true) {
                                                    $('#partial-label').text("Input the Percentage");
                                                    console.log($('#partial-label'))
                                                } else {
                                                    $('#partial-label').text("Input Exact Amount");
                                                    console.log($('#partial-label'))
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>

                            </div>
                            <div style="text-align: right; margin-top: 1rem;">
                                <button type="submit" name="submitpack" class="saveform-btn">Save New Package</button>
                            </div>
                        </form>
                        <script>
                            var reset = document.querySelectorAll('.resetting');
                            var rowdatareq;

                            reset.forEach(r => {
                                $(r).on('click', () => {
                                    // Reset the Form
                                    $('#create-form')[0].reset();
                                    $('#selected-cat-container').empty();
                                    $('#selected-loc-container').empty();
                                    cat_array = [];
                                    loc_array = [];

                                    if (r === document.getElementById('package-create')) {
                                        $('#create-form .saveform-btn').text('Save New Package');
                                        removeupload.forEach(remover => {
                                            removeuploadimg(remover);
                                        })
                                        displayCal.clear();
                                        schedCal.clear();
                                        cutoffCal.clear();
                                    } else {
                                        $('#create-form .saveform-btn').text('Save Changes');
                                        removeupload.forEach(remover => {
                                            removeuploadimg(remover);
                                        })

                                        $tr = $(r).closest('tr');

                                        var data = $tr.children('td').map(function() {
                                            return $(this).text();
                                        }).get();

                                        var packageID = parseInt(data[1]);
                                        console.log(packageID);
                                        $.ajax({
                                            url: 'backend/package/packages_search.php',
                                            method: 'POST',
                                            dataType: 'json',
                                            data: {
                                                is_editing: 'true',
                                                packageID: packageID
                                            },
                                            async: true,
                                            context: this,
                                            success: function(response) {
                                                setDetails(response.details)
                                                setCategory(response.category)
                                                setLocation(response.location)
                                                setDates(response.details)
                                                setImages(response.images)
                                            }
                                        });

                                    }

                                });

                            });

                            function setDetails($row) {
                                // Basic Travel Package Information
                                $("#c-package-name").val($row['packageTitle']);
                                $("#c-package-desc").val($row['packageDescription']);

                                // Availability
                                $("#agemin").val(parseInt($row['packageAgeMin']));
                                $("#agemax").val(parseInt($row['packageAgeMax']));
                                $("#headmin").val(parseInt($row['packagePersonMin']));
                                $("#headmax").val(parseInt($row['packagePersonMax']));


                                // Pricing
                                if (parseInt($row['packagePriceChild']) == '0' && parseInt($row['packagePriceSenior']) == '0') {
                                    $('#row-var').css("display", "none");
                                    $('#row-base').css("display", "grid");

                                    $("#c-price-method").val('fixed');
                                    $("#price-fixed").val(parseInt($row['packagePrice']));
                                } else {
                                    $('#row-var').css("display", "grid");
                                    $('#row-base').css("display", "none");

                                    $("#c-price-method").val('person');
                                    $("#c-price-senior").val(parseInt($row['packagePriceSenior']));
                                    $("#c-price-adult").val(parseInt($row['packagePrice']));
                                    $("#c-price-child").val(parseInt($row['packagePriceChild']));
                                }

                                if ($row['packagePartialType'] != 'NOT') {
                                    $("#partial-switch").prop('checked', true);
                                    $('.row-setting').css("display", "grid");
                                    if ($row['packagePartialType'] === 'PERCENT') {
                                        $("#percentage").prop('checked', true);
                                    } else {
                                        $("#amount").prop('checked', true);
                                    }
                                    $("#partial-amount").val(parseInt($row['packagePartialPrice']));
                                } else {
                                    $("#partial-switch").prop('checked', false);
                                    $('.row-setting').css("display", "none");
                                }

                            }

                            function setCategory(categ) {
                                categ.forEach(cat => {
                                    cat_array.push(cat);
                                    var $div = $("<div>", {
                                        "class": "selected-loc",
                                        "text": cat
                                    });

                                    $("#selected-cat-container").append($div);

                                    var $close = $("<i>", {
                                        "class": "fas fa-times remove-cat",
                                        "style": "margin-left: 10px; font-size: 12px; cursor: pointer;"
                                    })
                                    document.getElementById("hidden-categories").value = cat_array;
                                    $div.append($close);

                                });
                            }

                            function setLocation(locations) {
                                console.log(locations)
                                locations.forEach(loc => {
                                    loc_array.push(loc);
                                    var $div = $("<div>", {
                                        "class": "selected-loc",
                                        "text": loc
                                    });

                                    $("#selected-loc-container").append($div);

                                    var $close = $("<i>", {
                                        "class": "fas fa-times remove-loc",
                                        "style": "margin-left: 10px; font-size: 12px; cursor: pointer;"
                                    })
                                    document.getElementById("hidden-location").value = loc_array;
                                    $div.append($close);

                                });
                            }

                            function setDates(details) {
                                var start_date = new Date(details['packageStartDate']);
                                var end_date = new Date(details['packageEndDate']);
                                var cut_date = new Date(details['packageCutoff']);

                                schedCal.set('minDate', start_date);
                                schedCal.setDate([start_date, end_date], true);

                                cutoffCal.set('minDate', cut_date);
                                cutoffCal.setDate(cut_date, true)

                            }

                            function setImages(images) {
                                let filetext = $("#featured-img-name").prev().prev();

                                $("#featured-img-name").val(images[0])
                                $(filetext).text(images[0]);
                                $(filetext).prev().css("display", "flex");
                                $(filetext).prev().prev().css("display", "none");

                                for (let i = 1; i < images.length; i++) {
                                    let hiddenimgname = "#img" + i + "-name";
                                    filetext = $(hiddenimgname).prev().prev();

                                    $(hiddenimgname).val(images[i])
                                    $(filetext).text(images[i]);
                                    $(filetext).prev().css("display", "flex");
                                    $(filetext).prev().prev().css("display", "none");
                                }

                            }
                        </script>
                    </div>

                    <!-- Bookings Tab -->
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
                                  FROM traveldb.inquiry_tbl AS IQ
                                  INNER JOIN traveldb.user_tbl AS US ON IQ.id_user = US.id
                                  INNER JOIN traveldb.booking_tbl AS BK ON IQ.id = BK.inquiryInfoID 
                                  INNER JOIN traveldb.package_tbl AS PK ON IQ.packageID = PK.packageID";
                                fetch_bookingtbl($query_string, $conn);
                                mysqli_close($conn);
                                ?>
                            </div>

                        </div>
                        <script>
                            $('#s-all').prop('checked', true);
                            $('#s-all').next().addClass('active');

                            bookingpostdata['logged_user'] = 'agency';

                            $('#b-get-search').on('click', function() {
                                pack_name = $('#b-package-name').val();
                                pack_transact = $('#b-package-transact').val();
                                pack_id = $('#b-package-id').val();
                                pack_customer = $('#package-customer').val();

                                booking_data_input();

                                if (count != 0) {
                                    filterTimeout(bookingpostdata, '#fullb-table');
                                }
                                count = 4;

                            });

                            $('#b-reset-search').on('click', function() {
                                bookingpostdata = {
                                    booking: true,
                                    logged_user: 'agency'
                                }

                                filterTimeout(bookingpostdata, '#fullb-table');
                            });

                            // Transaction Status Filter
                            filterTable(".stat-inp", 'status', bookingpostdata)
                        </script>
                    </div>
                    <!-- End of Bookings Tab -->
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