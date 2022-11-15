<?php 

while($row = mysqli_fetch_assoc($sql)){
    // $result = $row['message'];
    $sql1 = "SELECT * FROM message_tbl WHERE (messageFrom_id = {$row['id']} OR messageTo_id = {$row['id']}) AND (messageFrom_id = {$user} OR messageTo_id = {$user}) ORDER BY message_id DESC LIMIT 1";
    $qry1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($qry1);
    $me = "";
    if(mysqli_num_rows($qry1) > 0){
        $result = $row1['message'];
    }else $result = "Start your conversation";

    (strlen($result) > 15) ? $msg = substr($result, 0, 16).'...' : $msg = $result;
    if(isset($row1['messageFrom_id']))($user == $row1['messageFrom_id']) ? $me = "You: " : $me =  "";

    if(empty($row['profpicture'])) $row['profpicture'] = "../../DefaultProf.jpg";
    $output .= '<a href="?chatid='.$row['id'].'">
                    <div class="content">
                        <img src="../../assets/img/users/traveler/'.$row['id'].'/pfp/'.$row['profpicture'].'" alt="">
                        <div class="details">
                            <span>'.$row['fname'].' '.$row['lname'].'</span>
                            <p>'.$me.$msg.'</p>
                        </div>
                    </div>
                </a>';
}


?>