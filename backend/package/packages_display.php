<?php

// Function for displaying in the Main Package Page and the Travel Agency Profile Page (View Mode)
function fetch_packages($query_string, $conn, $editmode)
{

    $qry_packages = mysqli_query($conn, $query_string);

    while ($row = mysqli_fetch_array($qry_packages)) {
?>
        <div class="wrapper">
            <input type="hidden" id="packageid" value="<?php echo $row['packageID']?>"/>
            <div class="border"></div>
            <div class="image">
                <?php
                // echo '<img src="data:image/jpg;base64,' . base64_encode($row['packageImg_Name']) . '" alt="" style="height: 160px;"/>';
                if (isset($row['packageImg_Name'])){
                    echo '<img src="assets/img/users/travelagent/'.$row['packageCreator'].'/package/'.$row['packageID'].'/img/'.$row['packageImg_Name'].'" alt=""/>';}
                else echo '<img src="assets/img/Missing.jpeg" alt=""/>';
                // echo '<img src="users/travelagent/' .$row['packageCreator']. 'package/' .$row['packageID']. '//img//' . $row['packageImg_Name'] . " alt="" style="height: 160px;"/>';
                ?>
            </div>
            <div class="content">
                <h2><?php echo $row['packageTitle'] ?></h2>
                <p style="font-size: 12px;">by
                <a href="agency-profile.php?mode=view&id=<?php echo $row['packageCreator'] ?>"> <?php echo $row['agencyName'] ?> </a> 
                </p>
                <div class="rating">
                    <?php
                    for ($i = 0; $i < $row['packageRating']; $i++) {
                        echo '<i class="fas fa-star" style="padding-right: 3px;"></i>';
                    }
                    ?>
                </div>
                <div class="price">
                    <p class="amt"><?php echo $row['fresult'] ?></p>
                    <p style="font-size: 12px;">PER PERSON</p>
                </div>
            </div>
            <?php if ($editmode) { 
                echo <<<END
                    <div class="edit-btn">
                    <a href="includes/packages/ruins.php">
                        <i class="fas fa-pen" style="padding-right: 7px;"></i>
                        Edit
                    </a>
                    </div>
                    <div class="delete-btn">
                        <a href="includes/packages/ruins.php">
                            <i class="far fa-trash-alt" style="padding-right: 7px;"></i>
                            Delete
                        </a>
                    </div>
                END;
            } else {
                echo "<div class='learn-btn'>
                    <a href='includes/packages/details.php?packageid={$row['packageID']}'>
                        Learn More
                    </a>
                </div>";
            }
            ?>
            
            
        </div>
    <?php
    }
    // mysqli_close($conn);
}

// Function for displaying Package Table in the Administrator Packages Page
// and the Travel Agency "My Packages" Tab (Edit Mode)
function fetch_packagetbl($query_string, $conn, $withAdd)
{
    $qry_packages = mysqli_query($conn, $query_string);
    $rowcount = mysqli_num_rows($qry_packages);
        echo 
            "<div class='package-func'>
                <span>
                    <h3>$rowcount Packages</h3>
                </span>";

        if ($withAdd) {
            echo '<span>
                    <button id="package-create" data-tab-target="#create-package" class="resetting"><i class="fas fa-plus"></i>Add New Package</button>
                </span>';
        }
                
        echo <<<END
            </div>
            <div class="package-table">
            <table>
              <thead>
                <tr>
                  <th><input type="checkbox"></th>
                  <th>ID</th>
                  <th>Package Name</th>
                  <th></th>
                  <th>Duration(Days)</th>
                  <th>Price</th>
                  <th>Rating</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
        END;

    while ($row = mysqli_fetch_array($qry_packages)) {
    ?>
        <tr>
            <td><input type="checkbox" name="todelete[]"></td>
            <td><?php echo $row['packageID'] ?></td>
            <td><?php echo $row['packageTitle'] ?></td>
            <td style="font-size: 12px;">
                <i class="far fa-eye" style="margin-right: 3px;"></i><?php echo $row['packageImpressions'] ?>
                <i class="far fa-heart" style="margin-right: 3px;"></i><?php echo $row['packageHearts'] ?>
            </td>
            <td><?php echo $row['packagePeriod'] ?></td>
            <td><?php echo $row['fresult'] ?></td>
            <td>
                <div class="rating">
                    <?php
                        for ($i = 0; $i < $row['packageRating']; $i++) {
                            echo '<i class="fas fa-star" style="padding-right: 3px;"></i>';
                        }
                    ?>
                </div>
            </td>
            <td>
                <button type="button" data-tab-target="#create-package" id="modalEOpen" class="pack-edit-btn resetting" onclick='changeForm()'><i class="far fa-edit"></i></button>
                <button type="button" id="modalDOpen" class="delete-btn"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
<?php
    }
    echo '</tbody> </table> </div>';
    // mysqli_close($conn);
}

// Function for displaying Bookings Table in the Administrator Bookings Page,
// Travel Agency "My Transactions" Tab (Edit Mode), and Traveler Bookings Tab
function fetch_bookingtbl($query_string, $conn) {
    $qry_bookings = mysqli_query($conn, $query_string);
    $rowcount = mysqli_num_rows($qry_bookings);
    echo <<<END
            <div class="package-func">
                <span>
                    <h3>$rowcount Transaction(s)</h3>
                </span>
            </div>
            <div class="package-table">
            <table>
              <thead>
                <tr>
                  <th><input type="checkbox"></th>
                  <th>ID</th>
                  <th>TRN</th>
                  <th>Customer Name</th>
                  <th>Package Name</th>
                  <th>Total Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
        END;

    while ($row = mysqli_fetch_array($qry_bookings)) {
    ?>
        <tr>
            <td><input type="checkbox" name="todelete[]"></td>
            <td><?php echo $row['bookingID'] ?></td>
            <td><?php echo $row['bookingTransacNum'] ?></td>
            <td><?php echo $row['fullname'] ?></td>
            <td><?php echo $row['packageTitle'] ?></td>
            <td><?php echo $row['bookingStatus'] ?></td>
            <td><?php echo $row['bookingPrice'] ?></td>
            <td>
                <button type="button" data-tab-target="#edit-booking" id="modalEOpen" class="book-edit-btn"><i class="far fa-edit"></i></button>
                <button type="button" id="modalDOpen" class="delete-btn"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
<?php
    }
    echo '</tbody> </table> </div>';
    // mysqli_close($conn);
}

function fetch_package_by_id($package_qry, $categ_qry, $loc_qry, $img_qry, $inc_qry, $conn) {
    // $qry_package = mysqli_query($conn, $query_string);
    // $row = mysqli_fetch_array($qry_package);

    // echo json_encode($row);

    $qry_package = mysqli_query($conn, $package_qry);
    $package = mysqli_fetch_array($qry_package);
    $_SESSION['PACKAGE_ID'] = $package['packageID'];

    $qry_categ = mysqli_query($conn, $categ_qry);
    $cat_array = array();
    
    while ($category = mysqli_fetch_assoc($qry_categ)) {
        $cat_array[] = $category['packageCategory'];
        $_SESSION['CATEGORY_GOT'] = $cat_array;
    }

    $qry_loc = mysqli_query($conn, $loc_qry);
    $loc_array = array();
    
    while ($location = mysqli_fetch_assoc($qry_loc)) {
        $loc_array[] = $location['City'];
        $_SESSION['LOCATIONS_GOT'] = $loc_array;
    }

    $qry_img = mysqli_query($conn, $img_qry);
    $img_array = array();
    
    while ($image = mysqli_fetch_assoc($qry_img)) {
        $img_array[] = $image['packageImg_Name'];
        $_SESSION['IMAGES_GOT'] = $img_array;
    }

    $qry_incl = mysqli_query($conn, $inc_qry);
    $inc_array = array();
    
    while ($inclusion = mysqli_fetch_assoc($qry_incl)) {
        $inc_array[] = $inclusion['packageInclusion'];
    }

    $jsondata = json_encode(
        array("details" => $package, 
            "category" => $cat_array,
            "location" => $loc_array,
            "images" => $img_array,
            "inclusions" => $inc_array
        )
    );

    return $jsondata;

}

?>