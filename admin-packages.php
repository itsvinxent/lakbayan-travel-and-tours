<?php
session_start();
$_SESSION['active'] = 'packages';
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="icon" href="assets/img/logo.png" />
    <title>Administrator | Lakbayan</title>
</head>

<body>
    <?php
    include __DIR__.'/includes/components/admin-nav.php';
    include __DIR__.'/includes/components/accountModal.php';
    include __DIR__.'/backend/connect/dbCon.php';
    include __DIR__.'/backend/package/packages_display.php'
    ?>
    <section class="sections admin-packages" id="admin-packages">
        <div class="banner-half" style="height: 30vh;">
            <video style="height: 30vh;" src="assets/media/waves.mp4" muted loop autoplay preload="auto"></video>
            <div class="text">
                <h1>Administrator Panel</h1>
            </div>
        </div>
        <div class="tab-content pack-active" id="tab-content" style="width: 80%; margin: 2rem auto">
            <div id="package" data-tab-content class="data-tab-content active">
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
                                $locquerystring = "SELECT DISTINCT Province FROM areas_tbl;";
                                $array = array();
                                $query = mysqli_query($conn, $locquerystring);

                                while ($row = mysqli_fetch_assoc($query)) {
                                    $array[] = $row['Province'];
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
                            <input class="avail-inp" type="checkbox" name="a-all" id="a-all" style="display: none;">
                            <label for="a-all"><span>All</span></label>
                        </span>
                        <span>
                            <input class="avail-inp" type="checkbox" name="a-available" id="a-available" style="display: none;">
                            <label for="a-available"><span>Available</span></label>
                        </span>
                        <span>
                            <input class="avail-inp" type="checkbox" name="a-unlisted" id="a-unlisted" style="display: none;">
                            <label for="a-unlisted"> <span>Unlisted</span> </label>
                        </span>
                    </div>
                    <div id="full-table" class="fulltable">
                        <?php
                        $query_string = "SELECT PK.*, FORMAT(PK.packagePrice, 0) AS fresult, DATEDIFF(packageEndDate, packageStartDate) AS packagePeriod, AI.*, AG.agencyName 
                                        FROM  package_tbl AS PK 
                                        INNER JOIN  agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                                        INNER JOIN  packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom 
                                        GROUP BY AI.packageIDFrom";

                        fetch_packagetbl($query_string, $conn, false);
                        mysqli_close($conn);

                        ?>
                    </div>


                </div>

                <script src="assets/js/search-filters.js"></script>
                <script>
                    $('#a-all').prop('checked', true);
                    $('#a-all').next().addClass('active');

                    $('#get-search').on('click', function() {
                        pack_name = $('#package-name').val();
                        pack_location = $('#package-location').val();
                        pack_cat = $('#package-category').val();
                        pack_duration = $('#package-duration').val();
                        postdata['logged_user'] = 'admin';

                        package_data_input();

                        if (count != 0) {
                            filterTimeout(postdata, '#full-table');
                        }
                        count = 4;

                    });

                    $('#reset-search').on('click', function() {
                        postdata = {
                            is_filtering: true,
                            booking: false,
                            logged_user: 'admin'
                        }
                        filterTimeout(postdata, '#full-table');
                    })

                    filterTable(".avail-inp", 'availability', postdata);
                </script>

            </div>

            <div id="edit-package" data-tab-content class="data-tab-content">
                <form id="create-form">
                    <h1>Edit Basic Travel Package Information</h1>
                    <p>Please input the important details about the Travel Package.</p>
                    <div class="details">
                        <div class="left">
                            <div class="row">
                                <span><label for="c-package-name"><span style="color: red;">*</span>Package Name</label></span>
                                <span><input type="text" name="c-package-name" id="c-package-name"></span>
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
                                            $div.append($close);
                                        }

                                        document.querySelectorAll('.remove-cat').forEach(removebtn => {
                                            $(removebtn).on('click', function() {
                                                var remloc = removebtn.parentElement.innerText;
                                                removebtn.parentElement.remove();
                                                loc_array = loc_array.filter(function(letter) {
                                                    return letter !== remloc;
                                                });
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
                                        $locquerystring = "SELECT DISTINCT Province FROM areas_tbl;";
                                        $array = array();
                                        $query = mysqli_query($conn, $locquerystring);

                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $array[] = $row['Province'];
                                        }

                                        for ($i = 0; $i < count($array); $i++) {
                                            echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
                                        }

                                        ?>
                                    </datalist>
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
                                            $div.append($close);
                                        }
                                        document.querySelectorAll('.remove-loc').forEach(removebtn => {
                                            $(removebtn).on('click', function() {
                                                var remloc = removebtn.parentElement.innerText;
                                                removebtn.parentElement.remove();
                                                loc_array = loc_array.filter(function(letter) {
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
                                    <input type="file" name="featured-img" id="featured-img" class="inputfile" accept="image/*" style="display: none;">
                                    <label id="label-featured" for="featured-img">
                                        <div class="upload-btn">
                                            <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                                        </div>
                                    </label>
                                    <div class="uploaded" style="display: none;">
                                        <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                                    </div>
                                    <p style="font-size: 12px;">Featured Photo</p>
                                    <input type="hidden" name="" value="Featured Photo">
                                </span>
                                <span style="text-align: center;">
                                    <input type="file" name="img1" id="img1" class="inputfile" accept="image/*" style="display: none;">
                                    <label id="label-img1" for="img1">
                                        <div class="upload-btn">
                                            <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                                        </div>
                                    </label>
                                    <div class="uploaded" style="display: none;">
                                        <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                                    </div>
                                    <p style="font-size: 12px;">Image 1</p>
                                    <input type="hidden" name="" value="Image 1">
                                </span>
                                <span style="text-align: center;">
                                    <input type="file" name="img2" id="img2" class="inputfile" accept="image/*" style="display: none;">
                                    <label id="label-img2" for="img2">
                                        <div class="upload-btn">
                                            <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                                        </div>
                                    </label>
                                    <div class="uploaded" style="display: none;">
                                        <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                                    </div>
                                    <p style="font-size: 12px;">Image 2</p>
                                    <input type="hidden" name="" value="Image 2">
                                </span>
                                <span style="text-align: center;">
                                    <input type="file" name="img3" id="img3" class="inputfile" accept="image/*" style="display: none;">
                                    <label id="label-img3" for="img3">
                                        <div class="upload-btn">
                                            <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                                        </div>
                                    </label>
                                    <div class="uploaded" style="display: none;">
                                        <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                                    </div>
                                    <p style="font-size: 12px;">Image 3</p>
                                    <input type="hidden" name="" value="Image 3">
                                </span>
                                <span style="text-align: center;">
                                    <input type="file" name="img4" id="img4" class="inputfile" accept="image/*" style="display: none;">
                                    <label id="label-img4" for="img4">
                                        <div class="upload-btn">
                                            <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                                        </div>
                                    </label>
                                    <div class="uploaded" style="display: none;">
                                        <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                                    </div>
                                    <p style="font-size: 12px;">Image 4</p>
                                    <input type="hidden" name="" value="Image 4">
                                </span>
                                <span style="text-align: center;">
                                    <input type="file" name="img5" id="img5" class="inputfile" accept="image/*" style="display: none;">
                                    <label id="label-img5" for="img5">
                                        <div class="upload-btn">
                                            <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                                        </div>
                                    </label>
                                    <div class="uploaded" style="display: none;">
                                        <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                                    </div>
                                    <p style="font-size: 12px;">Image 5</p>
                                    <input type="hidden" name="" value="Image 5">
                                </span>

                            </div>
                        </div>
                    </div>
                    <hr><br>
                    <h1>Edit Availability</h1>
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
                                    <input type="datetime-local" name="resdate" placeholder="Select Booking/Cancellation Cut-off" />
                                </span>
                            </div>
                            <div class="row three">
                                <span>Age Limit</span>
                                <span><input type="number" name="" id="" placeholder="Minimum Age" min="1"></span>
                                <span><input type="number" name="" id="" placeholder="Maximum Age"></span>
                            </div>
                            <div class="row three">
                                <span>Participant Limit</span>
                                <span><input type="number" name="" id="" placeholder="Minimum #" min="1"></span>
                                <span><input type="number" name="" id="" placeholder="Maximum #"></span>
                            </div>
                        </div>
                        <div class="right">
                            <div class="date-display" id="date-display" style="pointer-events: none;"></div>
                        </div>
                    </div>
                    <hr><br>
                    <h1>Edit Pricing</h1>
                    <p>Setup various Pricing options for the Travel Package.</p>
                    <div class="details">
                        <div class="left price-fixed">

                            <div class="row">
                                <span>Pricing Method</span>
                                <span>
                                    <select name="c-price-method" id="c-price-method">
                                        <option value="fixed">Fixed Pricing</option>
                                        <option value="person">Priced by Participant Type</option>
                                    </select>
                                </span>
                            </div>

                            <div class="row desc" id="row-base">
                                <span>Base Price</span>
                                <span>
                                    <input type="number" name="" id="" placeholder="PHP" min="1">
                                    <span style="font-size: 12px; text-align: justify;">
                                        <p>The amount to be inputted would be the fixed price of the Package.</p>
                                    </span>
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
                                    } else {
                                        $('#row-var').css("display", "none");
                                        $('#row-base').css("display", "grid");
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
                                            <input id="partial-switch" type="checkbox" class="switch__input" checked>
                                            <span class="slider-circle"></span>
                                        </label>
                                    </span>
                                </div>
                                <div class="row-setting" style="display: grid; grid-template-rows: .3fr .3fr; margin-top: 1rem;">
                                    <div id="radio-div">
                                        Set Partial Payment by:
                                        <span>
                                            <span style=" display: grid; grid-template-columns: .1fr .4fr; align-items: center;">
                                                <input type="radio" name="partial-method" id="percentage" checked>
                                                <label for="percentage" style="padding-left: 5px;">Percentage</label>
                                            </span>
                                            <span style=" display: grid; grid-template-columns: .1fr .4fr; align-items: center;">
                                                <input type="radio" name="partial-method" id="amount">
                                                <label for="amount" style="padding-left: 5px;">Exact Amount</label>
                                            </span>
                                        </span>
                                    </div>
                                    <div style="margin-top: .6rem; display: grid; grid-template-rows: .2fr .2fr;">
                                        <span id="partial-label">Input the Percentage</span>
                                        <span>
                                            <input type="number">
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
                </form>
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
                <p>
                    Lakbayan Travel and Tours will provide a convenient and
                    premium travel and tour service for local destinations in the
                    Philippines. Lakbayan Travel and Tours offers tourists destinations
                    that they would love and relax in. We also provide essential
                    information to clients so that they are familiar with the culture of
                    their chosen places.
                </p>
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

    <script>
        $(function() {
            $(document).scroll(function() {
                var $nav = $("._nav");
                $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="assets/js/agency-profile.js"></script>

</body>

</html>