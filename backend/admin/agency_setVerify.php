<?php 
    require "../connect/dbCon.php";
    include __DIR__."/../notifications/badges.php";

    if (isset($_POST['agencyID']) and isset($_POST['status'])) {
        $query_string = "UPDATE  agency_tbl SET verificationStat = '{$_POST['status']}' where agencyID = {$_POST['agencyID']}";
        if (mysqli_query($conn, $query_string)) {
            getPendingCount($conn);
        }
    } else {
        echo -1; // POST DATA NOT SET ERROR
    }
?>