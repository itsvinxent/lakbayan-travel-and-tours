<?php 
    set_include_path(dirname(__FILE__));

    require '../auth/imgverification.php';
    require 'booking_status.php';
    include '../connect/dbCon.php';

    if (isset($_FILES['payment-proof'])) {
        $gotVerify  = $_FILES['payment-proof'];
        $chk =  image_verification($gotVerify);

        if($chk) {
            if(!mysqli_connect_error()) {
                $uploadedCheckqry = "SELECT bookingProofImg from booking_tbl WHERE bookingID = {$_POST['current-bookingID']}";
                $qry_upload = mysqli_query($conn, $uploadedCheckqry);
                $hasUploaded = mysqli_fetch_assoc($qry_upload);

                if (isset($hasUploaded['bookingProofImg']) and $hasUploaded['bookingProofImg'] != null and $hasUploaded['bookingProofImg'] != "")  
                    $updated = $hasUploaded['bookingProofImg'];
                else 
                    $updated = rename_image($gotVerify, "PROOF-");

                $currBookingID = $_POST['current-bookingID'];
                $currUserID = $_POST['current-userID'];

                $uploadfilename = "UPDATE booking_tbl SET bookingProofImg='{$updated}' WHERE bookingID = {$_POST['current-bookingID']}";
                if (mysqli_query($conn, $uploadfilename)){

                    $placehere = "../../assets/img/users/traveler/{$currUserID}/proof/{$currBookingID}/";
                    $placever = $placehere.$updated;

                    //checks if dir exist and makes one if it does not
                    if(!file_exists($placehere)){
                        mkdir($placehere, 0777, true);
                    }

                    move_uploaded_file($gotVerify['tmp_name'], $placever);
                    // Set Booking Status to awaiting payment confirmation
                    echo setBookingStatus($conn, $currBookingID, 'confirm-pending', true);
                    // Add Notification HERE
                    
                } else {
                    echo 0; // DATABASE ERROR
                }
            } else {
                echo 0; // DATABASE ERROR
            }
        } else {
            echo -1; // IMAGE VERIFICATION ERROR
        }
    } else {
        echo -2; // IMAGE UPLOAD ERROR
    }
?>