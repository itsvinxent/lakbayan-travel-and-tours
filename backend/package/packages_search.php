<?php
require_once "../connect/dbCon.php";
include __DIR__."/packages_display.php";

session_start();

// Default Table Query
$query_string = "SELECT PK.*, FORMAT(PK.packagePrice, 0) AS fresult, 
                    DATEDIFF(packageEndDate, packageStartDate) AS packagePeriod, 
                    AI.packageImg_Name, AG.agencyName, AG.agencyManID, 
                    GROUP_CONCAT(ART.City) AS Cities,
                    GROUP_CONCAT(PC.packageCategory) AS Categories
                    FROM  package_tbl AS PK 
                    INNER JOIN  agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                    INNER JOIN  packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom
                    INNER JOIN packagedest_tbl AS PD ON PK.packageID = PD.packageDestID
                    INNER JOIN areas_tbl AS ART ON PD.packageAreasID = ART.cityID
                    INNER JOIN packagecateg_tbl AS PC ON PK.packageID = PC.packageID_from";

$has_previous_value;
$has_loc;
$has_cat;
$has_cust_name;
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
  DATEDIFF(packageEndDate, packageStartDate) AS packagePeriod, AI.packageIDFrom, AI.packageImg_Name, 
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

function get_having_prefix()
{
  global $has_previous_value;
  if ($has_previous_value)
    return " AND ";
  return " HAVING ";
}

// Filter Queries for Packages Table
if (isset($_POST['is_filtering']) and $_POST['is_filtering'] == 'true') {
  try {
    $has_previous_value = false;
    $has_loc = false;
    $has_cat = false;

    if(isset($_POST['logged_user']) and $_POST['logged_user'] == 'agency') {
      $query_string .= " WHERE agencyID = $_SESSION[setID]";
      $has_previous_value = true;
    }

    if (isset($_POST['name']) and $_POST['name'] != "" and isset($_POST['searchbar']) and $_POST['searchbar'] == 'false') {
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

    if (isset($_POST['location']) and $_POST['location'] != "") {
      $has_loc = true;
    }

    if (isset($_POST['category']) and $_POST['category'] != "") {
      $has_cat = true;
    }

  } finally {
    if (isset($_POST['availability']) and $_POST['availability'] != "") {
      if (isset($_POST['availability']) and $_POST['availability'] != "a-all") {
        $avail_value = 0;
  
        if ($_POST['availability'] == "a-unlisted") {
          $avail_value = 1;
        } 
  
        $query_string .= get_prefix() . "(PK.is_deleted = '$avail_value' OR PK.packageStatus = '$avail_value')";
        $has_previous_value = true;

      }
    } else {
      $query_string .= get_prefix() . "(PK.is_deleted = '0' OR PK.packageStatus = '0')";
      $has_previous_value = true;
    }

    $query_string .= get_prefix() ."(packageImg_Name LIKE 'PCK-F%' OR packageImg_Name IS NULL) ";
    $query_string .= " GROUP BY AI.packageIDFrom, AI.packageImg_Name ";
    if (isset($_POST['searchbar']) and $_POST['searchbar'] == 'true') {
      $query_string .= " HAVING CONCAT(',', Cities, ',') REGEXP ',{$_POST['location']}[^,]*,' 
                        OR PK.packageTitle LIKE '%{$_POST['name']}%'";
      $has_loc = false;
    } else {
      $has_previous_value = false;
      if ($has_loc) {
        $query_string .= get_having_prefix() ."CONCAT(',', Cities, ',') REGEXP ',{$_POST['location']}[^,]*,'";
        $has_loc = false;
        $has_previous_value = true;
      }
      
      if ($has_cat) {
        $query_string .= get_having_prefix() ."FIND_IN_SET('{$_POST['category']}', Categories)";
        $has_cat = false;
        $has_previous_value = true;
      }
    }

    if(isset($_POST['logged_user']) and $_POST['logged_user'] == 'agency') {
      // $query_string .= "AND PK.packageStatus = 0"; 
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
                        FROM  inquiry_tbl AS IQ
                        INNER JOIN  user_tbl AS US ON IQ.id_user = US.id
                        INNER JOIN  booking_tbl AS BK ON IQ.id = BK.inquiryInfoID 
                        INNER JOIN  package_tbl AS PK ON IQ.packageID = PK.packageID";

    $has_previous_value = false;
    $has_cust_name = false;

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
      $query_string .= get_prefix() . "BK.bookingNumber LIKE '%{$_POST['trn']}%'";
      $has_previous_value = true;
    }

    if (isset($_POST['package_id']) and $_POST['package_id'] != 0) {
      $query_string .= get_prefix() . "IQ.packageID = '{$_POST['package_id']}'";
      $has_previous_value = true;
    }

    if (isset($_POST['customer_name']) and $_POST['customer_name'] != "") {
      $has_cust_name = true;
    }

    if (isset($_POST['status']) and $_POST['status'] != "s-all") {
      $query_string .= get_prefix() . "BK.bookingStatus = '{$_POST['status']}'";
      $has_previous_value = true;
    }

  } finally {
    // $query_string .= " GROUP BY AI.packageIDFrom";
    // if(isset($_POST['profile']) and $_POST['profile'] and isset($_POST['agencyid'])) {
    if ($has_cust_name) {
      $query_string .= " HAVING fullname LIKE '%{$_POST['customer_name']}%'";
    }
    fetch_bookingtbl($query_string, $conn);
    // echo $query_string;
  }
}

// Package Edit Form UI
if (isset($_POST['is_editing']) and $_POST['is_editing'] == 'true') {
  $package_qry = "SELECT PK.* FROM  package_tbl AS PK WHERE PK.packageID = {$_POST['packageID']}";
  $categ_qry = "SELECT * FROM  packagecateg_tbl where packageID_from = {$_POST['packageID']}";
  $loc_qry =  "SELECT * FROM  packagedest_tbl INNER JOIN areas_tbl AS AT ON AT.cityID = packageAreasID WHERE packageDestID = {$_POST['packageID']}";
  $img_qry = "SELECT * FROM  packageimg_tbl WHERE packageIDFrom = {$_POST['packageID']}";
  $inc_qry = "SELECT * FROM  packageincl_tbl WHERE packageID_from = {$_POST['packageID']}";

  $jsondata = fetch_package_by_id($package_qry, $categ_qry, $loc_qry, $img_qry, $inc_qry, $conn);
  echo $jsondata;
}

// Booking Travel Order UI
if (isset($_POST['is_travel']) and $_POST['is_travel'] == 'true') {
  $inq_qry = "SELECT IQ.*, CONCAT(US.fname, ' ',US.lname) AS fullname, US.email, US.contactnumber, US.address, BK.*, 
              AG.agencyManID, AG.agencyPfPicture, AG.agencyName, PK.packageCreator, PK.packageTitle, PK.packagePrice, PK.packagePriceChild, PK.packagePriceSenior, PK.packagePersonMax, PK.packagePersonMin, PK.packageStartDate, PK.packageEndDate, PK.packageSlots, AI.packageImg_Name
              FROM  inquiry_tbl AS IQ
              INNER JOIN  user_tbl AS US ON IQ.id_user = US.id
              INNER JOIN  booking_tbl AS BK ON IQ.id = BK.inquiryInfoID 
              INNER JOIN  package_tbl AS PK ON IQ.packageID = PK.packageID
              INNER JOIN  agency_tbl AS AG ON PK.packageCreator = AG.agencyID
              INNER JOIN  packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom
              WHERE (packageImg_Name LIKE 'PCK-F%' OR packageImg_Name IS NULL)
              and BK.bookingID = {$_POST['bookingID']}";
  // BK.inquiryInfoID = {$_POST['inquiryInfoID']} AND 

  $status_qry = "SELECT * FROM  bookingstatus_tbl WHERE bookingInfoID = {$_POST['bookingID']}";

  $jsondata = fetch_booking_by_id($inq_qry, $status_qry, $conn);
  
  echo $jsondata;
}