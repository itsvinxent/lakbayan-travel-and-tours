<?php
    require "../connect/dbCon.php";

    function newUser($timespent, $conn){
        $id=sha1($_SERVER['HTTP_USER_AGENT'].microtime().$_SERVER['REMOTE_ADDR']);
        setcookie("id", $id, time()+3600*24*365);
        
        $query = "INSERT INTO uservisits_tbl (`visitorID`, `visitedPackageID`, `timespent`, `timestamp`) 
            VALUES({$_POST['userID']}, {$_POST['packageID']}, $timespent, now())";

        mysqli_query($conn,$query);
    }

    if (isset($_COOKIE["id"])){
        $qry = mysqli_query($conn, "SELECT userVisitsID, timespent FROM uservisits_tbl WHERE visitorID={$_POST['userID']} AND visitedPackageID = {$_POST['packageID']}");
        $fetch = mysqli_fetch_assoc($qry);

        if (!is_null($fetch)) {
            $newtimespent = (int) $fetch['timespent'] + (int) $_POST['seconds'];
            mysqli_query($conn, "UPDATE uservisits_tbl SET timespent=$newtimespent WHERE userVisitsID = {$fetch['userVisitsID']}");
        } else {
            newUser($_POST['seconds'], $conn);
        }
    }
    else {
        newUser($_POST['seconds'], $conn);
    }
?>