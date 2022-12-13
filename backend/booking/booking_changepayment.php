<?php 
    include __DIR__."/../connect/dbCon.php";

    if (isset($_POST['payment_option']) and isset($_POST['bookingID'])) {
        $paymentquery = "UPDATE  booking_tbl SET bookingMethod = '{$_POST['payment_option']}' WHERE bookingID = {$_POST['bookingID']}";
        if (mysqli_query($conn, $paymentquery)) {
            echo 1; // SUCCESS
        } else {
            echo 0; // DATABASE ERROR
        }
    } else {
        echo -1; // VARIABLE UNSET ERROR
    }
?>