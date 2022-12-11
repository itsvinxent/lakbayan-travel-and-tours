<?php 

function sendNotification($id, $category, $content){
    include __DIR__."/../../backend/connect/dbCon.php";

    if(mysqli_connect_error()){
        echo<<<END
                <script type ="text/JavaScript">  
                alert("ERROR. Failed connecting to databasee")
                </script>
            END;
    }else{
        $id = mysqli_real_escape_string($conn, $id);
        $category = mysqli_real_escape_string($conn, $category);
        $content = mysqli_real_escape_string($conn, $content);

        $sql_notification = "INSERT INTO notification_tbl (notification_to,
                                                        notification_content,
                                                        notification_category,
                                                        notification_sent) VALUES ('$id',
                                                                                    '$content',
                                                                                    '$category',
                                                                                    now())";


        if($conn->query($sql_notification)){
            
        }else{
            echo<<<END
                <script type ="text/JavaScript">  
                alert("ERROR. There's an error with your query")
                </script>
            END;
        }
    }
}
    

?> 