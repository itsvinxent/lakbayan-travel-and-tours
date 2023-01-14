<?php 
    include __DIR__."/../connect/dbCon.php";
    require "booking_status.php";
    include_once __DIR__."/../../backend/notifications/notification_model.php";

    $bookingID = mysqli_real_escape_string($conn,$_POST['bookingID']);
    $userID = mysqli_real_escape_string($conn,$_POST['userID']);
    $packageID = mysqli_real_escape_string($conn,$_POST['packageID']);
    $package_rating = mysqli_real_escape_string($conn,$_POST['package_rating']);
    $review = mysqli_real_escape_string($conn,$_POST['review']);

    $agencyId = $_POST['agencyID'];
    $agency_rating = (int) $_POST['agency_rating'];
    $star = $agency_rating."_star";

    $packratingquery = "INSERT INTO  packagerating_tbl (`userID_rating`, `packageID_rated`, `bookingID_rated`, `package_rating`, `package_review`, `ratingDate`)
                    VALUES($userID, $packageID, $bookingID,$package_rating, '$review', now())";

    if (mysqli_query($conn, $packratingquery)) {
        $ratingsummary_query_string = "SELECT COUNT(if(package_rating = 5,1,null)) AS `5_starCount`,
                                      COUNT(if(package_rating = 4,1,null)) AS `4_starCount`,
                                      COUNT(if(package_rating = 3,1,null)) AS `3_starCount`,
                                      COUNT(if(package_rating = 2,1,null)) AS `2_starCount`,
                                      COUNT(if(package_rating = 1,1,null)) AS `1_starCount`,
                                      COUNT(*) AS `totalCount`
                                      FROM  packagerating_tbl WHERE packageID_rated = $packageID;";

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

        $updateRatingQuery = "UPDATE  package_tbl SET packageRating = $averageRating WHERE packageID = $packageID";

        $qry_notif = "SELECT AG.agencyManID, CONCAT(US.fname, ' ', US.lname) AS fullname, PK.packageTitle FROM  booking_tbl AS BK
        INNER JOIN  inquiry_tbl AS IQ ON BK.inquiryInfoID = IQ.id
        INNER JOIN  user_tbl AS US ON IQ.id_user = US.id
        INNER JOIN  package_tbl AS PK ON IQ.packageID = PK.packageID
        INNER JOIN  agency_tbl AS AG ON AG.agencyID = PK.packageCreator
        WHERE BK.bookingID = $bookingID";

        $send_to = mysqli_fetch_assoc(mysqli_query($conn, $qry_notif));    


        if (mysqli_query($conn, $updateRatingQuery)) {
            $isAgencyExisting = "SELECT * FROM  agencyrating_tbl WHERE agencyID = $agencyId ";
            $qry = mysqli_query($conn,$isAgencyExisting);
            $result = mysqli_fetch_array($qry);
            
            if (isset($result['ratingID'])) {
                $rating = $result[$star] + 1;
                $agencyratingquery = "UPDATE  agencyrating_tbl SET $star = $rating WHERE agencyID = $agencyId";
            } else {
                $agencyratingquery = "INSERT INTO  agencyrating_tbl (`agencyID`, `$star`)
                VALUES($agencyId, 1)";
            }
            
            if (mysqli_query($conn, $agencyratingquery)) {
                setBookingStatus($conn, $bookingID, 'complete', true);
                sendNotification($send_to['agencyManID'], "booking", "$send_to[fullname] rated your package $send_to[packageTitle] a $package_rating star!");
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