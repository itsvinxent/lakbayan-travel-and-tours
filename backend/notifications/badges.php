<?php 
    include "../connect/dbCon.php";

    // Badge notification for Administrator Verifications Tab
    function getPendingCount($conn) {
        $count = mysqli_fetch_array(mysqli_query($conn, "SELECT COUNT(*) FROM  agency_tbl WHERE verificationStat = 'pending'"));
        echo $count[0];
    }
    
    if (isset($_POST['getPending']) and $_POST['getPending'] == 'true') {
        getPendingCount($conn);
    }
?>