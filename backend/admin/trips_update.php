<?php
    include '../connect/dbCon.php';
    if(mysqli_connect_error()){
        echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Failed connecting to databasee")
            </script>
        END;
    }
    else{
        $update_query = "UPDATE traveldb.trips_tbl 
        SET contactNum = '$_POST[enumber]',
        persons = '$_POST[epersons]',
        startdate = '$_POST[eresdate]',
        days = '$_POST[eduration]',
        message = '$_POST[emsg]',
        packageName = '$_POST[epackage]'
        WHERE id='$_POST[trip_id]' 
        and id_user='$_POST[euser_id]'";
        
         mysqli_query($conn,$update_query);

         if(mysqli_query($conn,$update_query)){
            echo<<<END
                <script type ="text/JavaScript">  
                alert("Record successfully edited.")
                </script>
            END;
         }
         else{
            echo<<<END
                <script type ="text/JavaScript">  
                alert("ERROR. Unable to edit record.")
                </script>
            END;
         }
        mysqli_close($conn);
    } 
?>
<meta http-equiv="refresh" content="0;URL=../../admin-trips.php" />