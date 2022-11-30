<?php 
    function setBookingStatus($conn, $bookingID, $bookingStatus, $showStatusCode) {
        $bkstatusquery = "UPDATE traveldb.booking_tbl SET bookingStatus = '$bookingStatus' WHERE bookingID = $bookingID";
        if (mysqli_query($conn, $bkstatusquery))
            if ($showStatusCode) echo 1;
            else return 1;
        else 
            if ($showStatusCode) echo 0;
            else return 0;
    }
?>