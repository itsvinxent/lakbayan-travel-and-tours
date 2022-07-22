<?php
session_start();
$_SESSION['active'] = 'trips';

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
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/modal.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <link rel="icon" href="assets/img/logo.png" />
    <title>Administrator | Lakbayan Travels and Tours</title>
</head>

<body>
    <?php 
        include 'includes/components/admin-nav.php';
        include 'includes/components/accountModal.php';


    ?>
    <section class="sections admin-trips" id="admin-trips">
        <div class="banner-half">
            <video src="assets/media/waves.mp4" muted loop autoplay preload="auto"></video>
            <div class="text">
                <h1>Administrator Panel</h1>
            </div>
        </div>
        <div class="content-users">
            <h1>Booking Inquiries</h1>
            <?php include 'backend/admin/trips_display.php';?>
        </div>
        <div class="bmodal-container" id="bmodal_container">
            <div class="booking-modal">
                <h1>Create Booking Information</h1>
                <form action="backend/admin/trips_create.php" method="POST">  
                <select name="user_id" id="user_id" style="width: 555px;" required>
                    <?php 
                        include 'backend/connect/dbCon.php';
                        $select_query = "SELECT * FROM traveldb.user_tbl; " ;
                        $result = mysqli_query($conn, $select_query);
                        while($row = mysqli_fetch_row($result)){
                        echo "<option value=\"$row[0]\">$row[1] $row[2]</option>";
                        }
                    ?>                
                    <input id="email" type="email" name="email" placeholder="Email" required />
                    <input id="number" type="text" name="number" placeholder="Contact Number" required/>
                    <select name="package" aria-placeholder="Package" id="package" required>
                        <option value="tri-city">Tri-City Exclusive Day Tour</option>
                        <option value="lakawon">Lakawon Island Day Tour</option>
                        <option value="campuestohan">Campuestohan Highland Resort</option>
                        <option value="ilaya">Bacolod Ilaya Resort</option>
                        <option value="ruins">The Ruins Day Tour</option>
                    </select>
                    <input id="startdate" type="datetime-local" class="datepickr" name="resdate" placeholder="Select Starting Date" />
                    <input id="persons" type="number" min="1" max="10" name="persons" placeholder="No. of Persons" required>
                    <input id="days" type="number" min="1" max="4" name="duration" placeholder="No. of Days" required>
                    <textarea name="msg" id="emsg" rows="10" placeholder="Any other messages? (100 characters maximum)"></textarea>

                    <div class="buttons">
                        <button id="modalLogin" class="modal-login" >Save Changes</button>
                        <a id="modalBClose" class="btn">Close</a>
                    </div>
                </form>
            </div>
            <script>
                const topen = document.getElementById('modalBOpen');
                const tmodal_container = document.getElementById('bmodal_container');
                const tclose = document.getElementById('modalBClose');
            
                topen.addEventListener('click', () => {
                    tmodal_container.classList.add('show');
                })
            
                tclose.addEventListener('click', () => {
                    tmodal_container.classList.remove('show');
                })
            </script>
        </div>
        <div class="bmodal-container" id="b1modal_container">
            <div class="booking-modal">
                <h1>Edit Booking Information</h1>
                <form action="backend/admin/trips_update.php" method="POST">  
                    <input type="hidden" name="trip_id" id="trip_id"> 
                    <input type="hidden" name="euser_id" id="euser_id">                 
                    <input id="efname" type="text" name="efname" placeholder="First Name"  required/>
                    <input id="elname" type="text" name="elname" placeholder="Last Name" required/>
                    <input id="eemail" type="email" name="eemail" placeholder="Email" required />
                    <input id="enumber" type="text" name="enumber" placeholder="Contact Number" required/>
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
                        <button id="modalLogin" class="modal-login" >Save Changes</button>
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