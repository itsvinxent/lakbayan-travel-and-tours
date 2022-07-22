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
        $update_query = "UPDATE traveldb.user_tbl 
        SET fname='$_POST[efname]', 
        lname='$_POST[elname]', 
        email='$_POST[eemail]', 
        usertype='$_POST[eusertype]'
        WHERE id='$_POST[id]'";
        
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
<meta http-equiv="refresh" content="0;URL=../../admin-users.php" />