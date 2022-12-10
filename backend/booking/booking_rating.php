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

    $packratingquery = "INSERT INTO traveldb.packagerating_tbl (`userID_rating`, `packageID_rated`, `bookingID_rated`, `package_rating`, `package_review`, `ratingDate`)
                    VALUES($userID, $packageID, $bookingID,$package_rating, '$review', now())";

    if (mysqli_query($conn, $packratingquery)) {
        $ratingsummary_query_string = "SELECT COUNT(if(package_rating = 5,1,null)) AS `5_starCount`,
                                      COUNT(if(package_rating = 4,1,null)) AS `4_starCount`,
                                      COUNT(if(package_rating = 3,1,null)) AS `3_starCount`,
                                      COUNT(if(package_rating = 2,1,null)) AS `2_starCount`,
                                      COUNT(if(package_rating = 1,1,null)) AS `1_starCount`,
                                      COUNT(*) AS `totalCount`
                                      FROM traveldb.packagerating_tbl WHERE packageID_rated = $packageID;";

        $sqlquery = mysqli_query($conn, $ratingsummary_query_string);
        $ratingCounts = mysqli_fetch_array($sqlquery);
        $rating_count_array = array(
          5 => $ratingCounts['5_starCount'],
          4 => $ratingCounts['4_starCount'],
          3 => $ratingCounts['3_starCount'],
          2 => $ratingCounts['2_starCount'],
          1 => $ratingCounts['1_starCount']
        );
        
        $totalWeight = 0;
        $totalReviews = 0;
          
        foreach ($rating_count_array as $weight => $numberofReviews) {
            $WeightMultipliedByNumber = $weight * $numberofReviews;
            $totalWeight += $WeightMultipliedByNumber;
            $totalReviews += $numberofReviews;
        } 
        $averageRating = $totalWeight / $totalReviews;

        $updateRatingQuery = "UPDATE traveldb.package_tbl SET packageRating = $averageRating WHERE packageID = $packageID";

        if (mysqli_query($conn, $updateRatingQuery)) {
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
                echo -2; // FAILED ON AGENCY RATING UPDATE/INSERT
            }
        } else {
            echo -1; // FAILED ON PACKAGE TABLE UPDATE
        }
    } else {
        echo 0; // FAILED ON PACKAGE RATING TABLE INSERT
    }
    // echo $package_rating;

?>