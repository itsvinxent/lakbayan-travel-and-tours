<?php

// Function for displaying in the Main Package Page and the Travel Agency Profile Page (View Mode)
function fetch_packages($query_string, $conn, $editmode, $limit, $page)
{   
    $start_from = ($page - 1) * $limit;
    $limit_string = $query_string ." LIMIT $start_from, $limit";
    // echo $limit_string;
    $qry_packages = mysqli_query($conn, $limit_string) or die(mysqli_error($conn));
    

    while ($row = mysqli_fetch_array($qry_packages)) {
?>
        <div class="wrapper">
            
            <?php 
                if(isset($row['preferred']))
                    echo "<div class='preferred__content'>     
                        <span>Preferred</span><i class=\"fa-solid fa-location-dot fa-xs fa-bounce\"></i>
                        </div>";
                if(isset($row['priority'])){
                    echo "<div class='recommended__content'>     
                    <span>Recommended</span>
                    </div>
                    <div class='recommended__icon'>     
                    <i class=\"fa-solid fa-users fa-xl\"></i>
                    </div>";
                }
            ?>
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
                        $averageRating = $row['packageRating'];
                        $stars = 5;
                        $wholeNum = floor($averageRating);
                        $decimal = $averageRating - $wholeNum;

                        for ($i = 0; $i < $wholeNum; $i++) {
                            echo '<i class="fas fa-star"></i>';
                            $stars--;
                        }

                        if ($decimal != 0) {
                            if ($decimal <= 0.5) {
                            echo '<i class="fas fa-star-half-alt"></i>';
                            } else {
                            echo '<i class="fas fa-star"></i>';
                            }
                            $stars--;
                        }

                        for ($i=0; $i < $stars; $i++) { 
                            echo '<i class="far fa-star"></i>';
                        }
            
                    ?>
                    
                </div>
                <div class="price" style="display: flex; justify-content: space-between; align-items: self-end;">
                    <span>
                        <p class="amt"><?php echo $row['fresult'] ?></p>
                        <p style="font-size: 12px;">PER PERSON</p>
                    </span>
                    <p>
                    <?php 
                        $starting_date = new DateTime($row['packageStartDate']);
                        $ending_date = new DateTime($row['packageEndDate']);
                        $duration = $starting_date->diff($ending_date);

                        if ($duration->days != 0) {
                            echo $duration->days .'-day trip';
                        } else {
                            echo $duration->h .'-hour trip';
                        }
                    ?> 
                    </p>
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
                    <a href='includes/packages/details.php?packageid={$row['packageID']}&agentid={$row['packageCreator']}'>
                        Learn More
                    </a>
                </div>";
            }
            ?>
            
            
        </div>
    <?php
    } 
    $qry_packages = mysqli_query($conn, $query_string);
    $total_records = mysqli_num_rows($qry_packages);
    $total_pages = ceil($total_records/$limit);
    if ($total_pages != 0) {
        if ($total_pages != 1) {
    ?>
        <div id="app" class="container">  
            <ul class="page">
                <li class="page__btn" id="<?php if ($page > 1) echo $page - 1; ?>"><i class="fas fa-chevron-left"></i></li>
                <?php 
                    
                    for ($i=1; $i <= $total_pages; $i++) { 
                        $class = 'page__numbers';
                        if ($i == $page) {
                            $class .= ' active';
                        }
                        echo "<li class='$class'>$i</li>";
                    }
                ?>
                <li class="page__btn" id="<?php if ($page < $total_pages) echo $page + 1;?>"><i class="fas fa-chevron-right"></i></li>
            </ul>
        </div>
<?php
    // mysqli_close($conn);
        }
    } else {
        echo<<<END
        <div class="loading" id="no-results" style="display: flex; flex-direction: column; justify-content: center; margin: auto; align-items: center; gap: 15px;">
          <img src="https://img.icons8.com/fluency/48/null/unknown-results.png"/> <h3>No Results. Try another filter/keyword.</h3>
        </div>
        END;
    }
    
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
                  <th>Status</th>
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
            <td><?php if ($row['packageStatus'] == 0) echo "Available"; else echo "Unlisted"; ?></td>
            <td>
                <div class="rating">
                    <?php
                        $stars = 5;
                        for ($i = 0; $i < $row['packageRating']; $i++) {
                            echo '<i class="fas fa-star" style="padding-right: 3px;"></i>';
                            $stars--;
                        }
                        for ($i=0; $i < $stars; $i++) { 
                            echo '<i class="far fa-star" style="padding-right: 3px;"></i>';
                        }
                    ?>
                </div>
            </td>
            <td hidden><?php echo $row['packageCreator'] ?></td>
            <td>
                <button title="View Package" type="button" class="pack-view-btn" onclick="viewPackage(this);"><i class="far fa-eye"></i></button>
                <button title="Edit Package" type="button" data-tab-target="#create-package" id="modalEOpen" class="pack-edit-btn resetting" onclick='changeForm()'><i class="far fa-edit"></i></button>
                <button title="Unlist/Delist Package" type="button" id="modalDOpen" class="delete-btn"><i class="fas fa-ban"></i></button>
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
            <td hidden><?php echo $row['inquiryInfoID'] ?></td>
            <td><?php echo $row['bookingID'] ?></td>
            <td><?php echo $row['bookingNumber'] ?></td>
            <td><?php echo $row['fullname'] ?></td>
            <td><?php echo $row['packageTitle'] ?></td>
            <td><?php echo $row['bookingPrice'] ?></td>
            <td>
                <?php 
                    if($row['bookingStatus'] == 'complete') echo "Completed";
                    else if($row['bookingStatus'] == 'pay-pending') echo "Unpaid";
                    else if($row['bookingStatus'] == 'rate-pending') echo "Unrated";
                    else if($row['bookingStatus'] == 'trip-sched' || $row['bookingStatus'] == 'refund-denied') echo "Scheduled";
                    else if($row['bookingStatus'] == 'cancelled') echo "Cancelled";
                    else if($row['bookingStatus'] == 'refunded') echo "Refunded";

                ?>
            </td>
            <td data-tab-target="#travel-order" style="cursor: pointer;" class="to_travel_order">
                <!-- <i class="fas fa-ellipsis-h"></i> -->
                <img style="display: inline-block; height: 100%; vertical-align: middle;" src="https://img.icons8.com/ios-glyphs/30/null/dots-loading--v3.png"/>
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

function fetch_booking_by_id($inq_qry, $status_qry, $conn) {
    $qry_inq = mysqli_query($conn, $inq_qry);
    $inquiry = mysqli_fetch_assoc($qry_inq);
    
    $qry_status = mysqli_query($conn, $status_qry);
    $stat_array = array();

    while ($status = mysqli_fetch_assoc($qry_status)) {
        $stat_array[] = $status;
    }

    $jsondata = json_encode(
        array("inq" => $inquiry,
            "status" => $stat_array
        )
    );

    return $jsondata;
}

if(isset($_POST['getData']) and $_POST['getData']=="ok") {
    include __DIR__."../../connect/dbCon.php";
    $rating_query_string = "SELECT PR.ratingID, PR.package_rating, PR.package_review, PR.ratingDate, PR.is_hidden, CONCAT(US.fname, ' ', US.lname) AS fullname, US.profpicture, US.id
                                FROM  packagerating_tbl AS PR
                                INNER JOIN  user_tbl AS US ON PR.userID_rating = US.id
                                WHERE packageID_rated = {$_POST['packageID']} ORDER BY ratingDate DESC";

    $sqlquery = mysqli_query($conn, $rating_query_string.' LIMIT '.$_REQUEST["start"].', '.$_REQUEST["limit"].' ');
    $rowcount=mysqli_num_rows($sqlquery);
    if ($rowcount != 0) {
?>
    <?php 
        while($ratings = mysqli_fetch_array($sqlquery)) {
    ?>
        <div class="ratings-wrapper">
          <div class="user-pfp">
              <?php 
                if (!empty($ratings['profpicture'])) {
                  echo '<img src="../../assets/img/users/traveler/'.$ratings['id'].'/pfp/'.$ratings['profpicture'].'" alt="">';
                } else {
                  echo '<img src="../../assets/img/users/traveler/DefaultProf.jpg" alt="">';
                }
              ?>
          </div>
          <div class="rating-body">
            <p><?php echo $ratings['fullname']; ?></p>
            <div class="rating" style="color: var(--logo-yellow-dark); font-size: 18px;">
              <?php
                $stars = 5;
                for ($i = 0; $i < $ratings['package_rating']; $i++) {
                  echo '<i class="fas fa-star"></i>';
                  $stars--;
                }
                for ($i=0; $i < $stars; $i++) { 
                  if ($stars == 1) {
                    echo '<i class="far fa-star"></i>';
                  } else {
                    echo '<i class="far fa-star"></i>';
                  }
                }

                $stars = 0;
              ?>
            </div>
            <p class="rating-date"><?php echo $ratings['ratingDate']; ?></p>
            <p class="review-body"><?php if ($ratings['is_hidden'] != 1) echo $ratings['package_review']; ?></p>
          </div>
          <!-- <div>
            <p class="hide-comment" style="cursor: pointer;">Hide<input type="hidden" name="packageRatingID" value="<?php //echo $ratings['ratingID']?>"></p>
          </div> -->
        </div>
    <?php  
        }
    }
}
?>