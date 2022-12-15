<?php
require_once "../connect/dbCon.php";
include "packages_display.php";

session_start();

// Default Table Query
$query_string = "SELECT PK.*, FORMAT(PK.packagePrice, 0) AS fresult, DATEDIFF(packageEndDate, packageStartDate) AS packagePeriod, AI.*, AG.agencyName, AG.agencyManID
                    FROM traveldb.package_tbl AS PK 
                    INNER JOIN traveldb.agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                    INNER JOIN traveldb.packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom";

$has_previous_value;
$limit = 8;
if (isset($_POST['page'])) {
  $page = $_POST['page'];
} else {
  $page = 1;
}

// Search By Package Name
// This is for real-time search bar
if (isset($_POST['query']) and $_POST['query'] == 'true') {
  $query_string = "SELECT PK.*, FORMAT(PK.packagePrice, 0) AS fresult, 
  DATEDIFF(packageEndDate, packageStartDate) AS packagePeriod, AI.*, 
  AG.agencyName, AG.agencyManID " . $_SESSION['recommendedQuery'];
  // echo $query_string;
  fetch_packages($query_string, $conn, false, $limit, $page);
}

// Function for determining the proper prefix/suffix to be added to the SQL Query
function get_prefix()
{
  global $has_previous_value;
  if ($has_previous_value)
    return " AND ";
  return " WHERE ";
}

// Filter Queries for Packages Table
if (isset($_POST['is_filtering']) and $_POST['is_filtering'] == 'true') {
  try {
    $has_previous_value = false;

    if(isset($_POST['logged_user']) and $_POST['logged_user'] == 'agency') {
      $query_string .= " WHERE agencyID = $_SESSION[setID]";
      $has_previous_value = true;
    }

    if (isset($_POST['name']) and $_POST['name'] != "") {
      $query_string .= get_prefix() . "PK.packageTitle LIKE '%{$_POST['name']}%'";
      $has_previous_value = true;
    }

    if (isset($_POST['rating']) and $_POST['rating'] != 0) {
      $query_string .= get_prefix() . "PK.packageRating >= {$_POST['rating']}";
      $has_previous_value = true;
    }

    if (isset($_POST['duration']) and $_POST['duration'] != 0) {
      $query_string .= get_prefix() . "DATEDIFF(packageEndDate, packageStartDate) = {$_POST['duration']}";
      $has_previous_value = true;
    }

    if (isset($_POST['price_min']) or isset($_POST['price_max'])) {
      if ($_POST['price_min'] != 0 || $_POST['price_max'] != 0) {
        $query_string .= get_prefix();
        if ($_POST['price_min'] == $_POST['price_max']) {
          $query_string .= "PK.packagePrice = {$_POST['price_min']}";
        } else if ($_POST['price_min'] != 0 and $_POST['price_max'] == 0) {
          $query_string .= "PK.packagePrice >= {$_POST['price_min']}";
        } else if ($_POST['price_min'] == 0 and $_POST['price_max'] != 0) {
          $query_string .= "PK.packagePrice <= {$_POST['price_max']}";
        } else {
          $query_string .= "PK.packagePrice BETWEEN {$_POST['price_min']} and {$_POST['price_max']}";
        }
        $has_previous_value = true;
      }
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
    $query_string .= get_prefix() ."PK.is_deleted = 0";
    $query_string .= " GROUP BY AI.packageIDFrom";
    if(isset($_POST['logged_user']) and $_POST['logged_user'] == 'agency') {
      $query_string .= "AND PK.packageStatus = 0";
      fetch_packagetbl($query_string, $conn, true);
    }
    else if(isset($_POST['logged_user']) and $_POST['logged_user'] == 'admin') {
      fetch_packagetbl($query_string, $conn, false);
    } else {
      // $query_string .= " LIMIT $start_from, $limit";
      fetch_packages($query_string, $conn, false, $limit, $page);
    }
    // echo $query_string;
  }
}

// Filter Queries for Booking Table
if (isset($_POST['booking']) and $_POST['booking'] == 'true') {
  try {
    $query_string = "SELECT IQ.*, CONCAT(US.fname, ' ',US.lname) AS fullname, BK.*, PK.packageTitle
                        FROM traveldb.inquiry_tbl AS IQ
                        INNER JOIN traveldb.user_tbl AS US ON IQ.id_user = US.id
                        INNER JOIN traveldb.booking_tbl AS BK ON IQ.id = BK.inquiryInfoID 
                        INNER JOIN traveldb.package_tbl AS PK ON IQ.packageID = PK.packageID";

    $has_previous_value = false;

    if(isset($_POST['logged_user'])) {
      if($_POST['logged_user'] == 'agency') {
        $query_string .= " WHERE packageCreator = {$_SESSION['setID']}";
        $has_previous_value = true;
      } else if($_POST['logged_user'] == 'user') {
        $query_string .= " WHERE id_user = {$_SESSION['id']}";
        $has_previous_value = true;
      }
    }

    if (isset($_POST['b_name']) and $_POST['b_name'] != "") {
      $query_string .= get_prefix() . "PK.packageTitle LIKE '%{$_POST['b_name']}%'";
      $has_previous_value = true;
    }

    if (isset($_POST['trn']) and $_POST['trn'] != "") {
      $query_string .= get_prefix() . "BK.bookingTransacNum = '{$_POST['trn']}'";
      $has_previous_value = true;
    }

    if (isset($_POST['package_id']) and $_POST['package_id'] != 0) {
      $query_string .= get_prefix() . "IQ.packageID = '{$_POST['package_id']}'";
      $has_previous_value = true;
    }

    if (isset($_POST['customer_name']) and $_POST['customer_name'] != "") {
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

// Package Edit Form UI
if (isset($_POST['is_editing']) and $_POST['is_editing'] == 'true') {
  $package_qry = "SELECT PK.* FROM traveldb.package_tbl AS PK WHERE PK.packageID = {$_POST['packageID']}";
  $categ_qry = "SELECT * FROM traveldb.packagecateg_tbl where packageID_from = {$_POST['packageID']}";
  $loc_qry =  "SELECT * FROM traveldb.packagedest_tbl INNER JOIN areas_tbl AS AT ON AT.cityID = packageAreasID WHERE packageDestID = {$_POST['packageID']}";
  $img_qry = "SELECT * FROM traveldb.packageimg_tbl WHERE packageIDFrom = {$_POST['packageID']}";
  $inc_qry = "SELECT * FROM traveldb.packageincl_tbl WHERE packageID_from = {$_POST['packageID']}";

  $jsondata = fetch_package_by_id($package_qry, $categ_qry, $loc_qry, $img_qry, $inc_qry, $conn);
  echo $jsondata;
}

// Booking Travel Order UI
if (isset($_POST['is_travel']) and $_POST['is_travel'] == 'true') {
  $inq_qry = "SELECT IQ.*, CONCAT(US.fname, ' ',US.lname) AS fullname, US.email, US.contactnumber, US.address, BK.*, 
              AG.agencyManID, AG.agencyPfPicture, AG.agencyName, PK.packageCreator, PK.packageTitle, PK.packagePrice, PK.packagePriceChild, PK.packagePriceSenior, PK.packagePersonMax, PK.packagePersonMin, PK.packageStartDate, PK.packageEndDate, PK.packageSlots, AI.packageImg_Name
              FROM traveldb.inquiry_tbl AS IQ
              INNER JOIN traveldb.user_tbl AS US ON IQ.id_user = US.id
              INNER JOIN traveldb.booking_tbl AS BK ON IQ.id = BK.inquiryInfoID 
              INNER JOIN traveldb.package_tbl AS PK ON IQ.packageID = PK.packageID
              INNER JOIN traveldb.agency_tbl AS AG ON PK.packageCreator = AG.agencyID
              INNER JOIN traveldb.packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom
              WHERE (packageImg_Name LIKE 'PCK-F%' OR packageImg_Name IS NULL)
              and BK.bookingID = {$_POST['bookingID']}";
  // BK.inquiryInfoID = {$_POST['inquiryInfoID']} AND 

  $status_qry = "SELECT * FROM traveldb.bookingstatus_tbl WHERE bookingInfoID = {$_POST['bookingID']}";

  $jsondata = fetch_booking_by_id($inq_qry, $status_qry, $conn);
  
  echo $jsondata;
}