<link rel="stylesheet" href="assets/css/dragupload.css">

<div id="travel-order" data-tab-content class="data-tab-content travel-order">
    <div class="content">
        <h1 class="page-title">Travel Order</h1>
        <div class="progress-container">
            <div class="progress" id="progress-bar">
                <span class="icon active" data-order-target="#tbooking-placed">
                    <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/48/000000/external-booking-vacation-planning-solo-trip-flaticons-flat-flat-icons-2.png" />
                    <p class="title active" id="bktitle">Booking Placed</p>
                </span>
                <div class="bar"></div>

                <span class="icon" data-order-target="#tpayment-info" id="payment-tab">
                    <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/48/000000/external-money-vacation-planning-solo-trip-flaticons-flat-flat-icons-3.png" />
                    <p class="title">Payment</p>
                </span>
                <div class="bar"></div>

                <span class="icon" data-order-target="#tpayment-info" id="trip-tab">
                    <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/48/000000/external-road-trip-vacation-planning-solo-trip-flaticons-flat-flat-icons-2.png" />
                    <p class="title">Trip Scheduled</p>
                </span>
                <div class="bar"></div>

                <span class="icon" data-order-target="#tpayment-info " id="rate-tab">
                    <img src="https://img.icons8.com/external-flaticons-flat-flat-icons/48/000000/external-checklist-vacation-planning-solo-trip-flaticons-flat-flat-icons-4.png" />
                    <p class="title">Rate Destination</p>
                </span>

            </div>

        </div>

        <div data-tab-order class="booking-placed travel-sub active" id="tbooking-placed">
            <div class="header" style="display: flex; justify-content: space-between; margin-bottom: 1rem; width: 100%">
                <h1 class="ord_packageTitle"></h1>
                <h1 class="ord_packagePrice"></h1>
            </div>
            <div class="client-inf" style="width: 60%;">
                <h3>Client Information</h3>
                <table class="client-inf-table">
                    <tr>
                        <td>Name</td>
                        <td class="ord_name"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="ord_email"></td>
                    </tr>
                    <tr>
                        <td>Contact #</td>
                        <td class="ord_contact"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td class="ord_address"></td>
                    </tr>
                </table>
            </div>
            <div class="booking-inf" style="width: 40%;">
                <h3>Booking Information</h3>
                <table class="booking-inf-table">
                    <tbody class="booking-per-person" style="display: none;">
                        <tr>
                            <td class="ord_infantcomp"></td>
                            <td class="ord_infanttotal"></td>
                        </tr>
                        <tr>
                            <td class="ord_childrencomp"></td>
                            <td class="ord_childrentotal"></td>
                        </tr>
                        <tr>
                            <td class="ord_adultcomp"></td>
                            <td class="ord_adulttotal"></td>
                        </tr>
                        <tr>
                            <td class="ord_seniorcomp"></td>
                            <td class="ord_seniortotal"></td>
                        </tr>
                    </tbody>
                    <tbody class="booking-fixed" style="display: none;">
                        <tr>
                            <td class="ord_fixedcomp"></td>
                            <td class="ord_fixedtotal"></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style="border-top: 1px solid black;">
                            <td style="padding-top: 10px;"><strong>Total Price</strong></td>
                            <td style="padding-top: 10px;"><strong class="ord_booktotal"></strong></td>
                        </tr>
                    </tfoot>

                </table>
            </div>


        </div>

        <div data-tab-order class="tpayment-info travel-sub" id="tpayment-info">
            <!-- FORMS -->
            <!-- SELECT PAYMENT METHOD -->
            <div class="method-selection" style="display: none;">
                <div class="header" style="display: flex; justify-content: left; margin-bottom: 1rem; width: 100%">
                    <h1>Mode of Payment</h1>
                </div>
                <div class="form__radios" id="form__radios" style="display: flex; flex-wrap: wrap;">
                    <div class="form__radio">
                        <img src="https://img.icons8.com/plasticine/100/null/gcash.png" />
                        <label for="gcash">GCash Payment</label>
                        <input checked id="gcash" name="payment-method" type="radio" value="GCash" />
                    </div>

                    <div class="form__radio">
                        <img src="https://img.icons8.com/plasticine/100/null/bank-card-back-side.png" />
                        <label for="bank">Bank Transfer</label>
                        <input id="bank" name="payment-method" type="radio" value="Bank Transfer" />
                    </div>

                    <div class="form__radio">
                        <img src="https://img.icons8.com/plasticine/100/null/cash-in-hand.png" />
                        <label for="remittance">Remittance Center</label>
                        <input id="remittance" name="payment-method" type="radio" value="Remittance Center" />
                    </div>
                </div>
                <div class="instructions">
                    <h3>Instructions</h3>
                    <p class="instr">You will be redirected to another page where you will sign-in your GCash account and confirm payment of the required amount directly to the Travel Agency.</p>
                    <button type="button" class="btn" id="method-save">Next</button>
                </div>
                <script>
                    $("#form__radios").on("change", "input[name='payment-method']", function() {
                        var payment = $(this).val();
                        if (payment === 'GCash') {
                            $('.instr').text('You will be redirected to another page where you will sign-in your GCash account and confirm payment on the required amount.');
                        } else if (payment === 'Bank Transfer') {
                            $('.instr').text('Transfer the required amount to this account number. Send the proof at the Travel Order page.');
                        } else {
                            $('.instr').text("Send money via Remittance Centers under this person's name. Send the proof at the Travel Order page.");
                        }
                    });
                </script>
            </div>

            <!-- PACKAGE RATING SHEET -->
            <div class="rating-sheet" style="display: none; width: 100%">
                <div class="rate-pack" style="width: 50%; display: flex; flex-direction: column; gap: 15px;">
                    <h1>Rate Package and Travel Agency </h1>
                    <div class="packagestars" style="display: flex; flex-wrap: none; width: 100%; text-align: center;">
                        <div class="left-image" style="width: 40%; height: 100px;">
                            <img id="packagerateimg" src="" style="width: 100%; height: 100px; object-fit: cover; border-radius: 10px;" alt="" />
                        </div>
                        <div class="right-contents" style="width: 60%;">
                            <h3 class="ord_packageTitle"></h3>
                            <div class="rating">
                                <input type="radio" name="pack-rating" value="5" id="packrate5"><label for="packrate5"><i class='far fa-star'></i></label>
                                <input type="radio" name="pack-rating" value="4" id="packrate4"><label for="packrate4"><i class='far fa-star'></i></label>
                                <input type="radio" name="pack-rating" value="3" id="packrate3"><label for="packrate3"><i class='far fa-star'></i></label>
                                <input type="radio" name="pack-rating" value="2" id="packrate2"><label for="packrate2"><i class='far fa-star'></i></label>
                                <input type="radio" name="pack-rating" value="1" id="packrate1"><label for="packrate1"><i class='far fa-star'></i></label>
                            </div>
                            <p id="p-rating-text"></p>
                        </div>

                    </div>
                    <div class="agencystars" style="display: flex; flex-wrap: none; width: 100%; text-align: center;">
                        <div class="left-image" style="width: 40%; height: 100px;">
                            <img id="travelagencyimg" src="" style="width: 100%; height: 100px; object-fit: cover; border-radius: 10px;" alt="" />
                        </div>
                        <div class="right-contents" style="width: 60%;">
                            <h3 class="ord_packageCreator"></h3>
                            <div class="rating">
                                <input type="radio" name="agency-rating" value="5" id="agenrate5"><label for="agenrate5"><i class='far fa-star'></i></label>
                                <input type="radio" name="agency-rating" value="4" id="agenrate4"><label for="agenrate4"><i class='far fa-star'></i></label>
                                <input type="radio" name="agency-rating" value="3" id="agenrate3"><label for="agenrate3"><i class='far fa-star'></i></label>
                                <input type="radio" name="agency-rating" value="2" id="agenrate2"><label for="agenrate2"><i class='far fa-star'></i></label>
                                <input type="radio" name="agency-rating" value="1" id="agenrate1"><label for="agenrate1"><i class='far fa-star'></i></label>
                            </div>
                            <p id="a-rating-text"></p>
                        </div>
                    </div>

                </div>
                <div class="rate-review" style="width: 50%; display: flex; flex-direction: column; gap: 10px;">
                    <textarea name="reviewtext" id="reviewtext" cols="30" rows="10" placeholder="Please share us your thoughts about our service!"></textarea>
                    <button type="button" class="btn" id="rating-save" style="position: unset; bottom: unset; right: unset; margin-left: auto; padding: 10px 25px;">Submit</button>
                </div>
            </div>

            <!-- BOOKING STATUS UI -->
            <div class="proof-upload">
                <!-- LEFT SIDE: BOOKING STATUSES -->
                <div style="position: relative; width: 40%; height: 300px;">
                    <!-- PAYMENT TAB -->
                    <div class="proof-right">
                        <?php
                        if ($_SESSION['active'] == 'u-profile') {
                        ?>
                            <!-- TRAVELER VIEW -->
                            <!-- PAY-PENDING -->
                            <form id="upForm" onsubmit="return up();" style="display: none;">
                                <div class="file-upload">
                                    <div class="drag-area">
                                        <i class="icon fas fa-cloud-upload-alt"></i>
                                        <header>Drag & Drop to Upload File</header>
                                        <span>OR</span>
                                        <button type="button">Browse File</button>
                                    </div>
                                    <input type="file" name="payment-proof" id="payment-proof" style="display: none;">
                                    <input type="number" name="current-bookingID" id="current-bookingID" hidden>
                                    <input type="number" name="current-userID" id="current-userID" hidden>
                                </div>
                                <div class="proof-buttons">
                                    <button type="submit" class="btn btn-long" id="submit-proof">Submit Proof</button>
                                    <button type="button" class="btn btn-long" id="change-payment">Change Payment Method</button>
                                </div>
                                <!-- SWITCH TO PAYMENT METHOD SELECTION FORM FUNCTION -->
                                <script>
                                    // Change Payment
                                    $('#change-payment').on('click', function() {
                                        $('#tpayment-info').css('margin', '1rem auto 0 auto');
                                        $('.proof-upload').css('display', 'none');
                                        $('.method-selection').css('display', 'flex');
                                    })

                                    // Save Payment
                                    $('#method-save').on('click', function() {
                                        // Frontend
                                        $('#tpayment-info').css('margin', '.5rem auto 0 auto');
                                        $('.proof-upload').css('display', 'flex');
                                        $('.method-selection').css('display', 'none');
                                        $.ajax({
                                            url: 'backend/booking/booking_changepayment.php',
                                            method: 'POST',
                                            data: {
                                                payment_option: $('input[name="payment-method"]:checked').val(),
                                                bookingID: currentResponse.inq['bookingID']
                                            },
                                            async: true,
                                            context: this,
                                            success: function() {
                                                requestData(currentResponse.inq['bookingID']);
                                            }
                                        });
                                    })
                                </script>
                            </form>
                            <!-- CONFIRM-PENDING -->
                            <div id="waiting-confirm" class="file-upload" style="flex-direction: column; height: 300px; display:none;">
                                <img src="https://img.icons8.com/plasticine/100/null/spinner-frame-5.png" />
                                <h2 style="text-align: center; color: white;">Waiting for the<br>confirmation of Payment...</h2>
                            </div>
                            <!-- TRIP-SCHED -->
                            <div id="trip-confirmed" class="file-upload" style="flex-direction: column; height: 300px; display:none;">
                                <img src="https://img.icons8.com/plasticine/100/null/checked--v1.png" />
                                <h2 style="text-align: center; color: white;">Your Payment has been confirmed!</h2>
                            </div>
                        <?php
                        } else {
                        ?>
                            <!-- TRAVEL AGENCY VIEW -->
                            <!-- PAY-PENDING -->
                            <div id="waiting-status" class="file-upload" style="flex-direction: column; height: 300px; display:none;">
                                <img src="https://img.icons8.com/plasticine/100/null/submit-progress.png" />
                                <h2 style="text-align: center; color: white;">Waiting for the<br>Proof of Payment...</h2>
                            </div>
                            <!-- CONFIRM-PENDING -->
                            <form id="approveForm" onsubmit="return approve();" style="display: none;">
                                <div class="file-upload">
                                    <div class="drag-area">
                                        <img src="" id="image-proof" alt="">
                                        <a href="" onclick="window.open(this.href, '_blank', 'left=20,top=20,width=650,height=650,toolbar=1,resizable=0'); return false;">
                                            <div class="hint">Click to View Full Image</div>
                                        </a>
                                    </div>
                                    <input type="number" name="current-bookingID" id="current-bookingID" hidden>
                                    <input type="number" name="current-userID" id="current-userID" hidden>
                                    <input type="number" name="current-packageID" id="current-packageID" hidden>
                                    <input type="number" name="current-slots" id="current-slots" hidden>

                                    <input type="hidden" name="proof-decision" id="proof-decision">
                                </div>
                                <div class="proof-buttons">
                                    <button type="button" onclick="approveButtonHandler();" class="btn btn-long" id="approve-proof">Confirm Payment</button>
                                    <button type="button" onclick="denyButtonHandler();" class="btn btn-long" id="deny-proof" style="background-color: #ED2939;">Deny Payment</button>
                                </div>
                                <script>
                                    // Confirm Payment
                                    function approveButtonHandler() {
                                        $('#proof-decision').val('approved');
                                        $('#approveForm').submit();
                                    }

                                    // Deny Payment
                                    function denyButtonHandler() {
                                        $('#proof-decision').val('denied');
                                        $('#approveForm').submit();
                                    }
                                </script>
                            </form>
                            <!-- TRIP-SCHED -->
                            <div id="trip-confirmed" class="file-upload" style="flex-direction: column; height: 300px; display:none;">
                                <img src="https://img.icons8.com/plasticine/100/null/checked--v1.png" />
                                <h2 style="text-align: center; color: white;">You have confirmed the payment!</h2>
                            </div>
                        <?php
                        }
                        ?>

                        <script src="assets/js/dragupload.js"></script>
                    </div>

                    <!-- TRIP SCHEDULED TAB -->
                    <div class="sched-right">
                        <!-- TRIP-SCHED -->
                        <div class="gray-area" id="before-trip">
                            <div class="message"></div>
                            <?php
                            if ($_SESSION['active'] == 'u-profile') {
                                echo <<<END
                            <button class="btn btn-long" style="margin-bottom: 15px; background: #34495E;" id="contact-agency-btn">Contact Travel Agency</button>
                            END;
                            } else {
                                echo <<<END
                            <button class="btn btn-long" style="margin-bottom: 15px; background: #34495E;" id="contact-cust-btn">Contact Customer</button>
                            END;
                            }
                            ?>
                            <button class="btn btn-long">Download Receipt</button>
                        </div>
                        <!-- RATE-PENDING -->
                        <div id="trip-done" class="file-upload" style="flex-direction: column; height: 300px;">
                            <img src="https://img.icons8.com/plasticine/100/null/checked--v1.png" />
                            <h2 style="text-align: center; color: white;">Your Trip has been<br>completed!</h2>
                        </div>
                    </div>

                    <!-- RATE PACKAGE TAB -->
                    <div class="rate-right">
                        <!-- RATE-PENDING -->
                        <div class="gray-area" id="before-rate">
                            <div class="message-rate"></div>
                            <button class="btn btn-long" style="margin-bottom: 15px;" id="rate-pack-btn">Rate Package</button>
                            <button class="btn btn-long" style="margin-bottom: 15px; background: #34495E;" id="book-again-btn">Book Another Package</button>
                            <!-- SWITCH TO PACKAGE RATING SHEET FUNCTION -->
                            <script>
                                // Rate Package
                                $('#rate-pack-btn').on('click', function() {
                                    $('#tpayment-info').css('margin', '1rem auto 0 auto');
                                    $('.proof-upload').css('display', 'none');
                                    $('.rating-sheet').css('display', 'flex');

                                    // Rating UI Images
                                    if (currentResponse.inq['packageImg_Name'] != null || currentResponse.inq['packageImg_Name'] != '')
                                        $('#packagerateimg').attr("src", 'assets/img/users/travelagent/' + currentResponse.inq['packageCreator'] + '/package/' + currentResponse.inq['packageID'] + '/img/' + currentResponse.inq['packageImg_Name'])
                                    else
                                        $('#packagerateimg').attr("src", 'assets/img/Missing.jpeg');

                                    $('#travelagencyimg').attr("src", 'assets/img/users/travelagent/' + currentResponse.inq['packageCreator'] + '/pfp/' + currentResponse.inq['agencyPfPicture']);

                                })

                                // Rating Text
                                function ratingText(inputname, textclass) {
                                    var rating = $("input[name='" + inputname + "']:checked").val();
                                    
                                    rating == 5 ? text = "Excellent" :
                                        rating == 4 ? text = "Very Good" :
                                        rating == 3 ? text = "Good" :
                                        rating == 2 ? text = "Poor" :
                                        rating == 1 ? text = "Very Poor" :
                                        text = '';
                                    $(textclass).text(text);
                                }

                                $("input[name='pack-rating']").on('change', function () {
                                    ratingText("pack-rating", "#p-rating-text");   
                                });
                                $("input[name='agency-rating']").on('change', function () {
                                    ratingText("agency-rating", "#a-rating-text")   
                                });

                                // Save Rating
                                $('#rating-save').on('click', function() {
                                    // Frontend
                                    $('#tpayment-info').css('margin', '.5rem auto 0 auto');
                                    $('.proof-upload').css('display', 'flex');
                                    $('.rating-sheet').css('display', 'none');
                                    $.ajax({
                                        url: 'backend/booking/booking_rating.php',
                                        method: 'POST',
                                        data: {
                                            package_rating: $('input[name="pack-rating"]:checked').val(),
                                            agency_rating: $('input[name="agency-rating"]:checked').val(),
                                            review: $('#reviewtext').val(),
                                            agencyID: currentResponse.inq['packageCreator'],
                                            packageID: currentResponse.inq['packageID'],
                                            userID: currentResponse.inq['id_user'],
                                            bookingID: currentResponse.inq['bookingID']
                                        },
                                        async: true,
                                        context: this,
                                        success: function(data) {
                                            requestData(currentResponse.inq['bookingID']);
                                            alert("Your rating and review has been successfully sent!");
                                            console.log(data);
                                        }
                                    });
                                })
                            </script>
                        </div>
                        <!-- COMPLETE -->
                        <div id="transaction-complete" class="file-upload" style="flex-direction: column; height: 300px;">
                            <img src="https://img.icons8.com/plasticine/100/null/checked--v1.png" />
                            <h2 style="text-align: center; color: white;">Package has been rated!</h2>
                        </div>
                    </div>

                </div>
                <!-- RIGHT SIDE: BOOKING TIMELINE -->
                <div class="booking-timeline" style="width: 60%; position: relative;">
                    <div class="timeline">

                    </div>
                </div>
            </div>

        </div>

        <!-- <div data-tab-order class="rate-dest travel-sub" id="trate-dest">
            <form>
                
            </form>
        </div> -->

    </div>
    <script>
        const ordertabs = document.querySelectorAll('[data-order-target]')
        const ordertabContents = document.querySelectorAll('[data-tab-order]')

        ordertabs.forEach(tab => {
            const target = document.querySelector(tab.dataset.orderTarget);
            const currtab = tab;
            $(tab).on('click', function() {
                ordertabContents.forEach(tabContent => {
                    tabContent.classList.remove('active')
                })
                // make tab's title bold
                // then set bold font-weight depending on the selected tab
                ordertabs.forEach(tab => {
                    if (currtab === tab) {
                        tab.classList.add('active');
                        tab.children[1].classList.add('active');
                    } else {
                        tab.classList.remove('active');
                        tab.children[1].classList.remove('active');
                    }
                })
                if (target === document.getElementById('tpayment-info')) {
                    $('#tpayment-info').css('margin', '.5rem auto 0 auto');
                    document.querySelector('.proof-right').classList.remove('active')
                    document.querySelector('.sched-right').classList.remove('active')
                    document.querySelector('.rate-right').classList.remove('active')

                    if (tab === document.getElementById('payment-tab')) {
                        document.querySelector('.proof-right').classList.add('active')
                    } else if (tab === document.getElementById('trip-tab')) {
                        document.querySelector('.sched-right').classList.add('active')
                    } else {
                        document.querySelector('.rate-right').classList.add('active')
                    }
                }

                target.classList.add('active');
                $(".method-selection").css('display', 'none');
                $(".rating-sheet").css('display', 'none');
                $(".proof-upload").css('display', 'flex');
            });
        });

        // Travel Order redirect
        <?php
        if (isset($_GET['orderID'])) {
            $orderdispquery = "SELECT id_user FROM traveldb.booking_tbl AS BK INNER JOIN traveldb.inquiry_tbl AS IQ ON BK.inquiryInfoID = IQ.id WHERE BK.bookingID = {$_GET['orderID']}";
            $sqlquery = mysqli_query($conn, $orderdispquery);
            $userid = mysqli_fetch_array($sqlquery);
            if ($userid[0] == $_SESSION['id']) {
        ?>
            $('#info').removeClass('active');
            $('#travel-order').addClass('active');
            requestData(<?php echo $_GET['orderID'] ?>);
        <?php
            }
        }
        ?>
    </script>
</div>