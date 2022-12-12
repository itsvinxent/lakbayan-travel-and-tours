<div id="package" data-tab-content class="data-tab-content verifications">
    <div class="package-search component">
        <div class="name">
            <span><label for="v-agency-name">Agency Name</label></span>
            <span><input type="search" name="v-agency-name" id="v-agency-name" placeholder="Enter Agency Name" style="width: 90%;"></span>
        </div>
        <div class="dur">
            <span><label for="v-dot-num">DOT #</label></span>
            <span><input type="text" name="v-dot-num" id="v-dot-num" placeholder="Enter DOT Accreditation #"></span>
        </div>
        <div class="cat">
            <span><label for="v-agency-id">Agency ID</label></span>
            <span><input type="number" name="v-agency-id" id="v-agency-id" placeholder="Enter Agency ID"></span>
        </div>
        <div class="cust">
            <span><label for="v-man-name">Manager</label></span>
            <span><input class="" type="text" name="v-man-name" id="v-man-name" placeholder="Enter Manager Name" style="width: 90%;"></span>
        </div>

        <div class="buttons">
            <span><button id="v-get-search">Search</button></span>
            <span><button id="v-reset-search">Reset</button></span>
        </div>
    </div>


    <div class="main-content component" style="margin-top: 10px;">
        <div class="availability-filter">
            <span>
                <input class="ver-inp" type="radio" name="ver-fil" value="v-all" id="v-all" style="display: none;" checked>
                <label for="v-all" class="active"><span>All</span></label>
            </span>
            <span>
                <input class="ver-inp" type="radio" name="ver-fil" value="v-pending" id="v-pending" style="display: none;">
                <label for="v-pending"><span>Pending</span></label>
            </span>
            <span>
                <input class="ver-inp" type="radio" name="ver-fil" value="v-denied" id="v-denied" style="display: none;">
                <label for="v-denied"><span>Denied</span></label>
            </span>
            <span>
                <input class="ver-inp" type="radio" name="ver-fil" value="v-verified" id="v-verified" style="display: none;">
                <label for="v-verified"><span>Verified</span></label>
            </span>
        </div>
        <div id="full-vtable" class="fulltable">
            
        </div>
    </div>
    <!-- Verification Modal -->
    <div class="modal-container" id="vmodal_container">
        <div class="user-modal" style="display: flex; flex-direction: row; width: 700px; gap: 10px; position: relative;">
            <div class="image-container">
                <img id="certificateImg">
                <a href="" onclick="window.open(this.href, '_blank', 'left=20,top=20,width=650,height=650,toolbar=1,resizable=0'); return false;">
                    <div class="hint">Click to View Full Image</div>
                </a>
            </div>
            <div style="display: flex; flex-direction:column; width: 50%; justify-content: space-between; align-items: center;">
                <div class="accred-details">
                    <h2></h2>
                    <p style="font-weight: bold;"></p>
                </div>
                <div class="accred-stat">
                    <img src="" />
                    <p class="acc-stat-text" style="font-size: 13px;"></p>
                </div>
                <div class="proof-buttons">
                    <input type="hidden" name="agencyID">
                    <button type="button" class="btn btn-long" id="approve-ver">Approve Verification</button>
                    <button type="button" class="btn btn-long" id="deny-ver" style="background-color: #ED2939;">Deny Verification</button>
                </div>
                <script>
                    $('#approve-ver').on('click', function() {
                        approveVerify('verified');
                    });
                    $('#deny-ver').on('click', function() {
                        approveVerify('denied');
                    });
                </script>
            </div>
            <span id="close-ver" style="position: absolute; top: 5px; right: 10px; font-size: 20px; cursor: pointer;"><i class="fas fa-times"></i></span>
        </div>
    </div>
    <script src="assets/js/search-filters.js"></script>
    <script>
        $('#v-all').prop('checked', true);
        $('#v-all').next().addClass('active');

        $('#v-get-search').on('click', function() {
            ver_agencyname = $('#v-agency-name').val();
            ver_dotnum = $('#v-dot-num').val();
            ver_agencyid = $('#v-agency-id').val();
            ver_mgname = $('#v-man-name').val();

            verify_data_input();

            if (count != 0) {
                filterTimeout(verpostdata, '#full-vtable');
            }
            count = 4;

        });

        $('#v-reset-search').on('click', function() {
            verpostdata = {
                verify: true
            }

            filterTimeout(verpostdata, '#full-vtable');
        })

        filterTable(".ver-inp", 'verstatus', verpostdata);

        // Reload Table
        function reloadAgencyTable() {
            $.ajax({
                url: 'backend/admin/agency_search.php',
                method: 'POST',
                data: {
                    isReloadingTable: 'true'
                },
                async: true,
                context: this,
                success: function(data) {
                    $('#full-vtable').empty();
                    $('#full-vtable').html(data);
                }
            });
        }
        
        reloadAgencyTable();

        // Open Modal
        $('#full-vtable').on('click', '.approve-stat-btn', function() {
            $('#vmodal_container').addClass('show');
            $tr = $(this).closest('tr');

            //Set agencyID
            $('.proof-buttons input[name="agencyID"]').val($($tr.children('td')[1]).text())

            // Set Certificate Image
            var verImg = $($tr.children('td')[7]).text();
            $('#certificateImg').attr("src", "assets/img/users/admin/certificates/" + verImg);
            $('.image-container a').attr("href", "assets/img/users/admin/certificates/" + verImg);

            // Set Text Contents
            $('.accred-details h2').text($($tr.children('td')[2]).text());
            $('.accred-details p').text($($tr.children('td')[4]).text());

            // Set Accreditation Status 
            if ($($tr.children('td')[8]).text() == 1) {
                $('.accred-stat img').attr("src", "assets/img/icons8-ok-48.png");
                $('.accred-stat p').text('A matching accreditation number is found in the DOT Accreditation List.');
            } else {
                $('.accred-stat img').attr("src", "assets/img/icons8-cancel-48.png");
                $('.accred-stat p').text('There is no matching accreditation number found from the DOT Accreditation List.');
            }

        })
        
        // Close Modal
        function close_vmodal() {
            $("#vmodal_container").removeClass("show");
            $('.image-container a').attr("href", "");
        }

        $('#vmodal_container #close-ver').on("click", function() {
            close_vmodal();
        });

        $("#vmodal_container").on('click', function(e) {
            if ($("#vmodal_container").has(e.target).length === 0) {
                close_vmodal();
            }

        });

        // Modal Approve / Deny Functions
        function approveVerify(status) {
            $.ajax({
                url: 'backend/admin/agency_setVerify.php',
                method: 'POST',
                data: {
                    agencyID: $('.proof-buttons input[name="agencyID"]').val(),
                    status: status
                },
                async: true,
                context: this,
                success: function(data) {
                    if (data != "failed") {
                        alert('Action has been successfully completed.');
                        getPending();
                    } else {
                        alert('ERROR Code ' + data + ' - Action Failed, Contact the Administrator.');
                    }
                    reloadAgencyTable();
                }
            });
            close_vmodal();
        }
    </script>
</div>