<?php 

session_start();
include_once "..\..\backend\connect\dbCon.php";
$user = mysqli_real_escape_string($conn, $_SESSION['id']);
$searchterm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
$output = "";

$sql = mysqli_query($conn, "SELECT id, lname, fname, profpicture FROM user_tbl WHERE (fname LIKE '%{$searchterm}%' OR lname LIKE '%{$searchterm}%')")  or die();
if(mysqli_num_rows($sql) > 0){
    include "users.php";
    // while($row = mysqli_fetch_assoc($sql)){
    //     if(empty($row['profpicture'])) $row['profpicture'] = "../../DefaultProf.jpg";
    //     $output .= '<a href="chatbox.php?id='.$row['id'].'">
    //                     <div class="content">
    //                         <img src="../../assets/img/users/traveler/'.$row['id'].'/pfp/'.$row['profpicture'].'" alt="">
    //                         <div class="details">
    //                             <span>'.$row['fname'].' '.$row['lname'].'</span>
    //                             <p>last message sent</p>
    //                         </div>
    //                     </div>
    //                 </a>';
    // }
}else {
    $output .= "No user found";
}
echo $output;
?>