<?php

include 'backend\connect\dbCon.php';

if(!$conn){
    echo "error connecting to the database";
}else{

    // AGENCY PROFILE 

    $stmt = mysqli_prepare($conn, "SELECT fname, 
                                          lname, 
                                          email, 
                                          `password`, 
                                          usertype, 
                                          `address`, 
                                          contactnumber, 
                                          profpicture, 
                                          userbanner,
                                          is_verified,
                                          birthday, 
                                          gender, 
                                          race, 
                                          religion,
                                          nationality
                                           FROM traveldb.user_tbl WHERE id=?");
    mysqli_stmt_bind_param($stmt, 'i', $_SESSION['id']);
    
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $fname, $lname, $email, $password, $usertype, $address, $contact, $profpic, $userbanner, $verification, $birthday, $gender, $race, $religion, $nationality);
    mysqli_stmt_fetch($stmt);
    // echo "<p>this is " . $gotName . "'s website" ;

    // agency info 
    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['email'] = $email;
    $_SESSION['utype'] = $usertype;

    $_SESSION['fullname'] = $_SESSION['fname']. ' ' .$_SESSION['lname'];

    $_SESSION['password'] = $password;
    $_SESSION['verified'] = $verification;
    $_SESSION['birthday'] = $birthday;

    $now = new DateTime(date("Y-m-d"));
    $userbday = new DateTime($birthday);

    $age =  date_diff($now, $userbday);

    $_SESSION['age'] =  $age->format("%y");

    $_SESSION['gender'] = $gender;
    $_SESSION['race'] = $race;
    $_SESSION['religion'] = $religion;
    $_SESSION['nationality'] = $nationality;

    $_SESSION['address'] = $address;
    $_SESSION['contact'] = $contact;

    if (empty($profpic)) $profpic = "../../DefaultProf.jpg";
    $_SESSION['profpic'] = $profpic;

    if (empty($userbanner)) $userbanner ="../../DefaultBanner.jpg";
    $_SESSION['userbanner'] = $userbanner;

    // manager info 
    mysqli_stmt_close($stmt);
}

function view_otheruser($conn, $id){
    $id = mysqli_real_escape_string($conn, $id);
    $sql = mysqli_query($conn, "SELECT *, CONCAT(fname, ' ',lname) AS fullname FROM user_tbl WHERE id=$id");
    $got = mysqli_fetch_array($sql);
    return $got;
}
?> 