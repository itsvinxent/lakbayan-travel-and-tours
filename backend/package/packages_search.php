<?php
require_once "../connect/dbCon.php";
include "packages_display.php";

session_start();

// Default Table Query
$query_string = "SELECT PK.*, FORMAT(PK.packagePrice, 0) AS fresult, DATEDIFF(packageEndDate, packageStartDate) AS packagePeriod, AI.*, AG.agencyName 
                    FROM traveldb.package_tbl AS PK 
                    INNER JOIN traveldb.agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                    INNER JOIN traveldb.packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom";

$has_previous_value;

// Search By Package Name
// This is for real-time search bar
if (isset($_POST['query'])) {
  $query_string .= " WHERE PK.packageTitle LIKE '%{$_POST['query']}%'
                    GROUP BY AI.packageIDFrom";

  fetch_packages($query_string, $conn);
}

// Function for determining the proper prefix/suffix to be added to the SQL Query
function get_prefix()
{
  global $has_previous_value;
  if ($has_previous_value)
    return " AND ";
  return " WHERE ";
}

if ($_POST['is_filtering'] == 'true' and $_POST['booking'] == 'false') {
  try {
    $has_previous_value = false;

    // Determines if the data to be displayed is for a specific Travel Agency Only. 
    $hasagency = true;
    $isadmin = false;
    // if(isset($_POST['profile']) and $_POST['profile'] and isset($_POST['agencyid'])) {
    if ($hasagency) {
      $query_string .= " WHERE agencyID = $_SESSION[setID] ";
      $has_previous_value = true;
    }

    if (isset($_POST['name'])) {
      $query_string .= get_prefix() . "PK.packageTitle LIKE '%{$_POST['name']}%'";
      $has_previous_value = true;
    }

    if (isset($_POST['rating']) and $_POST['rating'] != 0) {
      $query_string .= get_prefix() . "PK.packageRating >= {$_POST['rating']}";
      $has_previous_value = true;
    }

    if (isset($_POST['duration']) and $_POST['duration'] != 0) {
      $query_string .= get_prefix() . "PK.packagePeriod = {$_POST['duration']}";
      $has_previous_value = true;
    }

    if (isset($_POST['price_min']) or isset($_POST['price_max'])) {
      $query_string .= get_prefix();
      if ($_POST['price_min'] == $_POST['price_max']) {
        $query_string .= "PK.packagePrice = {$_POST['price_min']}";
      } else {
        if ($_POST['price_min'] > $_POST['price_max']) {
          $query_string .= "PK.packagePrice >= {$_POST['price_min']}";
        } else if ($_POST['price_min'] < $_POST['price_max']) {
          $query_string .= "PK.packagePrice <= {$_POST['price_max']}";
        } else {
          $query_string .= "PK.packagePrice BETWEEN {$_POST['price_min']} and {$_POST['price_max']}";
        }
      }
      $has_previous_value = true;
    }

    // if (isset($_POST['location'])) {
    //   $query_string .= get_prefix() . "PK.packageLocation LIKE '%{$_POST['location']}%'";
    //   $has_previous_value = true;
    // }

    // if (isset($_POST['category'])) {
    //   $query_string .= get_prefix() . "PK.packageCategory = '{$_POST['category']}'";
    //   $has_previous_value = true;
    // }

    // if (isset($_POST['availability'])) {
    //   $query_string .= get_prefix() . "PK.packageAvailability = '{$_POST['availability']}'";
    //   $has_previous_value = true;
    // }

  } finally {
    $query_string .= " GROUP BY AI.packageIDFrom";
    // if(isset($_POST['profile']) and $_POST['profile'] and isset($_POST['agencyid'])) {
    if ($hasagency) {
      fetch_packagetbl($query_string, $conn, true);
    }
    else if ($isadmin) {
      fetch_packagetbl($query_string, $conn, false);
    } else {
      fetch_packages($query_string, $conn);
    }
    // echo $query_string;
  }
}

// Filter Queries for Booking Table
if ($_POST['booking'] == 'true' and $_POST['is_filtering'] == 'false') {
  try {
    $query_string = "SELECT IQ.*, CONCAT(US.fname, ' ',US.lname) AS fullname, BK.*, PK.packageTitle
                        FROM traveldb.inquiry_tbl AS IQ
                        INNER JOIN traveldb.user_tbl AS US ON IQ.id_user = US.id
                        INNER JOIN traveldb.booking_tbl AS BK ON IQ.id = BK.inquiryInfoID 
                        INNER JOIN traveldb.package_tbl AS PK ON IQ.packageID = PK.packageID";

    $has_previous_value = false;

    $hasagency = true;
    // if(isset($_POST['profile']) and $_POST['profile'] and isset($_POST['agencyid'])) {
    if ($hasagency) {
      $query_string .= " WHERE packageCreator = 1";
      $has_previous_value = true;
    }

    if (isset($_POST['b_name'])) {
      $query_string .= get_prefix() . "PK.packageTitle LIKE '%{$_POST['b_name']}%'";
      $has_previous_value = true;
    }

    if (isset($_POST['trn'])) {
      $query_string .= get_prefix() . "BK.bookingTransacNum = '{$_POST['trn']}'";
      $has_previous_value = true;
    }

    if (isset($_POST['package_id'])) {
      $query_string .= get_prefix() . "IQ.packageID = '{$_POST['package_id']}'";
      $has_previous_value = true;
    }

    if (isset($_POST['customer_name'])) {
      $query_string .= " HAVING fullname LIKE '%{$_POST['customer_name']}%'";
      $has_previous_value = true;
    }

    // if (isset($_POST['status'])) {
    //   $query_string .= get_prefix() . "BK.bookingStatus = '{$_POST['status']}'";
    //   $has_previous_value = true;
    // }

  } finally {
    // $query_string .= " GROUP BY AI.packageIDFrom";
    // if(isset($_POST['profile']) and $_POST['profile'] and isset($_POST['agencyid'])) {
    fetch_bookingtbl($query_string, $conn);
    // echo $query_string;
  }
}
