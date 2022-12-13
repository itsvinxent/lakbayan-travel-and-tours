<?php
session_start();
$_SESSION['active'] = 'trips';

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
    include 'includes/components/admin-nav.php';
    include 'includes/components/accountModal.php';
    include 'backend/connect/dbCon.php';
    include 'backend/package/packages_display.php'
    ?>
    <section class="sections admin-trips" id="admin-trips">
        <div class="banner-half">
            <video src="assets/media/waves.mp4" muted loop autoplay preload="auto"></video>
            <div class="text">
                <h1>Administrator Panel</h1>
            </div>
        </div>

        <div class="tab-content" style="overflow: unset; box-shadow: none; background-color: unset; width: 80%; margin: 2rem auto">
            <div id="package" data-tab-content class="data-tab-content booking active">
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
                                  INNER JOIN  package_tbl AS PK ON IQ.packageID = PK.packageID";
                        fetch_bookingtbl($query_string, $conn);
                        mysqli_close($conn);
                        ?>
                    </div>

                </div>

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
                    bookingpostdata['logged_user'] = 'admin';

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
                        logged_user: 'admin'
                    }

                    filterTimeout(bookingpostdata, '#fullb-table');
                });

                // Transaction Status Filter
                filterTable(".stat-inp", 'status', bookingpostdata)
            </script>
        </div>

        <!-- Edit Booking Modal -->
        <div class="bmodal-container" id="b1modal_container">
            <div class="booking-modal">
                <h1>Edit Booking Information</h1>
                <form action="backend/admin/trips_update.php" method="POST">
                    <input type="hidden" name="trip_id" id="trip_id">
                    <input type="hidden" name="euser_id" id="euser_id">
                    <input id="efname" type="text" name="efname" placeholder="First Name" required />
                    <input id="elname" type="text" name="elname" placeholder="Last Name" required />
                    <input id="eemail" type="email" name="eemail" placeholder="Email" required />
                    <input id="enumber" type="text" name="enumber" placeholder="Contact Number" required />
                    <select name="epackage" aria-placeholder="Package" id="epackage" required>
                        <option value="tri-city">Tri-City Exclusive Day Tour</option>
                        <option value="lakawon">Lakawon Island Day Tour</option>
                        <option value="campuestohan">Campuestohan Highland Resort</option>
                        <option value="ilaya">Bacolod Ilaya Resort</option>
                        <option value="ruins">The Ruins Day Tour</option>
                    </select>
                    <input id="estartdate" type="datetime-local" class="datepickr" name="eresdate" placeholder="Select Starting Date" />
                    <input id="epersons" type="number" min="1" max="10" name="epersons" placeholder="No. of Persons" required>
                    <input id="edays" type="number" min="1" max="4" name="eduration" placeholder="No. of Days" required>
                    <textarea name="emsg" id="emsg" rows="10" placeholder="Any other messages? (100 characters maximum)"></textarea>

                    <div class="buttons">
                        <button id="modalLogin" class="modal-login">Save Changes</button>
                        <a id="modalEClose" class="btn">Close</a>
                    </div>
                </form>
            </div>
            <script>
                // const eopen = document.getElementById('modalEOpen');
                const eopeners = Array.from(document.getElementsByClassName('edit-btn'));
                const emodal_container = document.getElementById('b1modal_container');
                const eclose = document.getElementById('modalEClose');

                eopeners.forEach(eopen => {
                    eopen.addEventListener('click', function handleClick(event) {
                        emodal_container.classList.add('show');

                        $tr = $(this).closest('tr');

                        var data = $tr.children('td').map(function() {
                            return $(this).text();
                        }).get();
                        console.log(data);

                        $('#trip_id').val(data[0]);
                        $('#euser_id').val(data[1]);
                        $('#efname').val(data[2]);
                        $('#elname').val(data[3]);
                        $('#eemail').val(data[4]);
                        $('#enumber').val(data[5]);
                        $('#epersons').val(data[6]);
                        $('#estartdate').val(data[7]);
                        $('#edays').val(data[8]);
                        $('textarea#emsg').val(data[9]);
                        $('#epackage').val(data[10]);

                    });
                });

                eclose.addEventListener('click', () => {
                    emodal_container.classList.remove('show');
                })
            </script>
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
    <script>
        var curdate = document.getElementById('estartdate').value;
        console.log(curdate);
        flatpickr("input[type=datetime-local]", {
            dateFormat: "D, M d Y",
            positionElement: ".booking-modal",
            static: true
        });
    </script>

</body>

</html>