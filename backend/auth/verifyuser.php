<?php 
include __DIR__.'/..\connect\dbCon.php';


if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['verification_code']) && !empty($_GET['verification_code'])){
    // Verify data
    $email = $_GET['email']; // Set email variable
    $verification = $_GET['verification_code']; // Set hash variable
                  
    $search = mysqli_query($conn, "SELECT email, verification_code, is_verified FROM user_tbl WHERE email='".$email."' AND verification_code='".$verification."' AND is_verified='0'") or die(); 
    $match  = mysqli_num_rows($search);
                  
    if($match > 0){
        // We have a match, activate the account
        mysqli_query($conn, "UPDATE user_tbl SET is_verified='1' WHERE email='".$email."' AND verification_code='".$verification."' AND is_verified='0'") or die();
        
        echo <<<END
        <script type ="text/JavaScript">  
        alert("Congratulations, your account have been verified!")
        </script>
        END;

        echo'<meta http-equiv="refresh" content="0;URL=../../index.php" />';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
    }
                  
}else{
    // Invalid approach
    echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
}
?> 
