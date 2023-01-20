<?php
    if (isset($_GET['id']) == false || isset($_GET['stat']) == false || isset($_GET['utype']) == false ||
        $_GET['id'] == '' || $_GET['stat'] == '' || $_GET['utype'] == ''){
        header("Location: http://".$_SERVER['HTTP_HOST'] ."/Finals/index.php");
        exit;
    }
    include __DIR__.'/../connect/dbCon.php';
    if(mysqli_connect_error()){
        echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Failed connecting to databasee")
            </script>
        END;
    }
    else{
        $stat = $_GET['stat'];
        $pkgid = mysqli_real_escape_string($conn,$_GET['id']);
        $usertype = $_GET['utype'];
        $currentDate = new DateTime();

        $check_query = "SELECT count(*) AS pending_transactions FROM inquiry_tbl AS IQ
                        INNER JOIN booking_tbl AS BK ON IQ.id = BK.inquiryInfoID 
                        INNER JOIN bookingstatus_tbl AS BS ON BK.bookingID = BS.bookingInfoID
                        WHERE IQ.packageID = $pkgid AND BS.bookingStatus = 'trip-sched'";
        $qry_chk = mysqli_query($conn, $check_query);
        $has_pending = mysqli_fetch_assoc($qry_chk);

        if ((int)$has_pending['pending_transactions'] != 0 AND $stat == 1) {
            echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Unable to UNLIST package, finish all pending transactions first!")
            </script>
            END;
        } else {
            // $delete_query = " DELETE FROM  user_tbl WHERE id = $usrid; " ;
            $delete_query = "UPDATE  package_tbl SET packageStatus = $stat WHERE packageID = $pkgid; " ;
            
            mysqli_query($conn,$delete_query);
    
            if(mysqli_query($conn,$delete_query)){
            echo<<<END
                <script type ="text/JavaScript">  
                alert("Status successfully updated.")
                </script>
            END;
            }
            else{
            echo<<<END
                <script type ="text/JavaScript">  
                alert("ERROR. Unable to update status.")
                </script>
            END;
            }
        }
        // mysqli_close($conn);
    } 
    if ($usertype == 'admin') {
        echo '<meta http-equiv="refresh" content="0;URL=../../admin-panel.php" />';
    } else {
        echo '<meta http-equiv="refresh" content="0;URL=../../agency-profile.php" />';
    }
?>