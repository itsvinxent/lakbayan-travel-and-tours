<?php 

require __DIR__.'\..\..\backend\verify\payment.php';
require 'booking_status.php';
include '../connect/dbCon.php';

$transac = mysqli_real_escape_string($conn, $_POST['current-transacNum']);
$bookingID = mysqli_real_escape_string($conn, $_POST['current-bookingID']);

if ($transac == null)
    echo 4;
else{
    $payload = getPaymongoLink($transac);

    $payment_status = $payload['data']['attributes']['status'];

    if($payment_status != "paid"){
        return 0;
    }
    else{
        $status = 'trip-sched';

        if(setBookingStatus($conn, $_POST['current-bookingID'], $status, false)){
            if ($_POST['current-slots'] <= 0) 
                $slotquery = "UPDATE traveldb.package_tbl SET packageSlots = {$_POST['current-slots']}, packageStatus = 1 WHERE packageID = {$_POST['current-packageID']}";
            else 
                $slotquery = "UPDATE traveldb.package_tbl SET packageSlots = {$_POST['current-slots']} WHERE packageID = {$_POST['current-packageID']}";

            if (mysqli_query($conn, $slotquery)) {
                return 1;
            } else {
                return -1;
            }
        }
    }
}
?>

<meta http-equiv="refresh" content="0;URL=../../user-profile.php?orderID=<?php echo $bookingID;?>" />
