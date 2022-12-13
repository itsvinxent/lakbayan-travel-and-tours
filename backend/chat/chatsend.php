<?php 
session_start();
include_once __DIR__."/../../backend/connect/dbCon.php";

$pass = true;
if($pass == true){
    $sendto = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $receivefrom = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if(!empty($message)){
        $sql = mysqli_query($conn, "INSERT INTO message_tbl (messageFrom_id, messageTo_id, `message`, message_sent) 
                                                            VALUES ({$receivefrom}, {$sendto}, '{$message}', now())") or die();
    }
}

?>