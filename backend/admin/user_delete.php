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
        $usrid = $_GET['id'];
        $delete_query = " DELETE FROM traveldb.user_tbl WHERE id = $usrid; " ;
        
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
<!-- <script language="JavaScript" type="text/javascript">
    location.href = document.referrer + '?date=' + new Date().valueOf();
</script> -->
<meta http-equiv="refresh" content="0;URL=../../admin-users.php" />