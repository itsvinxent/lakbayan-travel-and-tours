<?php

function getData($month, $qry)
{
    require '../connect/dbCon.php';

    if ($month != 'all-time') {
        $qry .= " AND DATE_FORMAT(`timestamp`, '%Y %m') = '$month'";
    }
    $result = mysqli_query($conn, $qry);
    return mysqli_fetch_array($result)[0];
}

if (isset($_POST['dateValue'])) {
    $sales = getData(
        $_POST['dateValue'],
        "SELECT SUM(`bookingPrice`) AS total_sales FROM bookingstatus_tbl AS BS 
                        INNER JOIN booking_tbl AS BT ON BT.bookingID = BS.bookingInfoID 
                        WHERE BS.bookingStatus = 'complete'"
    );
    $bookings = getData(
        $_POST['dateValue'],
        "SELECT COUNT(*) AS total_bookings FROM booking_tbl AS BT 
                        INNER JOIN bookingstatus_tbl AS BS ON BT.bookingID = BS.bookingInfoID 
                        WHERE BS.bookingStatus = 'pay-pending'"
    );
    $unique = getData(
        $_POST['dateValue'],
        "SELECT COUNT(DISTINCT UV.visitorID) AS unique_count FROM uservisits_tbl AS UV 
                        INNER JOIN package_tbl AS PK ON UV.visitedPackageID = PK.packageID
                        WHERE PK.packageCreator = {$_POST['agencyID']}"
    );
    $average = getData(
        $_POST['dateValue'],
        "SELECT avg(timespent) AS avg_seconds FROM uservisits_tbl AS UV 
                        INNER JOIN package_tbl AS PK ON UV.visitedPackageID = PK.packageID
                        WHERE PK.packageCreator = {$_POST['agencyID']}"
    );
}
?>

<div class="card-container" id="dashboard-container">
    <div class="card-wrapper">
        <h3>Sales</h3>
        <span style="display: inline-flex; align-items: baseline;">

            <h3 style="font-weight: normal;">₱</h3>
            <h2><?php if (is_null($sales)) echo "0";
                else echo $sales; ?></h2>
        </span>
    </div>

    <div class="card-wrapper">
        <h3>Bookings</h3>
        <span style="display: inline-flex; align-items: baseline;">
            <h2><?php if (is_null($bookings)) echo "0";
                else echo $bookings; ?></h2>
            <h4 style="font-weight: normal;">customers</h4>
        </span>
    </div>

    <div class="card-wrapper">
        <h3>Visitors</h3>
        <span style="display: inline-flex; align-items: baseline;">
            <h2><?php if (is_null($unique)) echo "0";
                else echo $unique; ?></h2>
            <h4 style="font-weight: normal;">unique visitor<?php if ($unique > 1) echo "s"; ?></h4>
        </span>
    </div>

    <div class="card-wrapper">
        <h3>Average Visit Time</h3>
        <span style="display: inline-flex; align-items: baseline;">
            <h2><?php if (is_null($average)) echo $average = 0;
                else echo $average; ?>
            </h2>
            <h4 style="font-weight: normal;">
                <?php
                // if ($average > 60) {
                //     echo "minute";
                //     if ($average == 60) 
                //         echo "s"; 
                // } else {
                echo "second";
                if ($average > 1)
                    echo "s";
                // }

                ?>
            </h4>
        </span>
    </div>
</div>

<?php

function getSalesChart($month) {
    require "../connect/dbCon.php";

    $qry = "SELECT PK.packageID, PK.packageTitle, SUM(`bookingPrice`) AS total_sales FROM bookingstatus_tbl AS BS
                INNER JOIN booking_tbl AS BT ON BS.bookingInfoID = BT.bookingID
                INNER JOIN inquiry_tbl AS IQ ON BT.inquiryInfoID = IQ.id
                INNER JOIN package_tbl AS PK ON IQ.packageID = PK.packageID
                WHERE BS.bookingStatus = 'complete'";
    if ($month != 'all-time') {
        $qry .= " AND DATE_FORMAT(`timestamp`, '%Y %m') = '$month'";
    }
    $qry .= "GROUP BY PK.packageID ORDER BY total_sales DESC LIMIT 10";

    $result = mysqli_query($conn, $qry);
    $dataPoints = array();

    while ($fetch = mysqli_fetch_array($result)) {
        array_push($dataPoints, array("label" => $fetch['packageTitle'], "y" => $fetch['total_sales']));
    }

    return $dataPoints;
}

function getSalesByLocationChart($month) {
    require "../connect/dbCon.php";

    $qry = "SELECT AR.City, count(packageDestID) AS total_bookings FROM packagedest_tbl AS PD
            INNER JOIN areas_tbl AS AR ON PD.packageAreasID = AR.cityID
            INNER JOIN package_tbl AS PK ON PD.packageDestID = PK.packageID
            INNER JOIN inquiry_tbl AS IQ ON PK.packageID = IQ.packageID
            INNER JOIN booking_tbl AS BK ON IQ.id = BK.inquiryInfoID
            INNER JOIN bookingstatus_tbl AS BS ON BK.bookingID = BS.bookingInfoID
            WHERE BS.bookingStatus = 'complete' AND packageCreator = {$_POST['agencyID']}";
    
    if ($month != 'all-time') {
        $qry .= " AND DATE_FORMAT(`timestamp`, '%Y %m') = '$month'";
    }
    $qry .= " GROUP BY AR.City ORDER BY total_bookings DESC LIMIT 10";

    $result = mysqli_query($conn, $qry);
    $dataPoints = array();

    while ($fetch = mysqli_fetch_array($result)) {
        array_push($dataPoints, array("label" => $fetch['City'], "y" => $fetch['total_bookings']));
    }

    return $dataPoints;
}

function getSalesByCategoryChart($month) {
    require "../connect/dbCon.php";

    $qry = "SELECT PC.packageCategory, count(packageID_from) AS total_bookings FROM packagecateg_tbl AS PC
            INNER JOIN package_tbl AS PK ON PC.packageID_from = PK.packageID
            INNER JOIN inquiry_tbl AS IQ ON PK.packageID = IQ.packageID
            INNER JOIN booking_tbl AS BK ON IQ.id = BK.inquiryInfoID
            INNER JOIN bookingstatus_tbl AS BS ON BK.bookingID = BS.bookingInfoID
            WHERE BS.bookingStatus = 'complete' AND packageCreator = {$_POST['agencyID']}";
    
    if ($month != 'all-time') {
        $qry .= " AND DATE_FORMAT(`timestamp`, '%Y %m') = '$month'";
    }
    $qry .= " GROUP BY PC.packageCategory ORDER BY total_bookings DESC LIMIT 10";

    $result = mysqli_query($conn, $qry);
    $dataPoints = array();

    while ($fetch = mysqli_fetch_array($result)) {
        array_push($dataPoints, array("label" => $fetch['packageCategory'], "y" => $fetch['total_bookings']));
    }

    return $dataPoints;
}

if (isset($_POST['dateValue'])) {
    $salesDataPoints = getSalesChart($_POST['dateValue']);
    $locsalesDataPoints = getSalesByLocationChart($_POST['dateValue']);
    $catsalesDataPoints = getSalesByCategoryChart($_POST['dateValue']);
}
?>
<div class="stat-container" style="justify-content: center; gap: 10px;">
    <script>
        var sales_chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Top Selling Packages"
            },
            axisY: {
                title: "Total Sales in ₱"
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($salesDataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        sales_chart.render();

        var locsales_chart = new CanvasJS.Chart("locchartContainer", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Top Booked Locations"
            },
            axisY: {
                title: "Bookings per Location"
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($locsalesDataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        locsales_chart.render();

        var catsales_chart = new CanvasJS.Chart("catchartContainer", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Top Booked Categories"
            },
            axisY: {
                title: "Bookings per Category"
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($catsalesDataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        catsales_chart.render();

    </script>
    <div id="chartContainer" style="height: 180px; width: 45%;"></div>
    <div id="locchartContainer" style="height: 180px; width: 45%;"></div>
    <div id="catchartContainer" style="height: 180px; width: 45%; margin-top: 1rem;"></div>

</div>