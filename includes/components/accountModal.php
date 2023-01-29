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
        // echo "<script>
        //         const close = document.getElementById('modalClose');
        //         close.addEventListener('click', () => {
        //             modal_container.classList.remove('show');
        //         })
        //     </script>";
    } 
    // else {
    //     echo "<script>const modal_container = document.getElementById('dropdown');</script>";
    // }
    
?>

<script>
    // const open = document.getElementById('modalOpen');
    // const modal_container = document.getElementById('modal_container');

    // open.addEventListener('click', () => {
    //     modal_container.classList.add('show');
    // });

    const $loginpropen = $("#modalOpen");
    const $loginprclose = $("#modalClose");
    const $loginprcon = $("#modal_container");
    $loginpropen.on("click", function() {
        $loginprcon.toggleClass("show");
    });
    $loginprclose.on("click", function() {
        $loginprcon.removeClass("show");
    });
    $($loginprcon).on('click', function (e) {
        if ($("#modal_container").has(e.target).length === 0) {
        $loginprcon.removeClass("show");
        }
    });
</script>