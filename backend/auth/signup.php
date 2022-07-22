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
            $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $query = "INSERT INTO traveldb.user_tbl (`fname`, `lname`, `email`, `password`) 
            VALUES('$_POST[fname]', '$_POST[lname]', '$_POST[email]', '$hash')";

            if(mysqli_query($conn,$query)){
                echo<<<END
                    <script type ="text/JavaScript">  
                    alert("Record successfully added")
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