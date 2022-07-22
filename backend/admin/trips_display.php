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
        function getUserDetails($conn, $ID){

            $query = "SELECT fname, lname, email FROM traveldb.user_tbl WHERE id='$ID'; " ;
            $result = mysqli_query($conn, $query);
            return $result;
        }        
        $select_query = "SELECT * FROM traveldb.trips_tbl; " ;
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
                        <th>Contact #</th>
                        <th># of persons</th>
                        <th>Start Date</th>
                        <th># of days</th>
                        <th>Message</th>
                        <th>Package Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            END; 
            while($row = mysqli_fetch_row($result)){
                $record = getUserDetails($conn, $row[1]);
                $recrow = mysqli_fetch_row($record);
                echo<<<END
                    <tr>
                        <td>$row[0]</td>
                        <td style="display:none;">$row[1]</td>
                        <td>$recrow[0]</td>
                        <td>$recrow[1]</td>
                        <td>$recrow[2]</td>
                        <td>$row[2]</td>
                        <td>$row[3]</td>
                        <td>$row[4]</td>
                        <td>$row[5]</td>
                        <td>$row[6]</td>
                        <td>$row[7]</td>
                        <td>
                            <button type="button" id="modalEOpen" class="edit-btn"><i class="far fa-edit"></i></button>
                            <a href="backend/admin/trips_delete.php?id='$row[0]'&user_id='$row[1]';">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                            
                        </td>
                    </tr> 
                
                END;
            }
            echo "</tbody></table> ";
            // echo<<<END
            //     <button type="button" id="modalBOpen" class="add-btn">Create New Record</button>
            // END;
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