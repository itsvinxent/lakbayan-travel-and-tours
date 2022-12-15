<?php 
    session_start();
    $_SESSION['isLoggedIn'] = false;

    include '../connect/dbCon.php';

    $stmt = mysqli_prepare($conn, "SELECT id, fname, lname, email, `password`, usertype, `is_verified` FROM traveldb.user_tbl WHERE email=?");
    mysqli_stmt_bind_param($stmt, 's', $email);

    $email = $_POST['email'];
    $inpPassword = mysqli_real_escape_string($conn, $_POST['password']);
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $fname, $lname, $email, $password, $usertype, $verstat);
    mysqli_stmt_fetch($stmt);
    
    
    // $_SESSION['name'] = $res[1];
    // $_SESSION['email'] = $res[2];
    $verify = password_verify($inpPassword, $password);
    if($id != 0 and $verify) {
    //  if($id != 0 and $inpPassword == $password) {
        if ($verstat == 1) {
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['email'] = $email;
            $_SESSION['utype'] = $usertype;
            if ($usertype == 'admin') {
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=../../admin-panel.php\" />";
            } else {
                echo "<meta http-equiv=\"refresh\" content=\"0;URL=../../index.php\" />";
            }
        } else {
            echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Please verify your account first using the link we sent to your email account!")
            </script>
            END;
            echo "<meta http-equiv=\"refresh\" content=\"0;URL=../../index.php\" />";
        }
        
    } else{
        echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Account does not exist, please check the entered email or password.")
            </script>
        END;
        echo "<meta http-equiv=\"refresh\" content=\"0;URL=../../index.php\" />";
    }

    
?>

<!-- <meta http-equiv="refresh" content="0;URL=../../index.php" /> -->
<!-- <meta http-equiv="refresh" content="0;URL=test.php" /> -->
