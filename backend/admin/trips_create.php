<?php
    include '../connect/dbCon.php';

    if(mysqli_connect_error()) {
        echo<<<END
        <script type ="text/JavaScript">  
        alert("ERROR. Failed connecting to databasee")
        </script>
        END;
    } else {
    
        $create_query = "INSERT INTO traveldb.trips_tbl (`id_user`, `contactNum`, `persons`, `startdate`, `days`, `message`, `packageName`) 
        VALUES('$_POST[user_id]', '$_POST[number]', $_POST[persons], '$_POST[resdate]', $_POST[duration], '$_POST[msg]', '$_POST[package]')";

        if(mysqli_query($conn,$create_query)){
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
    ?>
<meta http-equiv="refresh" content="0;URL=../../admin-trips.php" />