<?php 
    function fetch_agencytbl($query_string, $conn)
    {
        $qry_agencies = mysqli_query($conn, $query_string);
        $rowcount = mysqli_num_rows($qry_agencies);
            echo 
                "<div class='package-func'>
                    <span>
                        <h3>$rowcount Accounts</h3>
                    </span>";
                    
            echo <<<END
                </div>
                <div class="package-table">
                <table>
                <thead>
                    <tr>
                    <th><input type="checkbox"></th>
                    <th>ID</th>
                    <th>Agency Name</th>
                    <th>Agency Manager</th>
                    <th>Accreditation #</th>
                    <th>Verification Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            END;

        while ($row = mysqli_fetch_array($qry_agencies)) {
        ?>
            <tr>
                <td><input type="checkbox" name="todelete[]"></td>
                <td><?php echo $row['agencyID'] ?></td>
                <td><?php echo $row['agencyName'] ?></td>
                <td><?php echo $row['fullname'] ?></td>
                <td><?php echo $row['agencyAccreditation'] ?></td>
                <td><?php echo ucfirst($row['verificationStat']); ?></td>
                <td style="text-align: left;" class="approve-stat-btn">
                    <button type="button" style="color: var(--logo-blue-dark)"><i class="far fa-edit"></i></button>
                </td>
                <td hidden><?php echo $row['agencyImageProof'] ?></td>
                <td hidden><?php echo $row['is_found'] ?></td>
            </tr>
    <?php
        }
        echo '</tbody> </table> </div>';
        // mysqli_close($conn);
    }

?>