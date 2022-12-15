<?php
    include '../connect/dbCon.php';
    if(mysqli_connect_error()){
        echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Failed connecting to databasee")
            </script>
        END;
    }
    else{
        $pkgid = $_GET['id'];
        $usertype = $_GET['utype'];
        $currentDate = new DateTime();

        $check_query = "SELECT count(*) AS pending_transactions FROM inquiry_tbl AS IQ
                        INNER JOIN booking_tbl AS BK ON IQ.id = BK.inquiryInfoID 
                        INNER JOIN bookingstatus_tbl AS BS ON BK.bookingID = BS.bookingInfoID
                        WHERE IQ.packageID = $pkgid AND BS.bookingStatus = 'trip-sched'";
        $qry_chk = mysqli_query($conn, $check_query);
        $has_pending = mysqli_fetch_assoc($qry_chk);

        if ((int)$has_pending['pending_transactions'] != 0) {
            echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Unable to delete package, finish all pending transactions first!")
            </script>
            END;
        } else {
            // $delete_query = " DELETE FROM traveldb.user_tbl WHERE id = $usrid; " ;
            $delete_query = "UPDATE traveldb.package_tbl SET is_deleted = 1 WHERE packageID = $pkgid; " ;
            
            mysqli_query($conn,$delete_query);
    
            if(mysqli_query($conn,$delete_query)){
            echo<<<END
                <script type ="text/JavaScript">  
                alert("Record successfully deleted")
                </script>
            END;
            }
            else{
            echo<<<END
                <script type ="text/JavaScript">  
                alert("ERROR. Record not deleted.")
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