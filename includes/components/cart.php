<?php 
    session_start();
    include "../../backend/connect/dbCon.php";
    
    $query_string = "SELECT * FROM traveldb.inquiry_tbl WHERE id_user = {$_SESSION['id']}";
    $qry_cart = mysqli_query($conn, $query_string);

    while($cart = mysqli_fetch_array($qry_cart)) {
        echo $cart['id'];
        echo "<br>";
        echo $cart['id_user'];
        echo "<br>";
        echo $cart['infantCount'];
        echo "<br>";
        echo $cart['childrenCount'];
        echo "<br>";
        echo $cart['adultCount'];
        echo "<br>";
        echo $cart['seniorCount'];
        echo "<br>";
        echo $cart['packageID'];
        echo "<br>";
    }

?>