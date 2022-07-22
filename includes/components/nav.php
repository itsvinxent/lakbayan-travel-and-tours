<nav class="_nav">
  <input type="checkbox" id="check" />
  <label for="check" class="checkbtn">
    <i class="fas fa-bars"></i>
  </label>
  <label for="check" class="closebtn">
    <i class="fas fa-times"></i>
  </label>
  <label class="logo"><img 
    <?php 
      if ($_SESSION['active'] == 's-dest' || $_SESSION['active'] == 's-pack') { 
        echo 'src="../../assets/img/logo.png"';
      } else {
        echo 'src="assets/img/logo.png"';
      }
    ?>>Lakbayan Travel and Tours</label>
  <ul>
    <li id="goto"><a 
            <?php if ($_SESSION['active'] == 'index') {
              echo 'class="active logp" href="#"';
            } elseif ($_SESSION['active'] == 's-dest' || $_SESSION['active'] == 's-pack') {
              echo 'href="../../index.php"';
            } else {
              echo 'href="index.php"';
            } ?>>Home</a></li>
    <li><a <?php 
            if ($_SESSION['active'] == 'dest') {
              echo 'class="active" href="#"';
            } 
            if ($_SESSION['active'] == 's-dest') {
              echo 'class="active" href="../../destinations.php"';
            } 
            if ($_SESSION['active'] == 's-dest' || $_SESSION['active'] == 's-pack') {
              echo 'href="../../destinations.php"';
            }else {
              echo 'href="destinations.php"';
            } ?>>Destinations</a></li>
    <li><a <?php 
            if ($_SESSION['active'] == 'pack') {
              echo 'class="active" href="#"';
            } 
            if ($_SESSION['active'] == 's-pack') {
              echo 'class="active" href="../../packages.php"';
            } 
            if ($_SESSION['active'] == 's-dest' || $_SESSION['active'] == 's-pack') {
              echo 'href="../../packages.php"';
            } else {
              echo 'href="packages.php"';
            }
            ?>>Packages</a></li>
    <li><a <?php if ($_SESSION['active'] == 'map') {
              echo 'class="active" href="#"';
            } elseif ($_SESSION['active'] == 's-dest' || $_SESSION['active'] == 's-pack') {
              echo 'href="../../covid.php"';
            } else {
              echo 'href="covid.php"';
            } ?>>Covid-19</a></li>
    <li><a <?php if ($_SESSION['active'] == 'about') {
              echo 'class="active" href="#"';
            } elseif ($_SESSION['active'] == 's-dest' || $_SESSION['active'] == 's-pack') {
              echo 'href="../../about.php"';
            } else {
              echo 'href="about.php"';
            } ?>>About Us</a></li>
    <?php
    if ($_SESSION['active'] == 'index') {
      if (isset($_SESSION['isLoggedIn'])) {
        if ($_SESSION['isLoggedIn'] == false) {
          echo "<li id='goto'> <a class='logn'>";
        } else {
          echo "<li> <a id='modalOpen'class='logn'>";
        }
      } else {
        echo "<li id='goto'> <a class='logn'>";
      }
    } else {
      echo "<li> <a id='modalOpen'class='logn'>";
    }

    ?><img src="https://img.icons8.com/external-febrian-hidayat-gradient-febrian-hidayat/64/000000/external-user-user-interface-febrian-hidayat-gradient-febrian-hidayat.png" /></a></li>
  </ul>
</nav>