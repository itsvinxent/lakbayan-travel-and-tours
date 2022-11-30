<?php 
    include "../connect/dbCon.php";
    require "booking_status.php";

    $bookingID = $_POST['bookingID'];
    $userID = $_POST['userID'];
    $packageID = $_POST['packageID'];
    $package_rating = $_POST['package_rating'];
    $review = $_POST['review'];

    $agencyId = $_POST['agencyID'];
    $agency_rating = (int) $_POST['agency_rating'];
    $star = $agency_rating."_star";

    $packratingquery = "INSERT INTO traveldb.packagerating_tbl (`userID_rating`, `packageID_rated`, `package_rating`, `package_review`, `ratingDate`)
                    VALUES($userID, $packageID, $package_rating, '$review', now())";

    if (mysqli_query($conn, $packratingquery)) {
        $isAgencyExisting = "SELECT * FROM traveldb.agencyrating_tbl WHERE agencyID = $agencyId ";
        $qry = mysqli_query($conn,$isAgencyExisting);
        $result = mysqli_fetch_array($qry);
        
        if (isset($result['ratingID'])) {
            $rating = $result[$star] + 1;
            $agencyratingquery = "UPDATE traveldb.agencyrating_tbl SET $star = $rating WHERE agencyID = $agencyId";
        } else {
            $agencyratingquery = "INSERT INTO traveldb.agencyrating_tbl (`agencyID`, `$star`)
            VALUES($agencyId, 1)";
        }
        
        if (mysqli_query($conn, $agencyratingquery)) {
            setBookingStatus($conn, $bookingID, 'complete', true);
        } else {
            echo -1;
        }
    } else {
        echo 0;
    }
    // echo $package_rating;

?>