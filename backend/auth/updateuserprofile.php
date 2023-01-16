<?php



set_include_path(dirname(__FILE__));

include __DIR__ . '/../connect/dbCon.php';
require 'imgverification.php';
include __DIR__ . '/../cloudinary/cloudinary_instance.php';


session_start();




// ACCOUNT INFORMATION
$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$inEmail = $_POST['email'];
$inPass = $_POST['pass'];

$inImage = $_FILES['aPicture']['name'];
$inBan = $_FILES['aBanner']['name'];

if (empty($firstName)) $firstName = $firstName = $_SESSION['fname'];
if (empty($lastName)) $lastName = $_SESSION['lname'];
if (empty($inEmail)) $inEmail =  $_SESSION['email'];
if (empty($inPass)) $inPass =  $_SESSION['password'];
if ($inImage == null) $inImage = $_SESSION['profpic'];
if ($inBan == null) $inBan = $_SESSION['userbanner'];

// PERSONAL INFORMATION
$inTel = $_POST['contact'];
$inAdd = $_POST['address'];
$inBirth = strtotime($_POST['bday']);
$inGender = $_POST['gender'];
$inRace = $_POST['race'];
$inNat = $_POST['nationality'];
$inReligion = $_POST['religion'];

if (empty($inBirth)) {
    $inBirth = date("Y-m-d", strtotime($_SESSION['birthday']));
} else $inBirth = date("Y-m-d", $inBirth);

if (empty($inAdd)) $inAdd =  $_SESSION['address'];
if (empty($inTel)) $inTel = $_SESSION['contact'];
if (empty($inGender)) $inGender = $_SESSION['gender'];
if (empty($inRace)) $inRace = $_SESSION['race'];
if (empty($inNat)) $inNat = $_SESSION['nationality'];
if (empty($inReligion)) $inReligion = $_SESSION['religion'];

//SQL FILTER 
$firstName = mysqli_real_escape_string($conn, $firstName);
$lastName = mysqli_real_escape_string($conn, $lastName);
$inEmail = mysqli_real_escape_string($conn, $inEmail);
$inPass = mysqli_real_escape_string($conn, $inPass);

$inTel = mysqli_real_escape_string($conn, $inTel);
$inAdd = mysqli_real_escape_string($conn, $inAdd);
$inGender = mysqli_real_escape_string($conn, $inGender);
$inRace = mysqli_real_escape_string($conn, $inRace);
$inNat = mysqli_real_escape_string($conn, $inNat);
$inReligion = mysqli_real_escape_string($conn, $inReligion);



$userID = $_SESSION['id'];

// IMAGE DIRECTORY CHECK
$placehere = '../../assets/img/users/traveler/' . $userID . '/pfp/';
$placecloud = 'assets/img/users/traveler/' . $userID . '/pfp/';
//checks if dir exist and makes one if it does not
if (!file_exists($placehere)) {
    mkdir($placehere, 0777, true);
}

$placeban = '../../assets/img/users/traveler/' . $userID . '/banner/';
$cloudban = 'assets/img/users/traveler/' . $userID . '/banner/';
//checks if dir exist and makes one if it does not
if (!file_exists($placeban)) {
    mkdir($placeban, 0777, true);
}

include_once __DIR__ . "/../../backend/notifications/notification_model.php";

// echo 'the email is '.$checking.' checked!';

$img = array();
$chk = array();
$nope = 1;

// echo $inBirth;

// echo "BITCH ".$nope;



if (isset($_POST['submit']) && $nope == 1) {
    //IMAGE CHECK
    $img = $_FILES['aPicture'];
    $chk = image_verification($img);

    //BANNER CHECK
    $ban = $_FILES['aBanner'];
    $chkban = image_verification($ban);

    if ($chk == false && $img['error'] != 4) {
        echo 'There was a problem with the image';
    } else {

        //PROFILE
        $updated = rename_image($img, "PFP-TR-");
        $trimmed_img = trim($updated, '.' . strtolower(pathinfo($img['name'], PATHINFO_EXTENSION)) . '');
        $uploadto = $placehere . $updated;

        if ($img['error'] == 4) $updated = $inImage;

        //BANNER
        $updatedban = rename_image($ban, "BAN-TR-");
        $trimmed_ban = trim($updatedban, '.' . strtolower(pathinfo($ban['name'], PATHINFO_EXTENSION)) . '');
        $uploadban = $placeban . $updatedban;

        if ($ban['error'] == 4) $updatedban = $inBan;

        if ($inPass == $_SESSION['password']) {
            $newpass = $_SESSION['password'];
        } else $newpass = password_hash($inPass, PASSWORD_BCRYPT);

        if (!$conn) {
        } else {

            $qry = "UPDATE user_tbl AS US 
                    SET fname='$firstName',
                        lname='$lastName',
                        `address`='$inAdd',
                        email='$inEmail',
                        contactnumber= '$inTel',
                        profpicture='$updated',
                        userbanner='$updatedban',
                        `password`='$newpass', 
                        birthday='$inBirth',
                        gender='$inGender',
                        race='$inRace',
                        religion='$inReligion',
                        nationality='$inNat'
                    WHERE id = $userID"; //Replace with Session

            if (mysqli_query($conn, $qry)) {
                sendNotification($userID, "profile", "You successfully edited your profile!");

                if ($img['error'] != 4) {
                    $cloudinary->uploadApi()->upload("$img[tmp_name]", [
                        'folder' => $placecloud,
                        'public_id' => $trimmed_img
                    ]);
                    move_uploaded_file($img['tmp_name'], $uploadto);
                }


                if ($ban['error'] != 4) {
                    $cloudinary->uploadApi()->upload("$ban[tmp_name]", [
                        'folder' => $cloudban,
                        'public_id' => $trimmed_ban
                    ]);
                    move_uploaded_file($ban['tmp_name'], $uploadban);
                }
                echo '<meta http-equiv="refresh" content="0;URL=../../user-profile.php" />';
            } else {
                echo "ERROR: Could not execute $sql. " . mysqli_error($link);
            }
        }
    }
}
