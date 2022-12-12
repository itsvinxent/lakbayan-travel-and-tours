<?php

function fetch_user_accounts($query_string, $conn)
{
    $qry_users = mysqli_query($conn, $query_string);
    $rowcount = mysqli_num_rows($qry_users);
    echo <<<END
                <div class="package-func">
                    <span>
                        <h3>$rowcount User(s)</h3>
                    </span>
                </div>
                <div class="package-table">
                <table>
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

    while ($row = mysqli_fetch_row($qry_users)) {
?>
        <tr>
            <td><?php echo $row[0] ?></td>
            <td><?php echo $row[1] ?></td>
            <td><?php echo $row[2] ?></td>
            <td><?php echo $row[3] ?></td>
            <td style="display: none"><?php echo $row[4] ?></td>
            <td><?php echo $row[5] ?></td>
            <td hidden><?php echo $row[6] ?></td>
            <td hidden><?php echo $row[7] ?></td>
            <td hidden><?php echo $row[8] ?></td>
            <td hidden><?php echo $row[9] ?></td>
            <td hidden><?php echo $row[10] ?></td>
            <td hidden><?php echo $row[11] ?></td>
            <td hidden><?php echo $row[12] ?></td>
            <td hidden><?php echo $row[13] ?></td>
            <td hidden><?php echo $row[14] ?></td>
            <td hidden><?php echo $row[15] ?></td>
            <td hidden><?php echo $row[16] ?></td>
            <td hidden><?php echo $row[17] ?></td>
            <td hidden><?php echo $row[18] ?></td>
            <td>
                <a href="<?php echo "user-profile.php?mode=view&id=".$row[0]; ?>" id="modalEOpen"><i class="far fa-user" style="font-size: 20px;"></i></a>
                <button type="button" id="modalDOpen" class="udelete-btn"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
<?php
    }
    echo '</tbody> </table> </div>';
}

?>