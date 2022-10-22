<?php
session_start();
$_SESSION['active'] = 'packages';
if (isset($_SESSION['utype'])) {
    if ($_SESSION['utype'] == 'user') {
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
    include 'includes/components/admin-nav.php';
    include 'includes/components/accountModal.php';
    include 'backend/connect/dbCon.php';
    include 'backend/package/packages_display.php'
    ?>
    <section class="sections admin-packages" id="admin-packages">
        <div class="banner-half" style="height: 30vh;">
            <video style="height: 30vh;" src="assets/media/waves.mp4" muted loop autoplay preload="auto"></video>
            <div class="text">
                <h1>Administrator Panel</h1>
            </div>
        </div>
        <div class="tab-content" style="overflow: unset; box-shadow: none; background-color: unset; width: 80%; margin: 2rem auto">
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
                        $query_string = "SELECT PK.*, FORMAT(PK.packagePrice, 0) AS fresult,  AI.*, AG.agencyName 
                      FROM traveldb.package_tbl AS PK 
                      INNER JOIN traveldb.agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                      INNER JOIN traveldb.packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom 
                      GROUP BY AI.packageIDFrom";

                        fetch_packagetbl($query_string, $conn, false);
                        mysqli_close($conn);
                        
                        ?>
                    </div>


                </div>
                <script>
                    $(document).ready(function() {
                        $('#a-all').prop('checked', true);
                        $('#a-all').next().addClass('active');

                        var count = 4;
                        var filter_req, filter_timeout;
                        var pack_name, pack_location, pack_cat, pack_duration = 0;
                        var postdata = {
                            is_filtering: true,
                            name: "",
                            location: "",
                            category: "",
                            duration: undefined
                        }

                        function postdata_append(postdata, name, value) {
                            if ((value != undefined) & (value != '') & (value != null)) {
                                postdata[name] = value;
                            } else {
                                delete postdata[name];
                                count--;
                            }
                            return postdata
                        }

                        $('#get-search').on('click', function() {
                            pack_name = $('#package-name').val();
                            pack_location = $('#package-location').val();
                            pack_cat = $('#package-category').val();
                            pack_duration = $('#package-duration').val();

                            postdata = postdata_append(postdata, 'name', pack_name)
                            postdata = postdata_append(postdata, 'location', pack_location)
                            postdata = postdata_append(postdata, 'category', pack_cat)
                            postdata = postdata_append(postdata, 'duration', pack_duration)

                            if (count != 0) {
                                filterTimeout();
                            }
                            count = 4;

                        });

                        $('#reset-search').on('click', function() {
                            postdata = {
                                is_filtering: true,
                            }

                            filterTimeout();
                        })

                        function filterTimeout() {
                            if (filter_timeout) {
                                clearTimeout(filter_timeout);
                            }
                            if (filter_req) {
                                filter_req.abort();
                            }

                            filter_timeout = setTimeout(function() {
                                filterPackages().then(function(data) {
                                    $('#full-table').empty();
                                    $('#full-table').html(data);
                                });
                            }, 500);
                        }

                        function filterPackages() {
                            filter_req = $.ajax({
                                url: 'backend/package/packages_search.php',
                                method: 'POST',
                                data: postdata,
                                async: true,
                                context: this
                            });

                            return filter_req;
                        }

                    });

                    // Availablity Filter
                    $(".avail-inp").change(function() {
                        var checkbox = this;
                        var count = 0,
                            rating = 0;
                        if ($(this).is(":checked"))
                            this.labels[0].classList.remove('active');

                        $(".avail-inp").each(function() {
                            if (this == checkbox & $(checkbox).is(":checked")) {
                                this.labels[0].classList.add('active');
                                count++;
                            } else {
                                $(this).prop('checked', false);
                                this.labels[0].classList.remove('active');
                            }
                        })
                    });
                </script>

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

</body>

</html>