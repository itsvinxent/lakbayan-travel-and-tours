<?php 

    include "../connect/dbCon.php";
    include "agency_display.php";
    
    if (isset($_POST['isReloadingTable']) and $_POST['isReloadingTable'] == 'true') {
        $query_string = "SELECT agencyID, agencyName, verificationStat, agencyImageProof, agencyAccreditation, is_found, CONCAT(US.fname, ' ',US.lname) AS fullname 
        FROM traveldb.agency_tbl AS AG INNER JOIN traveldb.user_tbl AS US ON AG.agencyManID = US.id";
        fetch_agencytbl($query_string, $conn);
    }
?>