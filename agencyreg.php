<?php
session_start();
$_SESSION['active'] = 'register';
if(isset($_SESSION['isLoggedIn']) == false) {
  $_SESSION['isLoggedIn'] = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Agency Registration</title>

    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/agencyreg.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="assets/img/logo.png">
</head>

<body>

<?php 
    include 'includes/components/nav.php';
    include 'includes/components/accountModal.php';
?>
<!-- FORM FIELD -->

<section>
  <div class="form-container">
      <form id="register-agency" action="backend/auth/signupagency.php" method="POST" enctype="multipart/form-data">
          <div class="form-agency-part">
            <img src="assets/img/Umbrella.png" id="designUmbrella"> 
            <legend>REGISTER YOUR AGENCY NOW 🏖️</legend>

            <label for="aName">Enter Agency Name:</label>
            <input type="text" name="aName" id="aName" required><br>

            <label for="aEmail">Enter Agency Email:</label>
            <input type="text" name="aEmail" id="aEmail" required><br>

            <label for="aAddress">Enter Agency Address:</label>
            <input type="text" name="aAddress" id="aAddress" required><br>

            <label for="aDesc">Enter Agency Description:</label>
            <textarea name="aDesc" id="aDesc" rows="4" required></textarea><br>

            <label for="aPicture">Select Agency Profile Picture</label>
            <input type="file" name="aPicture" id="aPicture" accept="image/gif, image/jpeg, image/png" onchange="prevImage(event)"><br>

            <div class="preview-image-container" id="prev-container">
              <div class="preview-image">
                <img id="prev" src="#" alt="previmage" > 
              </div>
            </div>  

          </div>

          <div class="form-manager-part">
            <img src="assets/img/Palmtree.png" id="backgroundTree"> 
            <legend> 👨 AGENCY MANAGER 👩</legend>

            <label for="aMFName">Enter First Name:</label>
            <input type="text" name="aMFName" id="aMFName" required><br>

            <label for="aMLName">Enter Last Name:</label>
            <input type="text" name="aMLName" id="aMLName" required><br>

            <label for="aMPassword">Enter Password:</label>
            <input type="password" name="aPassword" id="aPassword" required><br>

            <input type="submit" name="submit">
          </div>
      </form>
  </div>
</section>

<script>
var prevImage = function(event) {
  var pcontainer = document.getElementById('prev-container');
  
  if(document.getElementById('aPicture').files.length != 0){
  pcontainer.style.display='block';
  window.setTimeout(function(){
    pcontainer.style.opacity = 1;
    pcontainer.style.transform = 'translateY(0)';
  }, 100);
  } 
  
  if (document.getElementById('aPicture').files.length === 0){
    pcontainer.style.opacity = 0;
    pcontainer.style.transform = 'translateY(-50px)';

    window.setTimeout(function(){
    pcontainer.style.display='none';
   
    }, 400);
  }else {
    var showselected = document.getElementById('prev');
    showselected.src = URL.createObjectURL(event.target.files[0]);
  }
  
};
</script>

<!-- Footer section -->

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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