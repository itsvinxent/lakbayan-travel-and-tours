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
        $select_query = "SELECT * FROM traveldb.user_tbl; " ;
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
                        <td>
                            <button type="button" id="modalEOpen" class="edit-btn"><i class="far fa-edit"></i></button>
                            <a href="backend/admin/user_delete.php?id='$row[0]';">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr> 
                
                END;
            }
            echo "</tbody></table> ";
            echo<<<END
                <button type="button" id="modalBOpen" class="add-btn">Create New Account</button>
            END;
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