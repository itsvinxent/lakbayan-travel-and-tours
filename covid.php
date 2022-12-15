<?php
session_start();
$_SESSION['active'] = 'map';
if (isset($_SESSION['isLoggedIn']) == false) {
    $_SESSION['isLoggedIn'] = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/mapping.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/footer.css">

    <!-- Heat Map Components -->

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="assets/img/logo.png" />
    <title>Lakbay Map | Lakbayan Travels and Tours</title>
</head>

<body>
    <?php 
        include __DIR__.'/includes/components/nav.php';
        include __DIR__.'/includes/components/accountModal.php';
    ?>
    <section class="sections mapping" id="interactive-map" style="margin-top: 4rem;">
        <!-- <div class="banner-half">
            <video src="assets/media/arch.mp4" muted loop autoplay preload="auto"></video>
            <div class="text">
                <h1>Lakbayan Map</h1>
                <h2>An interactive map containing COVID-19 Information.</h2>
            </div>
        </div> -->

        <div class="map-container">
            <div id="map"></div>
            <div class="map-content">
                <div id="right-container" class="content">
                    <div class="main" style="display: none;">
                        <div class="top">
                            <span>
                                <h1 id="city-name"></h1>
                                <h2 id="region"></h2>
                            </span>
                        </div>
                        <br>

                        <div class="card-container" id="dashboard-container">
                            <div class="card-wrapper active-cases">
                                <h3>Active Cases</h3>
                                <span>
                                    <h2 id="active"></h2>
                                    <p id="newcases"></p>
                                </span>
                                <img src="assets/img/activecases.png" alt="">
                            </div>
                            <div class="card-wrapper recovery">
                                <h3>Recoveries</h3>
                                <span>
                                    <h2 id="recovery"></h2>
                                    <p id="recoveryrate"></p>
                                </span>
                                <img src="assets/img/recoveries.png" alt="">
                            </div>

                            <div class="card-wrapper death">
                                <h3>Deaths</h3>
                                <span>
                                    <h2 id="deaths"></h2>
                                    <p id="deathrate"></p>
                                </span>
                                <img src="assets/img/deaths.png" alt="">
                            </div>

                            <div class="card-wrapper total">
                                <h3>Total Cases</h3>
                                <span>
                                    <h2 id="totalcases"></h2>
                                </span>
                                <img src="assets/img/totalcases.png" alt="">
                            </div>

                        </div>

                        <div id="requirements">

                        </div>
                    </div>
                    <div id="no-content" style="display: flex; align-items:center; justify-content: center;">
                        <p style="text-align: center; padding: 36vh 0;">Please select a location in the map.</p>
                    </div>
                </div>


            </div>
        </div>

    </section>

    <!-- <script type="text/javascript" src="assets/js/geochart.js"></script>
      <script type="text/javascript" src="assets/js/geojson/provinces_1.js"></script>
      <script type="text/javascript" src="assets/js/geojson/provinces_2.js"></script> -->

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

    <script type="text/javascript" src="assets/js/geojson/negros.js"></script>
    <script type="text/javascript" src="assets/js/heatmap.js"></script>

    <script>
        $(function() {
            var $nav = $("._nav");
            $nav.toggleClass("scrolled", true);
        });
    </script>

</body>

</html>