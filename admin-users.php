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
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/profile-edit.css">
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
            <?php include 'backend/admin/user_display.php'; ?>
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
                                <input type="text" id="password" value="" >    
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
                                <select name="gender"  id="gender" required>
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
                    <div class="buttons" style="margin-top: 2rem;">
                        <button type="submit" id="modalLogin" class="modal-login">Save Changes</button>
                        </form>
                        <a id="modalEClose" class="btn">Close</a>
                    </div>

            </div>
            </div>

            <script>
                // const eopen = document.getElementById('modalEOpen');
                const eopeners = Array.from(document.getElementsByClassName('edit-btn'));
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

                        $('#img-pic').attr('src', 'assets/img/'+data[14]);
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
        <div class="modal-container" id="dmodal_container">
            <div class="user-modal">
                <h1>Confirmation</h1>
                <p>You are about to <strong>delete</strong> an account. By doing this, all of this user's transactions will be deleted as well. Type in "I Understand" to confirm. </p>
                <br><input type="text" name="confirm" id="confirm" placeholder="I Understand"><br>
                <form action="" method="POST" id="del-action">
                    <div class="buttons">
                        <button type="submit" id="modalDelete" class="modal-login">Delete Account</button>
                </form>
                <a id="modalDClose" class="btn">Cancel</a>
            </div>

        </div>
        <script>
            // const eopen = document.getElementById('modalEOpen');
            const dopeners = Array.from(document.getElementsByClassName('delete-btn'));
            const dmodal_container = document.getElementById('dmodal_container');
            const dclose = document.getElementById('modalDClose');
            const form = document.getElementById('del-action');
            const confirm = document.getElementById('confirm')

            dopeners.forEach(dopen => {
                dopen.addEventListener('click', function handleClick(event) {
                    dmodal_container.classList.add('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children('td').map(function() {
                        return $(this).text();
                    }).get();

                    form.action = "backend/admin/user_delete.php?id=" + data[0]


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

    <!-- flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $(function() {
            $(document).scroll(function() {
                var $nav = $("._nav");

                $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
            });
        });
    </script>
    <script>
        flatpickr("input[type=datetime-local]", {
            dateFormat: "Y-m-d",
            defaultDate: this.value
        });

        // var inputs = document.querySelectorAll('.inputfile');
        // Array.prototype.forEach.call(inputs, function(input) {
        //     var label = input.nextElementSibling,
        //         labelVal = label.innerHTML;

        //     input.addEventListener('change', function(e) {
        //         // label.style.display = none;
        //         // input.style.display = block;

        //         var fileName = e.target.value.split('\\').pop();
        //         console.log(fileName)
        //         if (fileName)
        //             label.querySelector('span').innerHTML = fileName;
        //         else
        //             // label.innerHTML = labelVal;
        //             label.querySelector('span').innerHTML = labelVal;

        //         display(this);
        //     });
        // });
    </script>
    <script src="assets/js/agency-profile.js"></script>
    <script src="assets/js/imguploadpreview.js"></script>

</body>

</html>