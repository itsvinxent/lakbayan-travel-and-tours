<?php 
include __DIR__."/../../backend/connect/dbCon.php";
session_start();

if(mysqli_connect_error()){
    echo<<<END
    <script type ="text/JavaScript">  
    alert("ERROR. Failed connecting to databasee")
    </script>
    END;
}else{
    $read_notif = "UPDATE notification_tbl SET notification_status=1 WHERE notification_to=$_SESSION[id]";

    if(mysqli_query($conn, $read_notif)){

    }else{
        echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Error with the Operation")
            </script>
            END;
    }
}


?>