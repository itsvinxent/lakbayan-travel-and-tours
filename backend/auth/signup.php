<?php
    include __DIR__.'/../connect/dbCon.php';
    include __DIR__.'/../auth/dboperation.php';

    if(mysqli_connect_error()) {
        echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Failed connecting to databasee")
            </script>
        END;
    } else {
        // Check if the email is existing
        $isExisting = "SELECT EXISTS(SELECT * FROM user_tbl WHERE email='$_POST[email]')";
        $result = mysqli_fetch_row(mysqli_query($conn,$isExisting));

        
        // If it already exists
        if ($result[0] == '1') {
            echo<<<END
                <script type ="text/JavaScript">  
                alert("An account with this email already exists. Use another email.")
                </script>
            END;
        } else {
            $sendto = $_POST['email'];
            $name = $_POST['lname'];

            $verification = md5(rand(0, 1000));
            $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $query = "INSERT INTO  user_tbl (`fname`, `lname`, `email`, `password`, `verification_code`) 
            VALUES('$_POST[fname]', '$_POST[lname]', '$_POST[email]', '$hash', '$verification')";

            if(mysqli_query($conn,$query)){
                // INSERT USER PREFERENCES
                $preferencesGot = array();
                $userPref = $_POST['trav-preferences'];
                if(strstr($userPref, ',')) $preferencesGot = explode(",", $userPref);
                else array_push($preferencesGot, $userPref);
                $userID = mysqli_insert_id($conn);
                for($i=0; $i<count($preferencesGot); $i++){
                    $data = array(
                        'userID' => $userID,
                        'userPreferences' => $preferencesGot[$i]
                    );

                    multi_insertdb($conn, $data, "userpreference_tbl");
                }
                
                // CREATE A NEW DIRECTORY FOR THE USER
                $placehere = '../../assets/img/users/traveler/'.$userID.'/';
                //checks if dir exist and makes one if it does not
                if(!file_exists($placehere)){
                    mkdir($placehere, 0777, true);
                }

                require __DIR__.'/../package/vendor/autoload.php';
                require "Mail/phpmailer/PHPMailerAutoload.php";
                
                $dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
                $dotenv->load();

                $mail_address = $_ENV['MAIL_ADDRESS'];
                $mail_pass = $_ENV['MAIL_PASS'];
                
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->Host='mail.lakbaysabayan.com';
                $mail->Port=465;
                $mail->SMTPAuth=true;
                $mail->SMTPSecure='ssl';
    
                $mail->Username=$mail_address;
                $mail->Password=$mail_pass;
    
                $mail->setFrom('no-reply@lakbaysabayan.com', 'OTP Verification');
                $mail->addAddress($_POST["email"]);
                
                $mail->isHTML(true);
                $mail->Subject="LAKBAYAN VERIFICATION";
                $mail->Body='
                
                <h1>Welcome to Lakbayan, '.strtoupper($_POST['fname']).'!</h1>
                
                <p>We are very excited to see you join our Lakbayan family! 
                But before that, verify your account now!

                Just click the link below to complete the verification: </p>
                https://lakbaysabayan.com/backend/auth/verifyuser.php?email='.$sendto.'&verification_code='.$verification.'
                ';

                if(!$mail->send()){
                    ?>
                        <script>
                            alert("Registration Failed! Invalid Email.");
                        </script>
                    <?php
                }else{
                    ?>
                    <script>
                        alert("<?php echo "Registration Successful! A verification link has been sent to" . $sendto ?>");
                        window.location.replace("../../index.php");
                    </script>
                    <?php
                }
            }
            else{
                echo<<<END
                    <script type ="text/JavaScript">  
                    alert("ERROR. Record not added.")
                    </script>
                END;
            }
        }

    }

    ?>