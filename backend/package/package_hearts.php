<?php 
    
    if (isset($_POST['is_liked'])) {
        require_once '../connect/dbCon.php';
        
        $packageID = $_POST['packageID'];
        $userID =  $_POST['userID'];
        $is_liked = $_POST['is_liked'];
    
        $is_liked_check = has_liked($conn, $packageID, $userID);
        $query = '';
    
        if ($is_liked == 'true') {
            if (isset($is_liked_check['packageHeartID']) and $is_liked_check['packageHeartID'] != 0 ) {
                $query = "UPDATE packagehearts_tbl SET heartDate = now() WHERE userID = $userID AND packageID = $packageID";
            } else {
                $query = "INSERT INTO packagehearts_tbl (`packageID`, `userID`, `heartDate`) 
                VALUES($packageID, $userID, now())";
            }
        } else {
            if (isset($is_liked_check['packageHeartID']) and $is_liked_check['packageHeartID'] != 0 ) {
                $query = "DELETE FROM packagehearts_tbl WHERE packageHeartID = {$is_liked_check['packageHeartID']}";
            }
        }
    
        if ($query != '') {
            if (mysqli_query($conn, $query)) {
                echo countHearts($conn, $packageID);
            }
        }
    }

    function countHearts($conn, $packageID) {
        $query_str = "SELECT count(*) AS heart_count FROM packagehearts_tbl WHERE packageID = $packageID";
        $qry_exist = mysqli_query($conn, $query_str);
        $row = mysqli_fetch_array($qry_exist);
        if (isset($row['heart_count']) and $row['heart_count'] != 0) {
            return $row['heart_count'];
        } else {
            return 0;
        }
    }

    function has_liked($conn, $packageID, $userID) {
        $query_str = "SELECT packageHeartID from packagehearts_tbl WHERE `packageID` = $packageID AND `userID` = $userID";
        $qry_exist = mysqli_query($conn, $query_str);
        return mysqli_fetch_array($qry_exist);
    }
    

    
?>