<div id="package" data-tab-content class=" data-tab-content user-acc active">

    <div class="package-search component">
        <div class="name">
            <span><label for="usr-name"> Name</label></span>
            <span><input type="search" name="usr-name" id="usr-name" placeholder="Enter Full Name" style="width: 90%;"></span>
        </div>
        <div class="cust">
            <span><label for="usr-email">Email</label></span>
            <span><input type="email" name="usr-email" id="usr-email" placeholder="Enter Email" style="width: 90%;"></span>
        </div>
        <div class="cat">
            <span><label for="usr-id">User ID</label></span>
            <span><input type="number" name="usr-id" id="usr-id" placeholder="Enter User ID"></span>
        </div>
        <div class="dur">

        </div>

        <div class="buttons">
            <span><button id="u-get-search">Search</button></span>
            <span><button id="u-reset-search">Reset</button></span>
        </div>
    </div>


    <div class="main-content component" style="margin-top: 10px;">
        <div class="availability-filter">
            <span>
                <input class="usr-inp" type="radio" name="usr-fil" value="usr-all" id="usr-all" style="display: none;" checked>
                <label for="usr-all" class="active"><span>All</span></label>
            </span>
            <span>
                <input class="usr-inp" type="radio" name="usr-fil" value="usr-admin" id="usr-admin" style="display: none;">
                <label for="usr-admin"><span>Admin</span></label>
            </span>
            <span>
                <input class="usr-inp" type="radio" name="usr-fil" value="usr-user" id="usr-user" style="display: none;">
                <label for="usr-user"><span>User</span></label>
            </span>
            <span>
                <input class="usr-inp" type="radio" name="usr-fil" value="usr-manager" id="usr-manager" style="display: none;">
                <label for="usr-manager"><span>Manager</span></label>
            </span>
        </div>
        <div id="full-utable" class="fulltable">
            <?php
            $query_string = "SELECT * FROM  user_tbl where is_deleted = 0; ";

            fetch_user_accounts($query_string, $conn)
            ?>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal-container" id="udmodal_container">
        <div class="user-modal">
            <h1>Confirmation</h1>
            <p>You are about to <strong>delete</strong> an account. By doing this, all of this user's transactions will be deleted as well. Type in "I Understand" to confirm. </p>
            <br><input type="text" name="uconfirm" id="uconfirm" placeholder="I Understand"><br>
            <form action="" method="POST" id="udel-action">
                <div class="buttons">
                    <button type="submit" id="umodalDelete" class="modal-login">Delete Account</button>
                    <a id="modalDClose" class="btn">Cancel</a>
                </div>
            </form>
        </div>
        <script src="assets/js/search-filters.js"></script>
        <script>
            $('#usr-all').prop('checked', true);
            $('#usr-all').next().addClass('active');

            $('#u-get-search').on('click', function() {
                usr_name = $('#usr-name').val();
                usr_email = $('#usr-email').val();
                usr_id = $('#usr-id').val();

                user_data_input();

                if (count != 0) {
                    filterTimeout(usrpostdata, '#full-utable');
                }
                count = 4;

            });

            $('#u-reset-search').on('click', function() {
                usrpostdata = {
                    is_user: true
                }

                filterTimeout(usrpostdata, '#full-utable');
            })

            filterTable(".usr-inp", 'usertype', usrpostdata);

            // Delete Modal Functions
            $('#full-utable').on('click', '.udelete-btn', function() {
                $('#udmodal_container').addClass('show');
                $tr = $(this).closest('tr');

                var data = $tr.children('td').map(function() {
                    return $(this).text();
                }).get();

                $('#udel-action').prop("action", "backend/admin/user_delete.php?id=" + data[0]);
            });

            $('#udmodal_container #confirm').on('input', function() {
                if ($(this).val() == "I Understand") {
                    $('#umodalDelete').prop("disabled", false);
                } else {
                    $('#umodalDelete').prop("disabled", true);
                }
            });

            $('#udmodal_container #modalDClose').on("click", function() {
                $("#udmodal_container").removeClass("show");
                $('#uconfirm').val('');
            });

            $("#udmodal_container").on('click', function(e) {
                if ($("#udmodal_container").has(e.target).length === 0) {
                    $("#udmodal_container").removeClass("show");
                    $('#uconfirm').val('');
                }

            });

        </script>
    </div>
</div>