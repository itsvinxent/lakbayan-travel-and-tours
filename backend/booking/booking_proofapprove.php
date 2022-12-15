<?php 
    require 'booking_status.php';
    include __DIR__.'/../connect/dbCon.php';

    if (isset($_POST['proof-decision']) and isset($_POST['current-bookingID'])) {
        if ($_POST['proof-decision'] == 'approved')  
            $status = 'trip-sched';
        else
            $status = 'pay-denied';

        if (setBookingStatus($conn, $_POST['current-bookingID'], $status, false)) {
            if ($_POST['current-slots'] <= 0) 
                $slotquery = "UPDATE  package_tbl SET packageSlots = {$_POST['current-slots']}, packageStatus = 1 WHERE packageID = {$_POST['current-packageID']}";
            else 
                $slotquery = "UPDATE  package_tbl SET packageSlots = {$_POST['current-slots']} WHERE packageID = {$_POST['current-packageID']}";

            if (mysqli_query($conn, $slotquery)) {
                echo 1;
            } else {
                echo -1;
            }
        }

    } else {
        echo 0;
    }
?>