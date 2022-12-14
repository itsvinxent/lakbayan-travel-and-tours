<?php 

require __DIR__.'/../../backend/verify/payment.php';
require 'booking_status.php';
include __DIR__.'/../connect/dbCon.php';
include_once __DIR__."/../../backend/notifications/notification_model.php";

$transac = mysqli_real_escape_string($conn, $_POST['current-transacNum']);
$bookingID = mysqli_real_escape_string($conn, $_POST['current-bookingID']);

if ($transac == null)
    echo 4;
else{
    $payload = getPaymongoLink($transac);

    $payment_status = $payload['data']['attributes']['status'];

    if($payment_status != "paid"){
        echo 0;
    }
    else{
        $status = 'trip-sched';

        if(setBookingStatus($conn, $_POST['current-bookingID'], $status, false)){
            if ($_POST['current-slots'] <= 0) 
                $slotquery = "UPDATE  package_tbl SET packageSlots = {$_POST['current-slots']}, packageStatus = 1 WHERE packageID = {$_POST['current-packageID']}";
            else 
                $slotquery = "UPDATE  package_tbl SET packageSlots = {$_POST['current-slots']} WHERE packageID = {$_POST['current-packageID']}";

            if (mysqli_query($conn, $slotquery)) {
                $qry = "SELECT AG.agencyManID, CONCAT(US.fname, ' ', US.lname) AS fullname FROM  booking_tbl AS BK
                                INNER JOIN  inquiry_tbl AS IQ ON BK.inquiryInfoID = IQ.id
                                INNER JOIN  user_tbl AS US ON IQ.id_user = US.id
                                INNER JOIN  package_tbl AS PK ON IQ.packageID = PK.packageID
                                INNER JOIN  agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                                WHERE BK.bookingID = $bookingID";

                $send_to = mysqli_fetch_assoc(mysqli_query($conn, $qry));    

                sendNotification($send_to['agencyManID'], "booking", "$send_to[fullname] completely paid for booking $bookingID!");
                echo 1;
            } else {
                echo -1;
            }
        }
    }
}
?>

