<?php
    require "../connect/dbCon.php";

    $qry = "SELECT PK.packageID, PK.packageTitle, SUM(`bookingPrice`) AS total_sales FROM bookingstatus_tbl AS BS
            INNER JOIN booking_tbl AS BT ON BS.bookingInfoID = BT.bookingID
            INNER JOIN inquiry_tbl AS IQ ON BT.inquiryInfoID = IQ.id
            INNER JOIN package_tbl AS PK ON IQ.packageID = PK.packageID
            WHERE BS.bookingStatus = 'complete'";
    // if ($month != 'all-time') {
    //     $qry .= " AND DATE_FORMAT(`timestamp`, '%Y %m') = '$month'";
    // }
    $qry .= "GROUP BY PK.packageID LIMIT 10";

    $result = mysqli_query($conn, $qry);
    $dataPoints = array();

    while($fetch = mysqli_fetch_array($result)) {
        array_push($dataPoints, array("label"=> $fetch['packageTitle'], "y"=> $fetch['total_sales']));
    }
        
?>
<script>
    window.onload = function () {
    
    var chart = new CanvasJS.Chart("chartContainer", {
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
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
    
    }
</script>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>