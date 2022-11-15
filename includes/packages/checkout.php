<?php 
    session_start();
    include "../../backend/connect/dbCon.php";
    // $_POST['payment-method'];
    $id_user = $_SESSION['id'];
    $packageID = $_POST['packageid'];
    $totalPrice = $_POST['totalprice'];

    $query = "SELECT id from traveldb.inquiry_tbl WHERE id_user = $id_user AND packageID = $packageID";
    $qry_exist = mysqli_query($conn, $query);
    $inquiry = mysqli_fetch_array($qry_exist);
    $bookingNum = $id_user.date("-ymd").$inquiry['id'];

    $bookingquery = "INSERT INTO traveldb.booking_tbl (`inquiryInfoID`, `bookingNumber`, `bookingPrice`, `bookingStatus`) 
                VALUES({$inquiry['id']}, '$bookingNum', $totalPrice, 'processing')";
    
    if(mysqli_query($conn, $bookingquery)) {
        $_SESSION['booking-stat'] = 'success';
    }
    else {
        $_SESSION['booking-stat'] = 'failed';
    }

?>
<meta http-equiv="refresh" content="0;URL=../../packages.php" />
