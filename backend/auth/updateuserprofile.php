<?php
set_include_path(dirname(__FILE__));

require 'imgverification.php';
session_start();



$inName = $_POST['inName'];
$inAdd = $_POST['inAdd'];
$inEmail = $_POST['inEmail'];
$inTel = $_POST['inTel'];
$inImage = $_FILES['inPicture']['name'];

if ($inImage == null) {
    echo 'im null';

    $inImage = $_SESSION['profpic'];

    echo $inImage;
}
if (empty($inName)) 
    {
        $firstName = $_SESSION['fname'];
        $lastName = $_SESSION['lname'];
    } else {
        $reversedName = explode(' ', strrev($inName), 2);
        $lastName = strrev($reversedName[0]);
        $firstName = strrev($reversedName[1]);
    }

if (empty($inAdd)) $inAdd =  $_SESSION['address'];
if (empty($inEmail)) $inEmail =  $_SESSION['email'];
if (empty($inTel)) $inTel = $_SESSION['contact'];


$userID = $_SESSION['id'];

$placehere = '../../assets/img/users/traveler/'.$userID.'/pfp/';

//checks if dir exist and makes one if it does not
if(!file_exists($placehere)){
    mkdir($placehere, 0777, true);
}


include '..\connect\dbCon.php';

// echo 'the email is '.$checking.' checked!';

// if (isset($_POST['submit']) && isset($_FILES['inPicture'])){
//     $imgName = $_FILES['inPicture']['name'];
//     $imgSize = $_FILES['inPicture']['size'];
//     $imgTemp = $_FILES['inPicture']['tmp_name'];
//     $imgError = $_FILES['inPicture']['error'];

//     if ($imgError === 0){

//         if(!($imgSize > 5000000)){
//             $imgAllowed = pathinfo($imgName, PATHINFO_EXTENSION); 
//             $toLower = strtolower($imgAllowed);
//             $allowedExt = array("jpg", "jpeg", "png");

//             if(in_array($toLower, $allowedExt)){
//                 $updatedName = uniqid("PFP-", true).'.'.$toLower; //NAME TO PUT TO DATABASE
//                 $uploadToFile = '../../assets/img/users/traveler/'.$userID.'/pfp/'.$updatedName; //UPLOAD LOC
            
            
//             }
//         }
        
//     }else if($imgError == 4){

//     }else{

//     }

// }
$img = array();
$chk = array();
$nope = 0;

echo "BITCH ".$nope;

if (isset($_FILES['inPicture']) && isset($_POST['submit']) && $nope == 1){
    $img = $_FILES['inPicture'];
    $chk = image_verification($img);

    if($chk == false && $img['error'] != 4){

        echo 'There was a problem with the image';
    }else{
    
        $temploc = $img['tmp_name'];
        $extension = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
        $updated = uniqid("PFP-TR-", true).'.'.$extension;
    
        $uploadto = $placehere.$updated;

        if($img['error'] == 4) $updated = $inImage;

        if (!$conn){
    
        }else{
        
            $qry = "UPDATE user_tbl AS US 
                           SET fname='$firstName',
                               lname='$lastName',
                               `address`='$inAdd',
                               email='$inEmail',
                               contactnumber= $inTel,
                               profpicture='$updated'
                            WHERE id = $userID"; //Replace with Session
        
            if (mysqli_query($conn, $qry)){
                echo '<meta http-equiv="refresh" content="0;URL=../../user-profile.php" />';
                if ($img['error'] != 4) move_uploaded_file($temploc, $uploadto);
                
            }else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        
                
            }
        }
        
    
        
    }
}






?>