<?php 
    include 'backend/connect/dbCon.php';

    if(mysqli_connect_error()){
        echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Failed connecting to databasee")
            </script>
        END;
    }
    else{ 
        $select_query = "SELECT * FROM traveldb.user_tbl where is_deleted = 0; " ;
        $result = mysqli_query($conn, $select_query);

        if ($result){ 
            echo<<<END
                <table id="userTable" class="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        
                        <th>Usertype</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            END; 
            while($row = mysqli_fetch_row($result)){
                echo<<<END
                    <tr>
                        <td>$row[0]</td>
                        <td>$row[1]</td>
                        <td>$row[2]</td>
                        <td>$row[3]</td>
                        <td style="display: none">$row[4]</td>
                        <td>$row[5]</td>
                        <td hidden>$row[6]</td>
                        <td hidden>$row[7]</td>
                        <td hidden>$row[8]</td>
                        <td hidden>$row[9]</td>
                        <td hidden>$row[10]</td>
                        <td hidden>$row[11]</td>
                        <td hidden>$row[12]</td>
                        <td hidden>$row[13]</td>
                        <td hidden>$row[14]</td>
                        <td hidden>$row[15]</td>
                        <td hidden>$row[16]</td>
                        <td hidden>$row[17]</td>
                        <td hidden>$row[18]</td>
                        <td>
                            <button type="button" id="modalEOpen" class="uedit-btn"><i class="far fa-edit"></i></button>
                            <button type="button" id="modalDOpen" class="udelete-btn"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr> 
                
                END;
            }
            echo "</tbody></table> ";

        }
        else{
            echo<<<END
                <script type ="text/JavaScript">  
                alert("ERROR FETCHING TABLE")
                </script>
            END;
        }

    }

?>