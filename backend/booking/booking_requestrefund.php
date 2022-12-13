<?php
    include __DIR__.'/../connect/dbCon.php';
    require 'booking_status.php';
    include_once __DIR__.'\..\..\backend\notifications\notification_model.php';

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
        // $delete_query = " DELETE FROM  user_tbl WHERE id = $usrid; " ;
        // $delete_query = "UPDATE  user_tbl SET is_deleted = 1 WHERE id = $usrid; " ;

        //  mysqli_query($conn,$delete_query);
    
         if(setRefundRequest($conn, $bookingID, $request_reason, false)){
            $qry = "SELECT AG.agencyManID, CONCAT(US.fname, ' ', US.lname) AS fullname FROM  booking_tbl AS BK
                                INNER JOIN  inquiry_tbl AS IQ ON BK.inquiryInfoID = IQ.id
                                INNER JOIN  user_tbl AS US ON IQ.id_user = US.id
                                INNER JOIN  package_tbl AS PK ON IQ.packageID = PK.packageID
                                INNER JOIN  agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                                WHERE BK.bookingID = $bookingID";

                $send_to = mysqli_fetch_assoc(mysqli_query($conn, $qry));    

                sendNotification($send_to['agencyManID'], "booking", "$send_to[fullname] requested for a refund for booking $bookingID!");

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
