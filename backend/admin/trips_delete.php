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
        $id = $_GET['id'];
        $usrid = $_GET['user_id'];
        $delete_query = " DELETE FROM traveldb.trips_tbl WHERE id = $id and id_user = $usrid; " ;
        
         mysqli_query($conn,$delete_query);
    
         if(mysqli_query($conn,$delete_query)){
            echo<<<END
                <script type ="text/JavaScript">  
                alert("Record successfully deleted")
                </script>
            END;
         }
         else{
            echo<<<END
                <script type ="text/JavaScript">  
                alert("ERROR. Record not deleted.")
                </script>
            END;
         }
        mysqli_close($conn);
    } 
?>
<meta http-equiv="refresh" content="0;URL=../../admin-trips.php" />