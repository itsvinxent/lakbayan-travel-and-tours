<?php 
session_start();
include_once __DIR__."/../../backend/connect/dbCon.php";

$user = mysqli_real_escape_string($conn, $_SESSION['id']);
$pass = true;
$output = "";
$sql = mysqli_query($conn, "SELECT * FROM user_tbl AS US INNER JOIN message_tbl AS MS ON (US.id = MS.messageFrom_id OR US.id = MS.messageTo_id)
                                                         WHERE (messageTo_id = {$user} OR messageFrom_id={$user}) AND US.id<>{$user}
                                                         GROUP BY id 
                                                         HAVING COUNT(`message`) > 0 
                                                         ORDER BY message_id DESC");
// if(mysqli_num_rows($sql) == 1){
//     $output .= "No users available";
// }
    if(mysqli_num_rows($sql) > 0 ){
        include __DIR__."/users.php";
}
echo $output;
?>
