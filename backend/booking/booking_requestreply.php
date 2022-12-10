<?php
    include '../connect/dbCon.php';
    require 'booking_status.php';
    require_once __DIR__.'/../../backend/verify/payment.php';

    if(mysqli_connect_error()){
        echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Failed connecting to databasee")
            </script>
        END;
    }
    else{
        if (isset($_GET['bookingrefund_id']))
        $bookingID = mysqli_real_escape_string($conn, $_GET['bookingrefund_id']);
        $request_decision = mysqli_real_escape_string($conn, $_POST['refundrequest_confirm']);
        $refund_amount = mysqli_real_escape_string($conn, $_POST['current-refundPrice'] ?? null);
        $paymongo_reference = mysqli_real_escape_string($conn, $_POST['current-transacNum']);
        $refund_reason = mysqli_real_escape_string($conn, $_POST['current-refundReason']);
        $notes = "Traveler wants to cancel the refund";
        $payment_id = null; 

        if(isset($paymongo_reference)){
        $payload = getPaymongoLink($paymongo_reference);

        $ctr = 0;
        foreach ($payload['data']['attributes']['payments'] as $key => $decodes){
            if($ctr === count($payload['data']['attributes']['payments'])-1){
            $payment_id = $decodes['data']['id'];
            }
            $ctr = $ctr+1;
        }
        }

        

    
        if($request_decision == 'decline'){
            if(setBookingStatus($conn, $bookingID, "refund-denied", false)){
                echo<<<END
                <script type ="text/JavaScript">  
                alert("Booking {$bookingID} refund successfully denied")
                </script>
                END;
            } else{
                echo<<<END
                    <script type ="text/JavaScript">  
                    alert("ERROR. There's a problem with the refund process.")
                    </script>
                END;
             }
        }else {
            if(setBookingStatus($conn, $bookingID, "refunded", false)){

                generateRefund($refund_amount, $payment_id, $refund_reason, $notes); 
                echo<<<END
                    <script type ="text/JavaScript">  
                    alert("Booking {$bookingID} refund success")
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
        }
        
        mysqli_close($conn);
    } 
?>
<!-- <script language="JavaScript" type="text/javascript">
    location.href = document.referrer + '?date=' + new Date().valueOf();
</script> -->
<meta http-equiv="refresh" content="0;URL=../../user-profile.php?orderID=<?php echo $bookingID;?>" />
