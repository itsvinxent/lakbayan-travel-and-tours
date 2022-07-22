<nav class="_nav">
    <input type="checkbox" id="check" />
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <label for="check" class="closebtn">
        <i class="fas fa-times"></i>
    </label>
    <label class="logo"><img src="assets/img/logo.png">Lakbayan Travel and Tours</label>
    <ul>
        <li><a <?php if ($_SESSION['active'] == 'users') {
                    echo 'class="active logp" href="#"';
                } else {
                    echo 'href="admin-users.php"';
                } ?>>User Accounts</a></li>
        <li><a <?php
                if ($_SESSION['active'] == 'trips') {
                    echo 'class="active" href="#"';
                } else {
                    echo 'href="admin-trips.php"';
                } ?>>Booking Inquiries</a></li>
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