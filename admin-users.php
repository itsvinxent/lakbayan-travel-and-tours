<?php
session_start();
$_SESSION['active'] = 'users';

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
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/footer.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="assets/img/logo.png" />
    <title>Administrator | Lakbayan Travels and Tours</title>
</head>

<body>
    <?php 
        include 'includes/components/admin-nav.php';
        include 'includes/components/accountModal.php';

    ?>
    <section class="sections admin-usr" id="admin-usr">
        <div class="banner-half">
            <video src="assets/media/waves.mp4" muted loop autoplay preload="auto"></video>
            <div class="text">
                <h1>Administrator Panel</h1>
            </div>
        </div>
        <div class="content-users">
            <h1>User Accounts</h1>
            <?php include 'backend/admin/user_display.php';?>
        </div>
        <div class="modal-container" id="bmodal_container">
            <div class="user-modal">
                <h1>Create Account</h1>
                <form action="backend/admin/user_create.php" method="POST">
                    <input id="fname" type="text" name="fname" placeholder="First Name" required/>
                    <input id="lname" type="text" name="lname" placeholder="Last Name" required/>
                    <input type="email" name="email" placeholder="Email" required />
                    <input type="text" name="password" placeholder="Password" required/>
                    <select name="usertype" aria-placeholder="Usertype" id="" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <!-- <input type="text" name="usertype" placeholder="Usertype" required/>  -->
                    <br>
                <div class="buttons">
                    <button id="modalLogin" class="modal-login" >Add</button>
                    <a id="modalBClose" class="btn">Close</a>
                </div>
                </form>
            </div>
            <script>
                const uopen = document.getElementById('modalBOpen');
                const umodal_container = document.getElementById('bmodal_container');
                const uclose = document.getElementById('modalBClose');
            
                uopen.addEventListener('click', () => {
                    umodal_container.classList.add('show');
                })
            
                uclose.addEventListener('click', () => {
                    umodal_container.classList.remove('show');
                })
            </script>
        </div>
        <div class="modal-container" id="emodal_container">
            <div class="user-modal">
                <h1>Edit Account</h1>
                <form action="backend/admin/user_update.php" method="POST">
                    <input type="hidden" name="id" id="user_id">
                    <input id="efname" type="text" name="efname" placeholder="First Name" required/>
                    <input id="elname" type="text" name="elname" placeholder="Last Name" required/>
                    <input id="email" type="email" name="eemail" placeholder="Email" required />
                    <input id="pass" type="text" name="epassword" placeholder="Password" required disabled/> 
                    <select name="eusertype" id="utype" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <br>
                <div class="buttons">
                    <button type="submit" id="modalLogin" class="modal-login">Save Changes</button>
                    </form>
                    <a id="modalEClose" class="btn">Close</a>
                </div>
                
            </div>
            <script>
                // const eopen = document.getElementById('modalEOpen');
                const eopeners = Array.from(document.getElementsByClassName('edit-btn'));
                const emodal_container = document.getElementById('emodal_container');
                console.log(emodal_container);
                const eclose = document.getElementById('modalEClose');
                console.log(eclose)
                
                eopeners.forEach(eopen => {
                    eopen.addEventListener('click', function handleClick(event) {
                        emodal_container.classList.add('show');

                        $tr = $(this).closest('tr');
                        
                        var data = $tr.children('td').map(function() {
                            return $(this).text();
                        }).get();
                        
                        $('#user_id').val(data[0]);
                        $('#efname').val(data[1]);
                        $('#elname').val(data[2]);
                        $('#email').val(data[3]);
                        $('#pass').val(data[4]);
                        $('#utype').val(data[5]);
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

</body>

</html>