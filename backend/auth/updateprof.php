<?php 
set_include_path(dirname(__FILE__));

include __DIR__.'/../connect/dbCon.php';
require 'imgverification.php';
include __DIR__ . '/../cloudinary/cloudinary_instance.php';

    // echo $_POST['id'];
    // echo $_POST['picturefile'];
    // echo $_POST['fname'];
    // echo $_POST['lname'];
    // echo $_POST['email'];
    // echo $_POST['pass'];
    // echo $_POST['usertype'];
    // echo $_POST['bday'];
    // echo $_POST['age'];
    // echo $_POST['gender'];
    // echo $_POST['address'];
    // echo $_POST['contact'];
    // echo $_POST['race'];
    // echo $_POST['nationality'];
    // echo $_POST['religion'];


session_start();

$upName = $_POST['profName'];
$upDesc = $_POST['profDesc'];
$upAdd = $_POST['profAdd'];
$upEmail = $_POST['profEmail'];
$upTel = $_POST['profTel'];
$upImage = $_FILES['profPicture']['name'];
$upBanner = $_FILES['profBanner']['name'];

if ($upImage == null) $upImage = $_SESSION['setPfPicture'];
if ($upBanner == null) $upBanner = $_SESSION['setBanner'];

$upfb = $_POST['infblink'];
$uptw = $_POST['intwlink'];
$upig = $_POST['iniglink'];


if (empty($upName)) $upName = $_SESSION['setName'];
if (empty($upDesc)) $upDesc = $_SESSION['setDesc'];
if (empty($upAdd)) $upAdd = $_SESSION['setAdd'];
if (empty($upEmail)) $upEmail = $_SESSION['setEmail'];
if (empty($upTel)) $upTel = $_SESSION['setTelNumber'];
if (empty($upfb)) $upfb = $_SESSION['setfblink'];
if (empty($uptw)) $uptw = $_SESSION['settwlink'];
if (empty($upig)) $upig = $_SESSION['setiglink'];

//SQL FILTER 
$upName = mysqli_real_escape_string($conn, $upName);
$upDesc = mysqli_real_escape_string($conn, $upDesc);
$upAdd = mysqli_real_escape_string($conn, $upAdd);
$upEmail = mysqli_real_escape_string($conn, $upEmail);
$upTel = mysqli_real_escape_string($conn, $upTel);
$upfb = mysqli_real_escape_string($conn, $upfb);
$uptw = mysqli_real_escape_string($conn, $uptw);
$upig = mysqli_real_escape_string($conn, $upig);

$agencyID = $_SESSION['setID'];
$userID = $_SESSION['id'];

$placehere = '../../assets/img/users/travelagent/'.$agencyID.'/pfp/';
$pfpcloud = 'assets/img/users/travelagent/'.$agencyID.'/pfp/';

$placebanhere = '../../assets/img/users/travelagent/'.$agencyID.'/banner/';
$bancloud = 'assets/img/users/travelagent/'.$agencyID.'/banner/';

//checks if dir exist and makes one if it does not
if(!file_exists($placehere)){
    mkdir($placehere, 0777, true);
}

if(!file_exists($placebanhere)){
    mkdir($placebanhere, 0777, true);
}

include_once __DIR__."/../../backend/notifications/notification_model.php";

if (isset($_POST['submitupdate']) ){
    $img = $_FILES['profPicture'];
    $banner = $_FILES['profBanner'];

    $chk = image_verification($img);
    $chkbanner = image_verification($banner);

    if ($chk == false && $chkbanner == false && $img['error'] != 4){

    }else{

        $updated = rename_image($img, "PFP-"); 
        $trimmed_img = trim($updated, '.' . strtolower(pathinfo($img['name'], PATHINFO_EXTENSION)) . '');
        $uploc = $placehere.$updated;

        $updatedban = rename_image($banner, "PFB-"); 
        $trimmed_ban = trim($updatedban, '.' . strtolower(pathinfo($banner['name'], PATHINFO_EXTENSION)) . '');
        $uplocban = $placebanhere.$updatedban;

        if($img['error'] == 4) $updated = $upImage;
        if($banner['error'] == 4) $updatedban = $upBanner;

        if (mysqli_connect_error()){
                echo<<<END
                <script type ="text/JavaScript">  
                alert("Failed Connecting to Database")
                </script>
                END;
            }else{
            
                $qry = "UPDATE agency_tbl AS AG,
                                user_tbl AS US 
                                SET agencyName='$upName',
                                    agencyDescription= '$upDesc',
                                    agencyAddress='$upAdd',
                                    agencyEmail='$upEmail',
                                    agencyTelNumber= '$upTel',
                                    agencyPfPicture= '$updated',
                                    agencyBanner= '$updatedban',
                                    agencyFacebook='$upfb',
                                    agencyTwitter='$uptw',
                                    agencyInsta='$upig'
                                WHERE agencyID = $agencyID AND id=$userID"; //Replace with Session
                
            if (mysqli_query($conn, $qry)){

                sendNotification($userID, "profile", "You successfully edited your agency profile!");

                if($img['error'] != 4) {
                    $cloudinary->uploadApi()->upload("$img[tmp_name]", [
                        'folder' => $pfpcloud,
                        'public_id' => $trimmed_img
                    ]);

                    move_uploaded_file($temploc, $uploc);
                }

                if($banner['error'] != 4) {
                    $cloudinary->uploadApi()->upload("$banner[tmp_name]", [
                        'folder' => $bancloud,
                        'public_id' => $trimmed_ban
                    ]);

                    move_uploaded_file($templocbanner, $uplocban);
                }
                
                echo '<meta http-equiv="refresh" content="0;URL=../../agency-profile.php" />';
            }else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
            }
        }
    }
}

// echo 'the email is '.$checking.' checked!';




?>
