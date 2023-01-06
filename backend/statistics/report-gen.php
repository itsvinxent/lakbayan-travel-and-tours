<?php
    session_start();
    require_once __DIR__."/../connect/dbCon.php";
    
    $months_arr = unserialize($_POST['months_arr']);
    $months_fmt_arr = array();

    // SALES QUERY
    $el = 0;
    $sales_str = "SELECT PK.packageID AS 'Package ID', 
    PK.packageTitle AS 'Package Name', 
    SUM(bookingPrice) AS 'Total Sales', 
    COUNT(BS.bookingStatus) AS 'Total Bookings', ";

    foreach ($months_arr as $months => $month) {
        $sales_str .= "SUM(IF(DATE_FORMAT(timestamp, '%Y %m') = '". $month ."', bookingPrice, 0)) AS `". $month ."`";
        if (array_key_last($months_arr) != $el) {
            $sales_str .= ",";
        }
        $el++;
    }

    $sales_str .= " FROM bookingstatus_tbl AS BS
    INNER JOIN booking_tbl AS BT ON BS.bookingInfoID = BT.bookingID
    INNER JOIN inquiry_tbl AS IQ ON BT.inquiryInfoID = IQ.id
    INNER JOIN package_tbl AS PK ON IQ.packageID = PK.packageID
    WHERE BS.bookingStatus = 'complete' AND PK.packageCreator = ". $_SESSION['setID'] .
    " GROUP BY PK.packageID ORDER BY `Total Sales` DESC";

    $qry_sales = mysqli_query($conn, $sales_str) or die(mysqli_error($conn));

    // VIEWS QUERY
    $el = 0;
    $views_str = "SELECT PK.packageID AS 'Package ID', 
    PK.packageTitle AS 'Package Name', 
    SEC_TO_TIME(SUM(timespent)) AS 'Total Time', ";

    foreach ($months_arr as $months => $month) {
        $views_str .= "SEC_TO_TIME(SUM(IF(DATE_FORMAT(timestamp, '%Y %m') = '". $month ."', timespent, NULL))) AS `". $month ."`";
        if (array_key_last($months_arr) != $el) {
            $views_str .= ",";
        }
        $el++;
    }

    $views_str .= " FROM uservisits_tbl AS UV 
    INNER JOIN package_tbl AS PK ON UV.visitedPackageID = PK.packageID 
    WHERE PK.packageCreator = ". $_SESSION['setID'] .
    " GROUP BY PK.packageID ORDER BY `Total Time` DESC";

    $qry_views = mysqli_query($conn, $views_str) or die(mysqli_error($conn));
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script>
    // Sales Table
    function salesTable() {
        return `<html><table>
        <thead>
            <tr>
                <td>Package ID</td>
                <td>Package Name</td>
                <td>Total Sales</td>
                <td>Total Bookings</td>
            <?php 
            foreach ($months_arr as $months => $month) {
                $split_date = explode(" ", $month);
                $rowval =  date('F', mktime(0,0,0,$split_date[1])) ." $split_date[0]";
                array_push($months_fmt_arr, $rowval);
                echo "<td>". $rowval . "</td>\n";
                // echo "<td>$split_date[0]\n$split_date[1]</td>";
            }
            ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            while ($row = mysqli_fetch_assoc($qry_sales)) {
            ?>
            <tr>
                <td><?php echo $row['Package ID'] ?></td>
                <td><?php echo $row['Package Name'] ?></td>
                <td><?php echo $row['Total Sales'] ?></td>
                <td><?php echo $row['Total Bookings'] ?></td>
                <?php 
                foreach ($months_arr as $months => $month) {
                    echo "<td>$row[$month]</td>";
                }
                ?>
            </tr>

            <?php
            }
            ?>
        </tbody>
        </table></html>`;
    }

    // Views Table
    function viewsTable() {
        return `<html><table>
        <thead>
            <tr>
                <td>Package ID</td>
                <td>Package Name</td>
                <td>Total Visit Time</td>
            <?php 
            foreach ($months_arr as $months => $month) {
                $split_date = explode(" ", $month);
                $rowval =  date('F', mktime(0,0,0,$split_date[1])) ." $split_date[0]";
                array_push($months_fmt_arr, $rowval);
                echo "<td>". $rowval . "</td>\n";
                // echo "<td>$split_date[0]\n$split_date[1]</td>";
            }
            ?>
            </tr>
        </thead>
        <tbody>
            <?php 
            while ($row = mysqli_fetch_assoc($qry_views)) {
            ?>
            <tr>
                <td><?php echo $row['Package ID'] ?></td>
                <td><?php echo $row['Package Name'] ?></td>
                <td><?php echo $row['Total Time'] ?></td>
                <?php 
                foreach ($months_arr as $months => $month) {
                    echo "<td>$row[$month]</td>";
                }
                ?>
            </tr>

            <?php
            }
            ?>
        </tbody>
        </table></html>`;
    }

    // String to ArrayBuffer Converter
    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i=0; i!=s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }

    // Gets a specific cell of an Excel Worksheet
    function getCell(worksheet, row, col) {
        const cellId = `${XLSX.utils.encode_cell({r: row, c: col})}`;
        return worksheet[cellId] || (worksheet[cellId] = {});
    }

    // Sets value and properties of a specific cell in an Excel Worksheet
    function setCellValue(worksheet, row, col, value) {
        const cell = getCell(worksheet, row, col);
        cell.v = value;
        cell.t = 's';
        cell.z = undefined;
        cell['!raw'] = true;
    }

    // Gets the first row of a table
    function setFirstRowAsString(html, worksheet) {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const table = doc.querySelector('table');
        const firstRow = table.querySelector('tr');
        const cells = firstRow.querySelectorAll('td');
        cells.forEach((cell, index) => {
            setCellValue(worksheet, 0, index, cell.textContent);
        });
    }

    function saveAsExcel () {
        var blob, wb = {SheetNames:[], Sheets:{}};
        var ws1 = XLSX.read(salesTable(), {type:"binary"}).Sheets.Sheet1;
        
        setFirstRowAsString(salesTable(), ws1);
        wb.SheetNames.push("MonthlyPackageSales"); wb.Sheets["MonthlyPackageSales"] = ws1;

        var ws2 = XLSX.read(viewsTable(), {type:"binary"}).Sheets.Sheet1;

        setFirstRowAsString(viewsTable(), ws2);
        wb.SheetNames.push("MonthlyPackageViewTimes"); wb.Sheets["MonthlyPackageViewTimes"] = ws2;
        
        blob = new Blob([s2ab(XLSX.write(wb, {bookType:'xlsx', type:'binary'}))], {
        type: "application/octet-stream"
        });
        
        saveAs(blob, "PerformanceOverview.xlsx");
    }

    saveAsExcel();
    // window.close();
</script>