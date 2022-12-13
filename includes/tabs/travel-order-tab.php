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
                    <!-- PAYMONGO MODIFIED START ################################################################# -->
                    <div class="proof-right">
                        <?php
                        if ($_SESSION['active'] == 'u-profile') {
                        ?>
                            <!-- TRAVELER VIEW -->
                            <!-- PAY-PENDING -->
                            <form id="upForm" style="display: none;" onsubmit="return refresh()" target="_self">
                                <div id="waiting-status" class="file-upload" style="flex-direction: column; height: auto; padding: 20px 0; display:none;">
                                    <img src="https://img.icons8.com/plasticine/100/null/cash-in-hand.png" />
                                    <h2 style="text-align: center; color: white;">Waiting for payment...</h2>
                                </div>


                                <input type="number" name="current-bookingID" id="current-bookingID" hidden>
                                <input type="number" name="current-userID" id="current-userID" hidden>
                                <input type="text" name="current-transacNum" id="current-transacNum" hidden>
                                <input type="number" name="current-packageID" id="current-packageID" hidden>
                                <input type="number" name="current-slots" id="current-slots" hidden>

                                <div class="proof-buttons">

                                    <a href="" target="_blank" class="btn btn-long" id="submit-proof" style="text-align: center; font-size: 13.33px">Go to Payment Link</a>
                                    <button type="submit" class="btn btn-long" id="check-payment" style="background: #34495E;">Check Status</button>
                                    <button type="button" class="btn btn-long modal-login" id="cancel-payment" style="background: #ED2939;">Cancel Booking</button>

                                </div>
                            </form>

                            <!-- PAY-COMPLETE -->
                            <div id="trip-confirmed" class="file-upload" style="flex-direction: column; height: 300px; display:none;">
                                <img src="https://img.icons8.com/plasticine/100/null/checked--v1.png" />
                                <h2 style="text-align: center; color: white;">Your Payment has been confirmed!</h2>
                            </div>

                            <!-- CANCELLED -->
                            <div id="trip-cancelled" class="file-upload" style="flex-direction: column; height: 300px; display:none;">
                            <img src="https://img.icons8.com/clouds/100/null/cancel.png"/>
                                <h2 style="text-align: center; color: white;">Your Booking has been cancelled!</h2>
                            </div>
                            
                        <?php
                        } else {
                        ?>
                            <!-- TRAVEL AGENCY VIEW -->
                            <!-- PAY-PENDING -->
                            <div id="waiting-status" class="file-upload" style="flex-direction: column; height: 300px; display:none;">
                                <img src="https://img.icons8.com/plasticine/100/null/submit-progress.png" />
                                <h2 style="text-align: center; color: white;">Waiting for the Traveler Payment...</h2>
                            </div>

                            <!-- PAY-COMPLETE -->
                            <div id="trip-confirmed" class="file-upload" style="flex-direction: column; height: 300px; display:none;">
                                <img src="https://img.icons8.com/plasticine/100/null/checked--v1.png" />
                                <h2 style="text-align: center; color: white;">Payment have been confirmed!</h2>
                            </div>
                            
                            <!-- CANCELLED -->
                            <div id="trip-cancelled" class="file-upload" style="flex-direction: column; height: 300px; display:none;">
                            <img src="https://img.icons8.com/clouds/100/null/cancel.png"/>
                                <h2 style="text-align: center; color: white;">This Booking has been cancelled!</h2>
                            </div>
                          
                        
                        <?php
                        }
                        ?>

                    </div>
                    <div class="modal-container" id="cancel_modal">
                        <div class="user-modal">
                            <h1>Booking Cancellation</h1>
                            <p>You are about to <strong>Cancel</strong> this booking. By cancelling this booking the travel agency will be informed of your decision</p>
                            <br><input type="text" name="confirm" id="confirm" placeholder="I Understand"><br>
                            <form action="" method="POST" id="cancel-booking-form">
                                <div class="buttons">
                                    <button type="submit" id="modalDelete" class="modal-login">Cancel Booking</button>
                                    <a id="modalDClose" class="btn">Nevermind</a>
                                </div>
                            </form>
                        </div>
                        <script>
                            const submitproof = document.getElementById('submit-proof');
                            const checkpay = document.getElementById('check-payment');

                            // const eopen = document.getElementById('modalEOpen');
                            const cancelbutton = document.getElementById('cancel-payment');
                            const cancel_modal = document.getElementById('cancel_modal');
                            const dclose = document.getElementById('modalDClose');
                            const form = document.getElementById('cancel-booking-form');
                            const confirm = document.getElementById('confirm');
                            const bookingID = document.getElementById('current-bookingID');

                            submitproof.addEventListener('click', () => {
                                cancelbutton.disabled = true;
                            })

                            checkpay.addEventListener('click', () => {
                                cancelbutton.disabled = false;
                            })

                            // dopeners.forEach(dopen => {
                            cancelbutton.addEventListener('click', function handleClick(event) {
                                cancel_modal.classList.add('show');

                                console.log(bookingID.value);


                                form.action = "../../backend/booking/booking_cancellation.php?booking_id=" + bookingID.value;


                            });
                            // });

                            document.getElementById('modalDelete').disabled = true;
                            confirm.addEventListener('input', function() {
                                if (this.value == "I Understand") {
                                    document.getElementById('modalDelete').disabled = false;
                                } else {
                                    document.getElementById('modalDelete').disabled = true;
                                }
                            });

                            dclose.addEventListener('click', () => {
                                cancel_modal.classList.remove('show');
                            })
                        </script>
                    </div>

                    <!-- PAYMONGO MODIFIED END ################################################################# -->
                    <div class="proof-right" style="display: none;">
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
                        <!-- <div class="gray-area" id="before-trip">
                            <div class="message"></div>

                            <button class="btn btn-long">Download Receipt</button>
                            <?php
                            // if ($_SESSION['active'] == 'u-profile') {
                            //     echo <<<END
                            // <button class="btn btn-long" style="margin-bottom: 15px; background: #34495E;" id="contact-agency-btn">Contact Travel Agency</button>
                            // END;
                            // echo <<<END
                            // <button class="btn btn-long" style="margin-bottom: 15px; background: #34495E;" id="refund-btn">Request Refund</button>
                            // END;
                            // } else {
                            //     echo <<<END
                            // <button class="btn btn-long" style="margin-bottom: 15px; background: #34495E;" id="contact-cust-btn">Contact Customer</button>
                            // END;
                            // echo <<<END
                            // <button class="btn btn-long" style="margin-bottom: 15px; background: #ED2939; display: none;" id="respond-refund-btn">Refund Request</button>
                            // END;
                            // }
                            ?>
                            
                        </div> -->
                        

                        <?php
                        if ($_SESSION['active'] == 'u-profile') {
                        ?>
                         <div class="gray-area" id="before-trip">
                            <div class="message"></div>

                            <button class="btn btn-long">Download Receipt</button>
                        
                            <button class="btn btn-long" style="margin-bottom: 15px; background: #34495E;" id="contact-agency-btn">Contact Travel Agency</button>
                            <button class="btn btn-long" style="margin-bottom: 15px; background: #34495E;" id="refund-btn">Request Refund</button>
                          
                        </div>

                        <div id="refund-requested" class="file-upload" style="flex-direction: column; height: 300px;">
                            <img src="https://img.icons8.com/external-victoruler-linear-colour-victoruler/64/null/external-refund-food-and-delivery-victoruler-linear-colour-victoruler.png"/>
                            <h2 style="text-align: center; color: white;">You requested a refund <br>for this booking!</h2>
                        </div>

                        <div id="trip-refunded" class="file-upload" style="flex-direction: column; height: 300px;">
                        <img src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-refund-web-store-flaticons-lineal-color-flat-icons.png"/>
                            <h2 style="text-align: center; color: white;">You've successfully <br>refunded and cancelled!</h2>
                        </div>


                        <?php
                        } else {
                        ?>

                            <div class="gray-area" id="before-trip-agency">
                                <div class="message"></div>

                                <button class="btn btn-long">Download Receipt</button>

                                <button class="btn btn-long" style="margin-bottom: 15px; background: #34495E;" id="contact-cust-btn">Contact Customer</button>
                                <button class="btn btn-long" style="margin-bottom: 15px; background: #ED2939; display: none;" id="respond-refund-btn">Refund Request</button>
                          
                            </div>
                            
                            <div id="trip-refunded" class="file-upload" style="flex-direction: column; height: 300px;">
                            <img src="https://img.icons8.com/external-flaticons-lineal-color-flat-icons/64/null/external-refund-web-store-flaticons-lineal-color-flat-icons.png"/>
                                <h2 style="text-align: center; color: white;">Traveler has refunded<br> and cancelled their booking!</h2>
                            </div>

                        <?php
                        }
                        ?>

                        <!-- RATE-PENDING -->

                        

                        <div id="trip-done" class="file-upload" style="flex-direction: column; height: 300px;">
                            <img src="https://img.icons8.com/plasticine/100/null/checked--v1.png" />
                            <h2 style="text-align: center; color: white;">Your Trip has been<br>completed!</h2>
                        </div>
                    </div>

                    <!-- REQUEST REFUND MODAL -->

                    <div class="modal-container" id="refund_modal">
                        <div class="user-modal">
                            <h1>Request Refund</h1>
                            <p>You are about to <strong>Refund</strong> this scheduled booking. To proceed with your refund, please enter a reason why you are refunding</p>
                            <br>
                            <form action="" method="POST" id="refund-booking-form">
            
                                <select type="text" name="refund_confirm" id="refund_confirm" placeholder="I Understand">
                                <option value="duplicate" selected>Duplicate Payment</option>
                                <option value="fraudulent">Fraudulent</option>
                                <option value="requested_by_customer">I changed my mind</option>
                                </select><br>
                                <div class="buttons">
                                    <button type="submit" id="modalRefund" class="modal-login">Request Refund</button>
                                    <a id="modalRClose" class="btn">Nevermind</a>
                                </div> 
                                
                                
                            </form>
                        </div>
                        <script>
                            // const eopen = document.getElementById('modalEOpen');
                            
                            const refund_modal = document.getElementById('refund_modal');
                            const refundclose = document.getElementById('modalRClose');
                            const refundform = document.getElementById('refund-booking-form');
                            const refundconfirm = document.getElementById('refund_confirm');
                            const refbookingID = document.getElementById('current-bookingID');
                           
                            const refundbutton = document.getElementById('refund-btn');
                            refundbutton.addEventListener('click', function handleClick(event) {
                                refund_modal.classList.add('show');

                                console.log(bookingID.value);

                                refundform.action = "../../backend/booking/booking_requestrefund.php?bookingrequest_id=" + refbookingID.value;
                            });
                            
                            // dopeners.forEach(dopen => {
                           
                          
                            // });
                            
                            // document.getElementById('modalRefund').disabled = true;
                            // refundconfirm.addEventListener('input', function() {
                            //     if (this.value == null) {
                            //         document.getElementById('modalRefund').disabled = false;
                            //     } else {
                            //         document.getElementById('modalRefund').disabled = true;
                            //     }
                            // });

                            refundclose.addEventListener('click', () => {
                                refund_modal.classList.remove('show');
                            })
                        </script>
                    </div>
               
                        <div class="modal-container" id="request_modal">
                            <div class="user-modal">
                                <h1>Request Refund</h1>
                                <p>You are about to <strong>Refund</strong> this traveler. To proceed with your refund, please enter the percentage of the refund</p>
                                <br>
                                <form action="" method="POST" id="refundrequest-booking-form">
                                    <label for="current-refundReason">Traveler Reason:</label>
                                    <input type="text" name="current-refundReason" id="current-refundReason" style="cursor: not-allowed;" readonly><br>
                                    
                                    <label for="refundrequest_confirm">Request Decision:</label>
                                    <select name="refundrequest_confirm" id="refund_confirm" onchange="decisionChange()">
                                        <option value="decline" selected>Decline</option>
                                        <option value="accept">Accept</option>
                                    </select><br>
                                    
                                    <label for="current-refundPrice">Refund Amount:</label>
                                    <input type="number" name="current-refundPrice" id="current-refundPrice"><br>
                                    
                                    <input type="text" name="current-transacNum" id="current-transacNum" hidden>
                                    <div class="buttons">
                                        <button type="submit" id="modalRefund" class="modal-login">Confirm</button>
                                        <a id="modalQClose" class="btn">Nevermind</a>
                                    </div>
                                    
                                    
                                </form>
                            </div>
                            <script>
                                // const eopen = document.getElementById('modalEOpen');
                                
                                const refundrequest_modal = document.getElementById('request_modal');
                                const refundrequestclose = document.getElementById('modalQClose');
                                const refundrequestform = document.getElementById('refundrequest-booking-form');
                                const refundrequestconfirm = document.getElementById('refundrequest_confirm');
                                // const bookingID = document.getElementById('current-bookingID');
                            
                                const refundrequestbutton = document.getElementById('respond-refund-btn');
                                const decision =  document.getElementById('refund_confirm');
                                const reqamount = document.getElementById('current-refundPrice');
                                const reqbookingID = document.getElementById('current-bookingID');
                                
                                refundrequestbutton.addEventListener('click', function handleClick(event) {
                                    refundrequest_modal.classList.add('show');

                                    // console.log(bookingID.value);

                                    refundrequestform.action = "../../backend/booking/booking_requestreply.php?bookingrefund_id=" + reqbookingID.value;
                                });
                                
                                // dopeners.forEach(dopen => {
                            
                            
                                // });
                                
                                // document.getElementById('modalRefund').disabled = true;
                                // refundconfirm.addEventListener('input', function() {
                                //     if (this.value == null) {
                                //         document.getElementById('modalRefund').disabled = false;
                                //     } else {
                                //         document.getElementById('modalRefund').disabled = true;
                                //     }
                                // });
                                document.getElementById('current-refundPrice').disabled = true;

                                function decisionChange() {
                                    if (this.value == 'decline') {
                                        document.getElementById('current-refundPrice').disabled = true;
                                    } else {
                                        document.getElementById('current-refundPrice').disabled = false;
                                    }
                                }
                               
                                // decision.addEventListener("onchange", () => {
                                //     if(this.value == 'accept'){
                                //         document.getElementById('current-refundPrice').disabled = false;
                                //     }else document.getElementById('current-refundPrice').disabled = true;
                                // })

                                refundrequestclose.addEventListener('click', () => {
                                    refundrequest_modal.classList.remove('show');
                                })
                            </script>
                        </div>
                    

                    


                    <!-- RATE PACKAGE TAB -->
                    <div class="rate-right">
                        <!-- RATE-PENDING -->
                        <?php if ($_SESSION['active'] == 'a-profile') { ?>
                        <div id="a-before-rate" class="file-upload" style="flex-direction: column; height: 300px; display:none;">
                                <img src="https://img.icons8.com/plasticine/100/null/submit-progress.png" />
                                <h2 style="text-align: center; color: white;">Waiting for the<br>Customer Rating...</h2>
                        </div>
                        <?php } else { ?>
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

                                $("input[name='pack-rating']").on('change', function() {
                                    ratingText("pack-rating", "#p-rating-text");
                                });
                                $("input[name='agency-rating']").on('change', function() {
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
                        <?php } ?>
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
            $orderdispquery = "SELECT id_user FROM  booking_tbl AS BK INNER JOIN  inquiry_tbl AS IQ ON BK.inquiryInfoID = IQ.id WHERE BK.bookingID = {$_GET['orderID']}";
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