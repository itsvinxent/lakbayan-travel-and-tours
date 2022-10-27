<?php
    include '../connect/dbCon.php';

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
            $verification = md5(rand(0, 1000));
            $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $query = "INSERT INTO traveldb.user_tbl (`fname`, `lname`, `email`, `password`, `verification_code`) 
            VALUES('$_POST[fname]', '$_POST[lname]', '$_POST[email]', '$hash', '$verification')";

            if(mysqli_query($conn,$query)){

                $placehere = '../../assets/img/users/traveler/'.$userID.'/';
                //checks if dir exist and makes one if it does not
                if(!file_exists($placehere)){
                    mkdir($placehere, 0777, true);
                }

                $sendto = $_POST['email'];
                $name = $_POST['lname'];
                $head = 'From:rivasjeannefrancis@gmail.com'."\r\n";
                $subject = 'LAKBAYAN VERIFICATION';
                $body = '
                
                <h1>Welcome to Lakbayan, '.strtoupper($name).'!</h1>
                
                <p>We are very excited to see you join our Lakbayan family! 
                But before that, verify your account now!

                Just click the link below to complete the verification: </p>
                http://localhost:3000/backend/auth/verifyuser.php?email='.$sendto.'&verification_code='.$verification.'
                ';

                // mail($sendto, $subject, $body, $head);

                
                echo<<<END
                    <script type ="text/JavaScript">  
                    alert("Record successfully added, verification have been sent to your email")
                    </script>
                END;
            }
            else{
                echo<<<END
                    <script type ="text/JavaScript">  
                    alert("ERROR. Record not added.")
                    </script>
                END;
            }
        }
        mysqli_close($conn);
    }

    ?>
<meta http-equiv="refresh" content="0;URL=../../index.php#login" />