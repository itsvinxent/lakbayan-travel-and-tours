<div id="package" data-tab-content class="data-tab-content packages">
    <div class="package-search component">
        <div class="name">
            <span><label for="package-name">Package Name</label></span>
            <span><input class="package-property" type="search" name="package-name" id="package-name" placeholder="Enter Package Name"></span>
        </div>
        <div class="dur">
            <span><label for="package-duration">Duration</label></span>
            <span><input type="number" name="package-duration" id="package-duration" min="1" max="14" placeholder="Enter Number of Days (1-14)"></span>
        </div>
        <div class="cat">
            <span><label for="package-category">Category</label></span>
            <span>
                <select name="package-category" id="package-category">
                    <option value="" disabled selected hidden style="opacity: .5;">Select a Category</option>
                    <option value="beaches">Beaches and Resorts</option>
                    <option value="mountains">Mountains</option>
                    <option value="islands">Islands</option>
                    <option value="animals">Animal Life</option>
                    <option value="recreation">Recreation</option>
                    <option value="historical">Historical Landmarks</option>
                </select>
            </span>
        </div>
        <div class="loc">
            <span><label for="package-location">Location</label></span>
            <span class="loc-search">
                <!-- <input type="text" name="package-location" id="package-location" placeholder="Enter a Location in the Philippines">
                <div class="hints" style="max-height: 200px; overflow-y: scroll;"></div>
                <div class="empty-hints"><span>No Results</span></div>
                <div class="loading-hints"><span style="text-align: center; align-items:center;"><img src="assets/img/locsearchloading.gif" alt=""></span></div> -->
                <input type="text" name="package-location" id="package-location" placeholder="Enter a Location in the Philippines" list="sample" />
                <datalist id="sample">
                    <?php
                    $locquerystring = "SELECT DISTINCT City FROM areas_tbl;";
                    $array = array();
                    $query = mysqli_query($conn, $locquerystring);

                    while ($row = mysqli_fetch_assoc($query)) {
                        $array[] = $row['City'];
                    }

                    for ($i = 0; $i < count($array); $i++) {
                        echo '<option value="' . $array[$i] . '">' . $array[$i] . '</option>';
                    }

                    ?>
                </datalist>
            </span>

        </div>

        <div class="buttons">
            <span><button id="get-search">Search</button></span>
            <span><button id="reset-search">Reset</button></span>
        </div>
    </div>


    <div class="main-content component" style="margin-top: 10px;">
        <div class="availability-filter">
            <span>
                <input class="avail-inp" type="radio" name="avail-fil" value="a-all" id="a-all" style="display: none;">
                <label for="a-all"><span>All</span></label>
            </span>
            <span>
                <input class="avail-inp" type="radio" name="avail-fil" value="a-available" id="a-available" style="display: none;">
                <label for="a-available"><span>Available</span></label>
            </span>
            <span>
                <input class="avail-inp" type="radio" name="avail-fil" value="a-unlisted" id="a-unlisted" style="display: none;">
                <label for="a-unlisted"> <span>Unlisted</span> </label>
            </span>
        </div>
        <div id="full-table" class="fulltable">
            <?php
            if ($_SESSION['utype'] == 'manager') {
                $query_string = "SELECT PK.*, FORMAT(PK.packagePrice, 0) AS fresult, DATEDIFF(packageEndDate, packageStartDate) AS packagePeriod, AI.*, AG.agencyName, AG.agencyManID
                                FROM traveldb.package_tbl AS PK 
                                INNER JOIN traveldb.agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                                INNER JOIN traveldb.packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom 
                                WHERE packageCreator = $_SESSION[setID] AND PK.is_deleted = 0
                                GROUP BY AI.packageIDFrom";

                fetch_packagetbl($query_string, $conn, true);
            } else if ($_SESSION['utype'] == 'admin') {
                $query_string = "SELECT PK.*, FORMAT(PK.packagePrice, 0) AS fresult, DATEDIFF(packageEndDate, packageStartDate) AS packagePeriod, AI.*, AG.agencyName, AG.agencyManID
                                FROM traveldb.package_tbl AS PK 
                                INNER JOIN traveldb.agency_tbl AS AG ON AG.agencyID = PK.packageCreator
                                INNER JOIN traveldb.packageimg_tbl AS AI ON PK.packageID = AI.packageIDFrom 
                                WHERE PK.is_deleted = 0
                                GROUP BY AI.packageIDFrom";

                fetch_packagetbl($query_string, $conn, false);
            }
            ?>
        </div>
    </div>
    <!-- Delete Travel Package Modal -->
    <div class="modal-container" id="dmodal_container">
        <div class="user-modal">
            <h1>Confirmation</h1>
            <p>You are about to <strong>delete</strong> a Travel Package. Type in "I Understand" to confirm. </p>
            <br><input type="text" name="confirm" id="confirm" placeholder="I Understand"><br>
            <form action="" method="POST" id="del-action">
                <div class="buttons">
                    <button type="submit" id="modalDelete" class="modal-login" disabled>Delete Account</button>
                    <a id="modalDClose" class="btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/search-filters.js"></script>
    <script>
        $('#a-all').prop('checked', true);
        $('#a-all').next().addClass('active');
        var usertp = <?php
                        if ($_SESSION['utype'] == 'manager') {
                            echo "'agency';";
                        } else if ($_SESSION['utype'] == 'admin') {
                            echo "'admin';";
                        }
                        ?>
        postdata['logged_user'] = usertp;
        $('#get-search').on('click', function() {
            pack_name = $('#package-name').val();
            pack_location = $('#package-location').val();
            pack_cat = $('#package-category').val();
            pack_duration = $('#package-duration').val();

            package_data_input();

            if (count != 0) {
                filterTimeout(postdata, '#full-table');
            }
            count = 4;

        });

        $('#reset-search').on('click', function() {
            postdata = {
                is_filtering: true,
                logged_user: usertp
            }

            filterTimeout(postdata, '#full-table');
        })

        filterTable(".avail-inp", 'availability', postdata);

        // Delete Travel Package Functions
        // $('#full-table .delete-btn').each(function() {
        $('#full-table').on('click', '.delete-btn', function() {
            $('#dmodal_container').addClass('show');

            $tr = $(this).closest('tr');
            var data = $tr.children('td').map(function() {
                return $(this).text();
            }).get();

            $('#del-action').prop("action", "backend/package/package_delete.php?utype=agency&id=" + data[1]);

        })

        // });

        $('#dmodal_container #confirm').on('input', function() {
            if ($(this).val() == "I UNDERSTAND") {
                $('#modalDelete').prop("disabled", false);
            } else {
                $('#modalDelete').prop("disabled", true);
            }
        });

        $('#dmodal_container #modalDClose').on("click", function() {
            $("#dmodal_container").removeClass("show");
            $('#confirm').val('');
        });

        $("#dmodal_container").on('click', function(e) {
            if ($("#dmodal_container").has(e.target).length === 0) {
                $("#dmodal_container").removeClass("show");
                $('#confirm').val('');
            }

        });
    </script>

</div>