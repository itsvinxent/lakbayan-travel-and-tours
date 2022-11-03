
    <?php 
        if ($_SESSION['isLoggedIn'] == false) {
            echo "<div class=\"modal-container\" id=\"modal_container\">
            <div class='modal'>
            <h1>Hey there!</h1>
            <p>We're glad that you've chosen us for your travel needs. Create and Sign your account in now!</p>
            <div class=\"buttons\">
                <button id='modalLogin' class='modal-login'";
            if($_SESSION['active'] == 's-dest' || $_SESSION['active'] == 's-pack') {
                echo "onClick=\"location.href='../../index.php#login'\">Sign In Now</button>";
            } else {
                echo "onClick=\"location.href='index.php#login'\">Sign In Now</button>";
            }
            echo "<a id=\"modalClose\" class=\"btn\">Maybe next time</a> 
                    </div>
                    </div>
                    </div>"; 
        } else if ($_SESSION['utype'] == 'manager'){
            $name = $_SESSION['fname'];
            echo "<div class=\"modal-container\" id=\"modal_container\">
            <div class='modal'> 
            <h1>Welcome, $name!</h1>
            <p>You are logged in within the system. You can now start picking your destinations and book them with us.</p>
            <div class=\"buttons\">
                <button id=\"modalLogin\" class='modal-login' onClick=\"location.href='backend/auth/signout.php'\">Sign Out</button>
                <button id=\"modalLogin\" class='modal-login' onClick=\"location.href='agency-profile.php'\">Travel Agency</button>
                <a id=\"modalClose\" class=\"btn\">Close</a>
            </div>
            </div>
            </div>";
        } else {
            $name = $_SESSION['fname'];
            echo "<div class=\"modal-container\" id=\"modal_container\">
            <div class='modal'> 
            <h1>Welcome, $name!</h1>
            <p>You are logged in within the system. You can now start picking your destinations and book them with us.</p>
            <div class=\"buttons\">
                <button id=\"modalLogin\" class='modal-login' onClick=\"location.href='backend/auth/signout.php'\">Sign Out</button>
                <a id=\"modalClose\" class=\"btn\">Close</a>
            </div>
            </div>
            </div>";
        }

    ?>

<script>
    const open = document.getElementById('modalOpen');
    const modal_container = document.getElementById('modal_container');
    const close = document.getElementById('modalClose');

    open.addEventListener('click', () => {
        modal_container.classList.add('show');
    })

    close.addEventListener('click', () => {
        modal_container.classList.remove('show');
    })
</script>