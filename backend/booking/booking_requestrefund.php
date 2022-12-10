<?php
    include '../connect/dbCon.php';
    require 'booking_status.php';


    if(mysqli_connect_error()){
        echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Failed connecting to databasee")
            </script>
        END;
    }
    else{
        if (isset($_GET['bookingrequest_id']))
        $bookingID = mysqli_real_escape_string($conn, $_GET['bookingrequest_id']);

        $request_reason = mysqli_real_escape_string($conn, $_POST['refund_confirm']);
        // $currentDate = new DateTime();
        // $delete_query = " DELETE FROM traveldb.user_tbl WHERE id = $usrid; " ;
        // $delete_query = "UPDATE traveldb.user_tbl SET is_deleted = 1 WHERE id = $usrid; " ;

        //  mysqli_query($conn,$delete_query);
    
         if(setRefundRequest($conn, $bookingID, $request_reason, false)){
            echo<<<END
                <script type ="text/JavaScript">  
                alert("Booking {$bookingID} refund request sent")
                </script>
            END;
         }
         else{
            echo<<<END
                <script type ="text/JavaScript">  
                alert("ERROR. There's a problem with the refund request.")
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
