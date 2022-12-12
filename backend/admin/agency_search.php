<?php 

    include "../connect/dbCon.php";
    include "agency_display.php";
    
    // Function for determining the proper prefix/suffix to be added to the SQL Query
    function get_prefix() {
        global $has_previous_value;
        if ($has_previous_value)
            return " AND ";
        return " WHERE ";
    }
    
    if (isset($_POST['isReloadingTable']) and $_POST['isReloadingTable'] == 'true') {
        $query_string = "SELECT agencyID, agencyName, verificationStat, agencyImageProof, agencyAccreditation, is_found, CONCAT(US.fname, ' ',US.lname) AS fullname 
        FROM traveldb.agency_tbl AS AG INNER JOIN traveldb.user_tbl AS US ON AG.agencyManID = US.id";
        fetch_agencytbl($query_string, $conn);
    }

    if (isset($POST['verify']) and $_POST['verify'] == 'true') {
        try {

            $query_string = "SELECT agencyID, agencyName, verificationStat, agencyImageProof, agencyAccreditation, is_found, CONCAT(US.fname, ' ',US.lname) AS fullname 
            FROM traveldb.agency_tbl AS AG INNER JOIN traveldb.user_tbl AS US ON AG.agencyManID = US.id";
            $has_previous_value = false;

            if (isset($_POST['agency_name'])) {
                $query_string .= get_prefix() . "agencyName LIKE '%{$_POST['agency_name']}%'";
                $has_previous_value = true;
            }

            if (isset($_POST['agency_id'])) {
                $query_string .= get_prefix() . "id = {$_POST['agency_id']}";
                $has_previous_value = true;
            }

            if (isset($_POST['dot_num'])) {
                $query_string .= get_prefix() . "agencyAccreditation LIKE '%{$_POST['dot_num']}%'";
                $has_previous_value = true;
            }

            if (isset($_POST['manager_name'])) {
                $query_string .= " HAVING fullname LIKE '%{$_POST['manager_name']}%'";
                $has_previous_value = true;
            }
        } finally {
            fetch_agencytbl($query_string, $conn);
        }
    }
?>