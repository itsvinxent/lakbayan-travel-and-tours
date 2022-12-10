<?php 
    session_start();

    include '../connect/dbCon.php';

    if(mysqli_connect_error()) {
        echo<<<END
        <script type ="text/JavaScript">  
        alert("ERROR. Failed connecting to database")
        </script>
        END;
    } else {
        $id_user = $_SESSION['id'];
        $packageID = $_POST['packageid'];

        function isExisting($conn, $id_user, $packageID) {
            $query = "SELECT * from traveldb.inquiry_tbl WHERE id_user = $id_user AND packageID = $packageID";
            $qry_exist = mysqli_query($conn, $query);
            $cart = mysqli_fetch_array($qry_exist);
            return $cart;
        }

        if (isset($_POST['checkExisting']) and $_POST['checkExisting'] == 'true') {
            $cartItem = isExisting($conn, $id_user, $packageID);
            if ($cartItem['id'] != 0) {
                echo json_encode($cart);
                return;
            }
        } else if (isset($_POST['inserting']) and $_POST['inserting'] == 'true') {
            $maxpersons = $_POST['maxpersons'];
            $infantCount = $_POST['infantNum'];
            $childrenCount = $_POST['childNum'];
            $adultCount = $_POST['adultNum'];
            $seniorCount = $_POST['seniorNum'];
            $row = $_SESSION['row'];
            $img = $_SESSION['img'];

            $cartItem = isExisting($conn, $id_user, $packageID);
            
            if (isset($cartItem['id']) == false) {
                $query = "INSERT INTO traveldb.inquiry_tbl (`id_user`, `infantCount`, `childrenCount`, `adultCount`, `seniorCount`, `packageID`) 
                VALUES($id_user, $infantCount, $childrenCount, $adultCount, $seniorCount, $packageID)";
            } else {
                $query = "UPDATE traveldb.inquiry_tbl SET infantCount = $infantCount,
                                                 childrenCount = $childrenCount,
                                                 adultCount = $adultCount,
                                                 seniorCount = $seniorCount
                                                 WHERE id_user = $id_user 
                                                 AND packageID = $packageID";
            }

            if($result = mysqli_query($conn, $query)){
                
                // $_SESSION['inquiryID'] = $inqID;
                // $_SESSION['infantCount'] = $infantCount;
                // $_SESSION['childrenCount'] = $childrenCount;
                // $_SESSION['adultCount'] = $adultCount;
                // $_SESSION['seniorCount'] = $seniorCount;
                $persons = $childrenCount + $adultCount + $seniorCount;    
                $startdate = date_format(date_create($row['packageStartDate']),"M j, Y h:i A");
                $enddate = date_format(date_create($row['packageEndDate']),"M j, Y h:i A");
                $priceChild = (int) $row['packagePriceChild'];
                $priceAdult = (int) $row['packagePrice'];
                $priceSenior = (int) $row['packagePriceSenior'];

                if ( $priceChild == 0 and $priceSenior == 0) {
                  $packagePrice = $priceAdult;
                  $priceType = 0;
                  $total = $packagePrice * $persons;
                } else {
                  $packagePrice = $priceChild;
                  $priceType = 1;
                  $childTotal = $childrenCount * $priceChild;
                  $adultTotal = $adultCount * $priceAdult;
                  $seniorTotal = $seniorCount * $priceSenior;
                  $total = $childTotal + $adultTotal + $seniorTotal;
                }

                $bgurl = "../../assets/img/users/travelagent/{$row['packageCreator']}/package/{$row['packageID']}/img/$img[0]";
                $query = "SELECT fname, lname, email, address, contactnumber from traveldb.user_tbl WHERE id = $id_user";
                $qry_user = mysqli_query($conn, $query);
                $user = mysqli_fetch_array($qry_user);

                echo"
                <div class='model'>
                <div class='room' 
                    style=\"background: url($bgurl) no-repeat center;
                    background-size:auto;\">
                
                    <div class='previousPage' id='previousPage'> <i class='fas fa-angle-left'></i> Back</div>

                    <div class='text-cover'>
                        <h1>{$row['packageTitle']}</h1>
                        <p class='price'><span>₱</span> $packagePrice</p>
                        <p>Booked for $persons Persons</p>
                        <p>$startdate to $enddate</p>
                        <hr>
                        <div class=\"client-box\">
                            <h3>Client Information</h3>
                            <table class=\"client-info\">
                                <tr>
                                    <td>Name</td>
                                    <td>{$user['lname']}, {$user['fname']}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td style=\"text-align: justify;\">{$user['address']}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{$user['email']}</td>
                                </tr>
                                <tr>
                                    <td>Contact #</td>
                                    <td>{$user['contactnumber']}</td>
                                </tr>
                            </table>
                        </div>  
                    </div>
                </div><div class='payment'>
                    <div class='receipt-box'>
                    <div class='closePage'> <h3>Booking Summary</h3> <span id='closesummary'><i class='fas fa-times'></i></span></div>

                    
                    <table class='table'>
                ";
                if ($priceType == 0) {
                    echo "<tr>
                            <td>₱$priceAdult x <span>$persons</span> Persons</td>
                            <td>₱$total</td>
                        </tr>";
                } else {
                    if ($childrenCount != 0) {
                        ($childrenCount > 1) ? $chword = "Children" : $chword = "Child";
                        echo "<tr>
                                <td>₱$priceChild x <span>$childrenCount</span> $chword</td>
                                <td>₱$childTotal</td>
                            </tr>";
                    }
                    if ($adultCount != 0) {
                        ($adultCount > 1) ? $chword = "Adults" : $chword = "Adult";
                        echo "<tr>
                            <td>₱$priceAdult x <span>$adultCount</span> $chword</td>
                            <td>₱$adultTotal</td>
                            </tr>";
                    }
                    if ($seniorCount != 0) {
                        ($seniorCount > 1) ? $chword = "Seniors" : $chword = "Senior";
                        echo "<tr>
                            <td>₱$priceSenior x <span>$seniorCount</span> $chword</td>
                            <td>₱$seniorTotal</td>
                        </tr>";
                    }
                }

                echo<<<END
                            <tfoot>
                            <tr style="border-top: 1px solid black;">
                                <td style="padding-top: 10px;"><strong>Total Price</strong></td>
                                <td style="padding-top: 10px;"><strong> ₱$total</strong></td>
                            </tr>
                            </tfoot>
                        </table>
                        </div>
                        <div class="payment-info">
                            <form action="checkout.php" method="POST">
                                <input type="hidden" name="packageid" value="$packageID">
                                <input type="hidden" name="totalprice" value="$total">
                                <input type="hidden" name="availableslots" value="$maxpersons-$persons">
                                <fieldset>
                                    <legend>Payment Method</legend>
                                    <div class="instr">You will be redirected to another page where you will sign-in your GCash account and confirm payment on the required amount.</div>
                                    <div class="form__radios" id="form__radios">
                                        <div class="form__radio">
                                            <img src="..\..\assets\img\paymongo.png" style="border-radius: 5px; outline: 1px #439A97 solid; margin-right: 10px; height: 40px; width: 40px"/>
                                            <label for="paymongo">Paymongo Payment</label>
                                            <input checked id="gcash" name="payment-method" type="radio" value="Paymongo"/>
                                        </div>

                                        <// <div class="form__radio">
                                        <//     <img src="https://img.icons8.com/plasticine/100/null/gcash.png"/>
                                        <//     <label for="gcash"><//GCash Payment</label>
                                        <//     <input checked id="gcash" name="payment-method" type="radio" value="GCash"/>
                                        <// </div>

                                        <// <div class="form__radio">
                                        <//     <img src="https://img.icons8.com/plasticine/100/null/bank-card-back-side.png"/>
                                        <//     <label for="bank"><//Bank Transfer</label>
                                        <//     <input id="bank" name="payment-method" type="radio" value="Bank Transfer"/>
                                        <// </div>

                                        <// <div class="form__radio">
                                        <//     <img src="https://img.icons8.com/plasticine/100/null/cash-in-hand.png"/>
                                        <//     <label for="remittance"><//Remittance Center</label>
                                        <//     <input id="remittance" name="payment-method" type="radio" value="Remittance Center"/>
                                        <// </div>
                                    </div>
                                </fieldset>

                                <input class="btn"type="submit" value="Proceed to Checkout">
                            </form>
                        </div>
                    </div>
                    </div>
                    <script>
                        $("#form__radios").on("change", "input[name='payment-method']", function () {
                            var payment = $(this).val();
                            if (payment === 'gcash') {
                                $('.instr').text('You will be redirected to another page where you will sign-in your GCash account and confirm payment on the required amount.');
                            } else if (payment === 'bank') {
                                $('.instr').text('Transfer the required amount to this account number. Send the proof at the Travel Order page.');
                            } else {
                                $('.instr').text("Send money via Remittance Centers under this person's name. Send the proof at the Travel Order page.");
                            }
                        });
                        $('#previousPage').on('click', function() {
                            $('#booking-summary').removeClass("show");
                            $("#bmodal_container").toggleClass("show");
                          });
                          $('#closesummary').on('click', function() {
                            $('#booking-summary').removeClass("show");
                          })
                    </script>
                END;
                
                // echo '<meta http-equiv="refresh" content="0;URL=../../includes/packages/checkout.php" />';
            } 
            // else {
            //     echo "failed!" . mysqli_error($conn);
                // $_SESSION['booking-stat'] = 'failed';
                // mysqli_close($conn);
                // echo '<meta http-equiv="refresh" content="0;URL=../../packages.php" />';
            // }

        }
    }
?>