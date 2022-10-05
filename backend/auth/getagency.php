<?php

include 'backend\connect\dbCon.php';

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
    mysqli_stmt_bind_result($qry, $gotID, $gotName, $gotDesc, $gotAdd, $gotManID, $gotManPass, $gotPfPicture, $gotTelNumber, $gotEmail, $gotMName, $gotMContact);
    mysqli_stmt_fetch($qry);
    

    // echo "<p>this is " . $gotName . "'s website" ;

    // agency info 
    $_SESSION['setID'] = $gotID;
    $_SESSION['setName'] = $gotName;
    $_SESSION['setDesc'] = $gotDesc;
    $_SESSION['setAdd'] = $gotAdd;
    $_SESSION['setManID'] = $gotManID;
    $_SESSION['setManPass'] = $gotManPass;
    $_SESSION['setPfPicture'] = $gotPfPicture;
    $_SESSION['setTelNumber'] = $gotTelNumber;
    $_SESSION['setEmail'] = $gotEmail;

    // manager info 
    $_SESSION['setMName'] = $gotMName;
    $_SESSION['setMContact'] = $gotMContact;

    mysqli_stmt_close($qry);


    // AGENCY PACKAGES
    
    $qry_packages = mysqli_query($conn, "SELECT PK.*, FORMAT(PK.packagePrice, 0) AS fresult,  AI.*
                                         FROM traveldb.package_tbl AS PK 
                                         INNER JOIN traveldb.agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                                         INNER JOIN traveldb.packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom 
                                         WHERE agencyID = $testdata
                                         GROUP BY AI.packageIDFrom");
   
}
?> 