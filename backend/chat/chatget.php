<?php 
session_start();
include_once __DIR__."/../../backend/connect/dbCon.php";

$pass = true;
if($pass == true){
    $sendto = mysqli_real_escape_string($conn, $_POST['outgoing_id']); //RECEIVER
    $receivefrom = mysqli_real_escape_string($conn, $_POST['incoming_id']); //SENDER
    $output = "";

    $sql = "SELECT MS.*, US.profpicture, US.id FROM message_tbl AS MS LEFT JOIN user_tbl AS US ON MS.messageFrom_id = US.id 
                                      WHERE (messageTo_id = {$sendto} AND messageFrom_id = {$receivefrom}) 
                                      OR (messageTo_id = {$receivefrom} AND messageFrom_id = {$sendto}) ORDER BY message_id";

    $qry = mysqli_query($conn, $sql);

    if(mysqli_num_rows($qry) > 0){
        while($row = mysqli_fetch_assoc($qry)){
            if(empty($row['profpicture'])) $row['profpicture'] = "../../DefaultProf.jpg";
            if($row['messageTo_id'] === $sendto){
                

                $output .= '<div class="chat outgoing">
                                <div class="details tooltip">
                                    <span class="tooltiptext">sent on '.$row['message_sent'].'</span>
                                    <p>'.$row['message'].'</p>
                                </div>
                            </div>';
            }else{
                
                $output .= '<div class="chat incoming">
                                <img src="../../assets/img/users/traveler/'.$row['messageFrom_id'].'/pfp/'.$row['profpicture'].'" alt="" class="">
                                <div class="details tooltip">
                                    <span class="tooltiptext">sent on '.$row['message_sent'].'</span>
                                    <p>'.$row['message'].'</p>
                                </div>
                            </div>';
            }
        }
    }
    echo $output;
}

?>