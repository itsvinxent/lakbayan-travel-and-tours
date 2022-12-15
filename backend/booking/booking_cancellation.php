<?php
    include __DIR__.'/../connect/dbCon.php';
    require 'booking_status.php';


    if(mysqli_connect_error()){
        echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Failed connecting to databasee")
            </script>
        END;
    }
    else{
        if (isset($_GET['booking_id']))
        $bookingID = mysqli_real_escape_string($conn,$_GET['booking_id']);
        // $currentDate = new DateTime();
        // $delete_query = " DELETE FROM  user_tbl WHERE id = $usrid; " ;
        // $delete_query = "UPDATE  user_tbl SET is_deleted = 1 WHERE id = $usrid; " ;

        //  mysqli_query($conn,$delete_query);
    
         if(setBookingStatus($conn, $bookingID, 'cancelled', false)){
            echo<<<END
                <script type ="text/JavaScript">  
                alert("Booking {$bookingID} cancelled")
                </script>
            END;
         }
         else{
            echo<<<END
                <script type ="text/JavaScript">  
                alert("ERROR. There's a problem with the cancellation.")
                </script>
            END;
         }
        mysqli_close($conn);
    } 
?>
<!-- <script language="JavaScript" type="text/javascript">
    location.href = document.referrer + '?date=' + new Date().valueOf();
</script> -->
<meta http-equiv="refresh" content="0;URL=../../user-profile.php?orderID=<?php echo $bookingID;?>" />
