<?php
session_start();
$_SESSION['active'] = 'map';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/modal.css">

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
        include 'includes/components/nav.php';
        include 'includes/components/accountModal.php';
    ?>
    <section class="sections mapping" id="interactive-map">
        <div class="banner-half">
            <video src="assets/media/arch.mp4" muted loop autoplay preload="auto"></video>
            <div class="text">
                <h1>Lakbayan Map</h1>
                <h2>An interactive map containing COVID-19 Information.</h2>
            </div>
        </div>

        <div class="map-container">
            <div id="map"></div>
            <div class="map-content">
                <div id="bacolod" style="opacity: 1;" class="content">
                    <div class="top">
                        <span>
                            <h1>Bacolod City</h1>
                            <h2>The City of Smiles</h2>
                        </span>
                        <span class="alert">
                            <h3>COMMUNITY ALERT LEVEL 1</h3>
                            <p>As of July 15, 2022</p>
                        </span>
                    </div>
                    <br>
                    <p class="title">COVID-19 Health and Travel Requirements</p>
                    <p>FULLY VACCINATED INDIVIDUALS</p>
                    <ul>
                        <li>Valid ID</li>
                        <li>Online BacTRAC registration</li>
                    </ul>
                    <p>PARTIALLY / UNVACCINATED INDIVIDUALS</p>
                    <ul>
                        <li>Valid ID</li>
                        <li>Online BacTRAC registration</li>
                        <li>Negative Rapid Antigen Test Result taken from any DOH-accredited laboratories <br> valid within 
                            forty-eight (48) hours prior departure or arrival. 
                        </li>
                    </ul>
                    <p><strong style="font-size: 14px;">NOTE:</strong> Passengers have the option to undergo Rapid Antigen Test upon arrival c/o LGU's account.</p>
                    <br>
                    <p class="title">Negros Occidental Provincial Government Travel Requirements</p>
                    <p>FULLY VACCINATED INDIVIDUALS</p>
                    <ul>
                        <li>S-PaSS Permit (Electronic or Printed Copy)</li>
                        <li>Valid ID</li>
                        <li>Valid Vaccination Card or Certificate</li>
                    </ul>
                    <p>PARTIALLY / UNVACCINATED INDIVIDUALS</p>
                    <ul>
                        <li>S-PaSS Permit (Electronic or Printed Copy)</li>
                        <li>Valid ID</li>
                        <li>Negative Non-reactive Rapid Antigen Test Result taken from any DOH-accredited laboratories valid within 
                            forty-eight (48) hours prior departure or arrival. 
                        </li>
                    </ul>
                </div>
    
                <div id="talisay" style="opacity: 0;" class="content">
                    <div class="top">
                        <span>
                            <h1>Talisay City</h1>
                            <h2>Negros Occidental</h2>
                        </span>
                        <span class="alert">
                            <h3>COMMUNITY ALERT LEVEL 1</h3>
                            <p>As of July 15, 2022</p>
                        </span>
                    </div>
                    <br>
                    <p class="title">Negros Occidental COVID-19 Health and Travel Requirements</p>
                    <p>FULLY VACCINATED INDIVIDUALS</p>
                    <ul>
                        <li>S-PaSS Permit (Electronic or Printed Copy)</li>
                        <li>Valid ID</li>
                        <li>Valid Vaccination Card or Certificate</li>
                    </ul>
                    <p>PARTIALLY / UNVACCINATED INDIVIDUALS</p>
                    <ul>
                        <li>S-PaSS Permit (Electronic or Printed Copy)</li>
                        <li>Valid ID</li>
                        <li>Negative Non-reactive Rapid Antigen Test Result taken from any DOH-accredited laboratories valid within 
                            forty-eight (48) hours prior departure or arrival. 
                        </li>
                        <li>Rapid Antigen Test Result to be conducted by the Province of Negros Occidental free of charge upon arrival.</li>
                    </ul>
                </div>

                <div id="silay" style="opacity: 0;" class="content">
                    <div class="top">
                        <span>
                            <h1>Silay City</h1>
                            <h2>Paris of Negros</h2>
                        </span>
                        <span class="alert">
                            <h3>COMMUNITY ALERT LEVEL 1</h3>
                            <p>As of July 15, 2022</p>
                        </span>
                    </div>
                    <br>
                    <p class="title">Negros Occidental COVID-19 Health and Travel Requirements</p>
                    <p>FULLY VACCINATED INDIVIDUALS</p>
                    <ul>
                        <li>S-PaSS Permit (Electronic or Printed Copy)</li>
                        <li>Valid ID</li>
                        <li>Valid Vaccination Card or Certificate</li>
                    </ul>
                    <p>PARTIALLY / UNVACCINATED INDIVIDUALS</p>
                    <ul>
                        <li>S-PaSS Permit (Electronic or Printed Copy)</li>
                        <li>Valid ID</li>
                        <li>Negative Non-reactive Rapid Antigen Test Result taken from any DOH-accredited laboratories valid within 
                            forty-eight (48) hours prior departure or arrival. 
                        </li>
                        <li>Rapid Antigen Test Result to be conducted by the Province of Negros Occidental free of charge upon arrival.</li>
                    </ul>
                </div>

                <div id="cadiz" style="opacity: 0;" class="content">
                    <div class="top">
                        <span>
                            <h1>Cadiz City</h1>
                            <h2>Negros Occidental</h2>
                        </span>
                        <span class="alert">
                            <h3>COMMUNITY ALERT LEVEL 1</h3>
                            <p>As of July 15, 2022</p>
                        </span>
                    </div>
                    <br>
                    <p class="title">Negros Occidental COVID-19 Health and Travel Requirements</p>
                    <p>FULLY VACCINATED INDIVIDUALS</p>
                    <ul>
                        <li>S-PaSS Permit (Electronic or Printed Copy)</li>
                        <li>Valid ID</li>
                        <li>Valid Vaccination Card or Certificate</li>
                    </ul>
                    <p>PARTIALLY / UNVACCINATED INDIVIDUALS</p>
                    <ul>
                        <li>S-PaSS Permit (Electronic or Printed Copy)</li>
                        <li>Valid ID</li>
                        <li>Negative Non-reactive Rapid Antigen Test Result taken from any DOH-accredited laboratories valid within 
                            forty-eight (48) hours prior departure or arrival. 
                        </li>
                        <li>Rapid Antigen Test Result to be conducted by the Province of Negros Occidental free of charge upon arrival.</li>
                    </ul>
                </div>

                <div id="sipalay" style="opacity: 0;" class="content">
                    <div class="top">
                        <span>
                            <h1>Sipalay City</h1>
                            <h2>Negros Occidental</h2>
                        </span>
                        <span class="alert">
                            <h3>COMMUNITY ALERT LEVEL 1</h3>
                            <p>As of July 15, 2022</p>
                        </span>
                    </div>
                    <br>
                    <p class="title">Negros Occidental COVID-19 Health and Travel Requirements</p>
                    <p>FULLY VACCINATED INDIVIDUALS</p>
                    <ul>
                        <li>S-PaSS Permit (Electronic or Printed Copy)</li>
                        <li>Valid ID</li>
                        <li>Valid Vaccination Card or Certificate</li>
                    </ul>
                    <p>PARTIALLY / UNVACCINATED INDIVIDUALS</p>
                    <ul>
                        <li>S-PaSS Permit (Electronic or Printed Copy)</li>
                        <li>Valid ID</li>
                        <li>Negative Non-reactive Rapid Antigen Test Result taken from any DOH-accredited laboratories valid within 
                            forty-eight (48) hours prior departure or arrival. 
                        </li>
                        <li>Rapid Antigen Test Result to be conducted by the Province of Negros Occidental free of charge upon arrival.</li>
                    </ul>
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
            $(document).scroll(function() {
                var $nav = $("._nav");

                $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
            });
        });
    </script>

</body>

</html>