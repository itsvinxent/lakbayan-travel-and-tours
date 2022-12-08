<?php 
    if(isset($_POST["recovery-email"])){
        include __DIR__."/../connect/dbCon.php";
        $email = $_POST["recovery-email"];

        $sql = mysqli_query($conn, "SELECT * FROM user_tbl WHERE email='$email'");
  	    $fetch = mysqli_fetch_assoc($sql);

        if(mysqli_num_rows($sql) <= 0){
            ?>
            <script>
                alert("ERROR. The entered email account is not registered in our website.");
            </script>
            <?php
        }else if($fetch["is_verified"] == 0){
            ?>
               <script>
                   alert("ERROR. Your Lakbayan Account must be verified first in order to reset your password.");
                   window.location.replace("../../index.php");
               </script>
           <?php
        }else{
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            session_start ();
            $_SESSION['token'] = $token;
            $_SESSION['recovery-email'] = $email;

            require "Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            $mail->Username='lakbaysabayan@gmail.com';
            $mail->Password='ezovwyqhjrximfas';

            $mail->setFrom('lakbaysabayan@gmail.com', 'Password Reset');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject="LAKBAYAN RECOVERY";
            $mail->Body="

            <h3>We have received a request to reset your password.</h3>
            <p>Kindly click the below link to continue.</p>
            http://localhost/Finals/backend/auth/resetpass.php
            ";

            if(!$mail->send()){
                ?>
                    <script>
                        alert("ERROR. The given email is INVALID.");
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        alert("The reset link has been successfully sent. Kindly check your email.");
                        window.location.replace("../../index.php");
                    </script>
                <?php
            }
        }
    }


?>