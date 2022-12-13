<?php 
    session_start();
    include "../../backend/connect/dbCon.php";
    include "../../backend/booking/booking_status.php";
    include __DIR__.'/../../backend/verify/payment.php';
    include_once __DIR__."/../../backend/notifications/notification_model.php";

    // $_POST['payment-method'];
    $id_user = $_SESSION['id'];
    $packageID = $_POST['packageid'];
    $totalPrice = $_POST['totalprice'];
    $slots = $_POST['availableslots'];
    $payment = $_POST['payment-method'];

    $query = "SELECT id from  inquiry_tbl WHERE id_user = $id_user AND packageID = $packageID";
    $qry_exist = mysqli_query($conn, $query);
    $inquiry = mysqli_fetch_array($qry_exist);
    $bookingNum = $id_user.date("-ymd").$inquiry['id'];

    $payload = generatePaymongoLink($totalPrice);
    $redirect = $payload['data']['attributes']['checkout_url'];
    $reference = $payload['data']['attributes']['reference_number'];

    $bookingquery = "INSERT INTO  booking_tbl (`inquiryInfoID`, `bookingNumber`,`bookingPrice`,`bookingTransacNum`, `bookingMethod`) 
                VALUES({$inquiry['id']}, '$bookingNum', $totalPrice, '$reference' ,'$payment')";
    
    $_SESSION['booking-stat'] = 'failed';
    
    if(mysqli_query($conn, $bookingquery)) {
        $addedID = mysqli_insert_id($conn);
        if (setBookingStatus($conn, $addedID, 'pay-pending', false)) {
            $bkstatusquery = "INSERT INTO  bookingstatus_tbl (`bookingInfoID`, `bookingstatus`, `timestamp`)
            VALUES($addedID, 'pay-pending', now())";

            if(mysqli_query($conn, $bkstatusquery)) {
            
            $qry = "SELECT AG.agencyManID, PK.packageTitle FROM  inquiry_tbl AS IQ 
                    INNER JOIN  package_tbl AS PK ON IQ.packageID = PK.packageID 
                    INNER JOIN  agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                    WHERE IQ.id = $inquiry[id]";
                    
            $send_to = mysqli_fetch_assoc(mysqli_query($conn, $qry));

            sendNotification($send_to['agencyManID'], "booking", "$send_to[packageTitle] got a booking!");
            $_SESSION['booking-stat'] = 'success';
            } else {
            echo 0;
            }
        }
    }

?>
<meta http-equiv="refresh" content="0;URL=../../user-profile.php?orderID=<?php echo $addedID;?>" />
<!-- <script type="text/javascript" language="Javascript">window.open('http://www.example.com');</script> -->
