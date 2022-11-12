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
        $pkgid = $_GET['id'];
        $usertype = $_GET['utype'];
        $currentDate = new DateTime();
        // $delete_query = " DELETE FROM traveldb.user_tbl WHERE id = $usrid; " ;
        $delete_query = "UPDATE traveldb.package_tbl SET is_deleted = 1 WHERE packageID = $pkgid; " ;
        
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
    if ($usertype == 'admin') {
        echo '<meta http-equiv="refresh" content="0;URL=../../admin-panel.php" />';
    } else {
        echo '<meta http-equiv="refresh" content="0;URL=../../agency-profile.php" />';
    }
?>