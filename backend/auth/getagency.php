<?php

include __DIR__.'\..\..\backend\connect\dbCon.php';

$testdata = 1;
$managertest = 19;

if(!$conn){
    echo "error connecting to the database";
}else{

    // AGENCY PROFILE 

    $qry = mysqli_prepare($conn, "SELECT AG.*, 
                                US.email, 
                                CONCAT(US.fname, ' ' ,US.lname) AS fullname,
                                US.contactnumber
                                FROM traveldb.agency_tbl AS AG
                                INNER JOIN traveldb.user_tbl AS US ON AG.agencyManID = US.id
                                WHERE agencyManID = ?");
    mysqli_stmt_bind_param($qry, 'i',  $_SESSION['id']); //sets the parameters (?) above

    mysqli_stmt_execute($qry);
    mysqli_stmt_bind_result($qry, $gotID, 
                                  $gotName, 
                                  $gotDesc, 
                                  $gotAdd, 
                                  $gotManID, 
                                  $gotPfPicture,
                                  $gotBanner,
                                  $gotTelNumber, 
                                  $gotfblink,
                                  $gottwlink, 
                                  $gotiglink,
                                  $gotEmail,
                                  $gotDOT,
                                  $gotProof,
                                  $isdeleted, 
                                  $gotMEmail, 
                                  $gotMName, 
                                  $gotMContact);
    mysqli_stmt_fetch($qry);
    

    // echo "<p>this is " . $gotName . "'s website" ;

    // agency info 
    $_SESSION['setID'] = $gotID;
    $_SESSION['setName'] = $gotName;
    $_SESSION['setDesc'] = $gotDesc;
    $_SESSION['setAdd'] = $gotAdd;
    $_SESSION['setManID'] = $gotManID;

    if(empty($gotPfPicture)) $gotPfPicture = '../../DefaultAgent.png';

    $_SESSION['setPfPicture'] = $gotPfPicture;

    if(empty($gotBanner)) $gotBanner = '../../DefaultBannerAgent.jpg';

    $_SESSION['setBanner'] = $gotBanner;

    $_SESSION['setTelNumber'] = $gotTelNumber;
    $_SESSION['setfblink'] = $gotfblink;
    $_SESSION['settwlink'] = $gottwlink;
    $_SESSION['setiglink'] = $gotiglink;
    $_SESSION['setEmail'] = $gotEmail;
    $_SESSION['isdeleted'] = $isdeleted;
    
    // manager info 
    $_SESSION['setMEmail'] = $gotMEmail;
    $_SESSION['setMName'] = $gotMName;
    $_SESSION['setMContact'] = $gotMContact;

    mysqli_stmt_close($qry);

    $fblink = '';
    $twlink = '';
    $iglink = '';

    
    // mysqli_stmt_bind_param($qry_sm, 'i',  $_SESSION['id']); //sets the parameters (?) above

    // mysqli_stmt_execute($qry_sm);
    // mysqli_stmt_bind_result($qry_sm, $smedia_name);
    // mysqli_stmt_fetch($qry_sm);



    // AGENCY PACKAGES
    
    $qry_packages = mysqli_query($conn, "SELECT PK.*, FORMAT(PK.packagePrice, 0) AS fresult,  AI.*
                                         FROM traveldb.package_tbl AS PK 
                                         INNER JOIN traveldb.agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                                         INNER JOIN traveldb.packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom 
                                         WHERE agencyID = $testdata
                                         GROUP BY AI.packageIDFrom");
   
}

function view_other($conn, $id){
    $id = mysqli_real_escape_string($conn, $id);
    $sql = mysqli_query($conn, "SELECT AG.*, CONCAT(US.fname, ' ', US.lname) AS fullname, US.email, US.contactnumber  FROM agency_tbl AS AG INNER JOIN user_tbl AS US ON AG.agencyManID=US.id WHERE agencyID=$id");
    $got = mysqli_fetch_array($sql);
    return $got;
}

function view_otherpack($conn, $id){
    $id = mysqli_real_escape_string($conn, $id);
    $sql = mysqli_query($conn, "SELECT PK.*, FORMAT(PK.packagePrice, 0) AS fresult,  AI.*
                                FROM traveldb.package_tbl AS PK 
                                INNER JOIN traveldb.agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                                LEFT JOIN traveldb.packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom 
                                WHERE packageCreator = $id AND (packageImg_Name LIKE 'PCK-F%' OR packageImg_Name IS NULL)
                                GROUP BY AI.packageIDFrom");
    // $got = mysqli_fetch_array($sql);
    return $sql;
}

?> 