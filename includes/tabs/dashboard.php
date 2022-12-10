<div id="dashboard" data-tab-content class="data-tab-content dashboard">
    <div class="header" style="display: flex; flex-wrap: nowrap; justify-content: space-between;">
        <h1>Performance Overview</h1>
        <select name="date-filter" id="date-filter">
            <option value="all-time" selected>All Time</option>
            <?php
            // Currently Starts from the month of joindate to the current date
            // possibly adjust starting period to current date - 5 months
            $dateToAdd = 0;
            $qry = "SELECT `joindate` FROM user_tbl WHERE `id` = {$_SESSION['setManID']}";
            $result = mysqli_fetch_assoc(mysqli_query($conn, $qry));
            $joindate = strtotime($result['joindate']);
            $datelmt =  strtotime(date("Y-m-d H:i:s"));

            $join_month = date('Y m', $joindate);
            $lmt_month = date('Y m', $datelmt);

            while ($join_month <= $lmt_month) {
                echo "<option value='$join_month'>" . date('M Y', strtotime("+" . $dateToAdd . " month", $joindate)) . "</option>";
                $dateToAdd++;
                $join_month = date('Y m', strtotime("+" . $dateToAdd . " month", $joindate));
            }
            ?>
        </select>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script>
            function dashboardRequest(dateVal) {
                $.ajax({
                    url: 'backend/statistics/dashboard-data.php',
                    method: 'POST',
                    data: {
                        dateValue: dateVal,
                        agencyID: '<?php echo $_SESSION['setID'] ?>'
                    },
                    async: true,
                    context: this,
                    success: function(response) {
                        $('#dashboard #main-container').empty();
                        $('#dashboard #main-container').html(response);
                    }
                });
            }
                        
            $('#date-filter').on('change', function() {
                var dateVal = $(this).val();
                dashboardRequest(dateVal);
            });

            $('#load-charts').on('click', function() {
                dashboardRequest('all-time');
            })


        </script>
    </div>
    <div class="main-container" id="main-container">
    
    </div>
</div>