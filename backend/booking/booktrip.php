<?php
    session_start();
    include '../connect/dbCon.php';
    // echo "$_SESSION[id] $_POST[number] $_POST[persons] $_POST[resdate] $_POST[duration] $_POST[msg]";
    if(mysqli_connect_error()) {
        echo<<<END
        <script type ="text/JavaScript">  
        alert("ERROR. Failed connecting to databasee")
        </script>
        END;
    } else {
        $query = "INSERT INTO traveldb.trips_tbl (`id_user`, `contactNum`, `persons`, `startdate`, `days`, `message`, `packageName`) 
        VALUES($_SESSION[id], '$_POST[number]', $_POST[persons], '$_POST[resdate]', $_POST[duration], '$_POST[msg]', '$_POST[loc]')";

        if(mysqli_query($conn,$query)){
            $_SESSION['booking-stat'] = 'success';
        }
        else{
            $_SESSION['booking-stat'] = 'failed';
        }
    }
        mysqli_close($conn);
        

    ?>
<meta http-equiv="refresh" content="0;URL=../../packages.php" />