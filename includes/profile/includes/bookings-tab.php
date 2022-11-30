<div id="package" data-tab-content class="data-tab-content booking">
    <div class="package-search component">
        <div class="name">
            <span><label for="b-package-name">Package Name</label></span>
            <span><input type="search" name="b-package-name" id="b-package-name" placeholder="Enter Package Name"></span>
        </div>
        <div class="dur">
            <span><label for="b-package-transact">TRN</label></span>
            <span><input type="number" name="b-package-transact" id="b-package-transact" placeholder="Enter Transaction Number"></span>
        </div>
        <div class="cat">
            <span><label for="b-package-category">Package ID</label></span>
            <span><input type="number" name="b-package-id" id="b-package-id" placeholder="Enter Package ID"></span>
        </div>
        <div class="cust">
            <span><label for="package-customer">Customer Name</label></span>
            <span><input class="package-customer" type="text" name="package-customer" id="package-customer" placeholder="Enter Customer Name"></span>
        </div>

        <div class="buttons">
            <span><button id="b-get-search">Search</button></span>
            <span><button id="b-reset-search">Reset</button></span>
        </div>
    </div>


    <div class="main-content component" style="margin-top: 10px;">
        <div class="availability-filter">
            <span>
                <input class="stat-inp" type="radio" name="stat-fil" value="s-all" id="s-all" style="display: none;">
                <label for="s-all"><span>All</span></label>
            </span>
            <span>
                <input class="stat-inp" type="radio" name="stat-fil" value="s-unpaid" id="s-unpaid" style="display: none;">
                <label for="s-unpaid"><span>Unpaid</span></label>
            </span>
            <span>
                <input class="stat-inp" type="radio" name="stat-fil" value="s-processing" id="s-processing" style="display: none;">
                <label for="s-processing"><span>Processing</span></label>
            </span>
            <span>
                <input class="stat-inp" type="radio" name="stat-fil" value="s-completed" id="s-completed" style="display: none;">
                <label for="s-completed"><span>Completed</span></label>
            </span>
            <span>
                <input class="stat-inp" type="radio" name="stat-fil" value="s-cancelled" id="s-cancelled" style="display: none;">
                <label for="s-cancelled"><span>Cancelled</span></label>
            </span>
        </div>

        <div id="fullb-table" class="fulltable">
            <?php
            $query_string = "SELECT IQ.*, CONCAT(US.fname, ' ',US.lname) AS fullname, US.id, US.email, US.contactnumber, US.address, BK.*, PK.packageTitle, PK.packageCreator
                            FROM traveldb.inquiry_tbl AS IQ
                            INNER JOIN traveldb.user_tbl AS US ON IQ.id_user = US.id
                            INNER JOIN traveldb.booking_tbl AS BK ON IQ.id = BK.inquiryInfoID 
                            INNER JOIN traveldb.package_tbl AS PK ON IQ.packageID = PK.packageID
                            WHERE PK.packageCreator = {$_SESSION['setID']}";
            fetch_bookingtbl($query_string, $conn);
            mysqli_close($conn);
            ?>
        </div>
        <script src="assets/js/travel-order.js"></script>

    </div>
    <script>
        $('#s-all').prop('checked', true);
        $('#s-all').next().addClass('active');

        bookingpostdata['logged_user'] = 'agency';

        $('#b-get-search').on('click', function() {
            pack_name = $('#b-package-name').val();
            pack_transact = $('#b-package-transact').val();
            pack_id = $('#b-package-id').val();
            pack_customer = $('#package-customer').val();

            booking_data_input();

            if (count != 0) {
                filterTimeout(bookingpostdata, '#fullb-table');
            }
            count = 4;

        });

        $('#b-reset-search').on('click', function() {
            bookingpostdata = {
                booking: true,
                logged_user: 'agency'
            }

            filterTimeout(bookingpostdata, '#fullb-table');
        });

        // Transaction Status Filter
        filterTable(".stat-inp", 'status', bookingpostdata)
    </script>
</div>