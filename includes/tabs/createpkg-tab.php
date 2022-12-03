<div id="create-package" data-tab-content class="data-tab-content">
    <form id="create-form" action="backend\package\package_add.php" method="POST" enctype="multipart/form-data">
        <h1>Basic Travel Package Information</h1>
        <p>Please input the important details about the Travel Package.</p>
        <div class="details">
            <div class="left">
                <div class="row">
                    <span><label for="c-package-name"><span style="color: red;">*</span>Package Name</label></span>
                    <span><input type="text" name="c-package-name" id="c-package-name" required></span>
                </div>
                <div class="row desc">
                    <span><label for="c-package-desc"><span style="color: red;">*</span>Description</label></span>
                    <span><textarea name="c-package-desc" id="c-package-desc" cols="30" rows="10"></textarea></span>
                </div>
                <div class="row">
                    <span><label for="c-package-category"><span style="color: red;">*</span>Category</label></span>
                    <span style="display: flex; align-items: center; margin-right: 0;">
                        <!-- <input type="text" name="package-categories" id="package-categories" placeholder="Select a Category" list="cat-list" /> -->
                        <select name="c-package-category" id="c-package-category">
                            <!-- <datalist id="cat-list"> -->
                            <option value="" disabled selected hidden style="opacity: .5;">Select a Category</option>
                            <option value="beaches">Beaches and Resorts</option>
                            <option value="mountains">Mountains</option>
                            <option value="islands">Islands</option>
                            <option value="animals">Animal Life</option>
                            <option value="recreation">Recreation</option>
                            <option value="historical">Historical Landmarks</option>
                        </select>
                        <input type="hidden" name="hidden-categories" id="hidden-categories" required></input>
                        <!-- </datalist> -->
                        <span id="add-cat" style="margin-left: 10px; cursor: pointer; display: none;"><i class="fas fa-plus"></i></span>

                    </span>
                    <span id="selected-cat-container" style="display:flex; justify-content: flex-end;grid-column: 1 / 3; text-align: unset; margin-right: 0;"></span>

                    <script>
                        var cat_array = [];
                        var $catValue;
                        $('#c-package-category').on('change', function() {
                            $('#add-cat').css("display", "block");
                            $catValue = $('#c-package-category option:selected').text();
                        })

                        $('#add-cat').on('click', function(e) {
                            $('#c-package-category').val('');
                            $(this).css("display", "none");

                            if ((cat_array.length < 3) && (!cat_array.includes($catValue))) {
                                cat_array.push($catValue);
                                var $div = $("<div>", {
                                    "class": "selected-loc",
                                    "text": $catValue
                                });
                                // $div.click(function(){ /* ... */ });
                                $("#selected-cat-container").append($div);

                                var $close = $("<i>", {
                                    "class": "fas fa-times remove-cat",
                                    "style": "margin-left: 10px; font-size: 12px; cursor: pointer;"
                                })
                                document.getElementById("hidden-categories").value = cat_array;
                                $div.append($close);

                            }

                            document.querySelectorAll('.remove-cat').forEach(removebtn => {
                                $(removebtn).on('click', function() {
                                    var remloc = removebtn.parentElement.innerText;
                                    removebtn.parentElement.remove();
                                    cat_array = cat_array.filter(function(letter) {




                                        return letter !== remloc;
                                    });
                                    document.getElementById("hidden-categories").value = cat_array;
                                    console.log(remloc);
                                });
                            });

                        });
                    </script>

                </div>

                <div class="row" id="location-row">
                    <span><label for="c-package-loc"><span style="color: red;">*</span>Locations</label></span>
                    <span style="display: flex; align-items: center; margin-right: 0;">
                        <input type="text" name="package-locations" id="package-locations" placeholder="Enter a Location in the Philippines" list="sample" />
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
                        <input type="hidden" name="hidden-location" id="hidden-location"></input>
                        <span id="add-loc" style="margin-left: 10px; cursor: pointer; display: none;"><i class="fas fa-plus"></i></span>

                    </span>

                    <span id="selected-loc-container" style="display:flex; justify-content: flex-end;grid-column: 1 / 3; text-align: unset; margin-right: 0;">

                    </span>
                    <script>
                        var $currentVal;
                        var loc_array = [];
                        var matchCount = 0;
                        $('#package-locations').on('input', function(e) {
                            var $input = $(this),
                                val = $input.val();
                            $currentVal = val
                            list = $input.attr('list'),
                                match = $('#' + list + ' option').filter(function() {
                                    return ($(this).val() === val);
                                });

                            if (val.length === 0) {
                                $('#add-loc').css("display", "none");
                            } else if (match.length > 0) {
                                $('#add-loc').css("display", "block");
                            } else {
                                $('#add-loc').css("display", "none");
                            }
                        });

                        $('#add-loc').on('click', function(e) {
                            $('#package-locations').val('');
                            $(this).css("display", "none");

                            if ((loc_array.length < 3) && (!loc_array.includes($currentVal))) {
                                loc_array.push($currentVal);

                                var $div = $("<div>", {
                                    "class": "selected-loc",
                                    "text": $currentVal
                                }, );
                                // $div.click(function(){ /* ... */ });
                                $("#selected-loc-container").append($div);

                                var $close = $("<i>", {
                                    "class": "fas fa-times remove-loc",
                                    "style": "margin-left: 10px; font-size: 12px; cursor: pointer;"
                                })

                                document.getElementById("hidden-location").value = loc_array;
                                $div.append($close);
                            }
                            document.querySelectorAll('.remove-loc').forEach(removebtn => {
                                $(removebtn).on('click', function() {
                                    var remloc = removebtn.parentElement.innerText;
                                    removebtn.parentElement.remove();
                                    loc_array = loc_array.filter(function(letter) {

                                        return letter !== remloc;
                                    });
                                    document.getElementById("hidden-location").value = loc_array;
                                });
                            });

                        });
                    </script>

                </div>

                <div class="row">
                    <span><label for="c-package-category"><span style="color: red;">*</span>Inclusions</label></span>
                    <span style="display: flex; align-items: center; margin-right: 0;">
                        <input type="text" name="package-inclusions" id="package-inclusions" placeholder="Input Package Inclusions">
                        <input type="hidden" name="hidden-inclusions" id="hidden-inclusions" required></input>
                        <span id="add-inc" style="margin-left: 10px; cursor: pointer; display: none;"><i class="fas fa-plus"></i></span>

                    </span>
                    <span id="selected-inc-container" style="display:flex; justify-content: flex-end;grid-column: 1 / 3; text-align: unset; margin-right: 0;"></span>

                    <script>
                        var $currentInc;
                        var inc_array = [];
                        $('#package-inclusions').on('input', function(e) {
                            var $input = $(this),
                                val = $input.val();
                            $currentInc = val;

                            if (val.length === 0) {
                                $('#add-inc').css("display", "none");
                            } else {
                                $('#add-inc').css("display", "block");
                            }
                        });

                        $('#add-inc').on('click', function(e) {
                            $('#package-inclusions').val('');
                            $(this).css("display", "none");

                            if ((inc_array.length < 5) && (!inc_array.includes($currentInc))) {
                                inc_array.push($currentInc);

                                var $div = $("<div>", {
                                    "class": "selected-loc",
                                    "text": $currentInc
                                }, );
                                // $div.click(function(){ /* ... */ });
                                $("#selected-inc-container").append($div);

                                var $close = $("<i>", {
                                    "class": "fas fa-times remove-inc",
                                    "style": "margin-left: 10px; font-size: 12px; cursor: pointer;"
                                })

                                document.getElementById("hidden-inclusions").value = inc_array;
                                $div.append($close);
                            }
                            document.querySelectorAll('.remove-inc').forEach(removebtn => {
                                $(removebtn).on('click', function() {
                                    var remloc = removebtn.parentElement.innerText;
                                    removebtn.parentElement.remove();
                                    inc_array = inc_array.filter(function(letter) {

                                        return letter !== remloc;
                                    });
                                    document.getElementById("hidden-inclusions").value = inc_array;
                                });
                            });

                        });
                    </script>


                </div>
            </div>
            <div class="right">
                <h3>Travel Package Images</h3>
                <div class="upload-container">
                    <span style="text-align: center;">
                        <input type="file" name="featured-img" id="featured-img" class="inputfile" accept="image/*" style="display: none;">
                        <label id="label-featured" for="featured-img">
                            <div class="upload-btn">
                                <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                            </div>
                        </label>
                        <div class="uploaded" style="display: none;">
                            <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                        </div>
                        <p class="img-name" style="font-size: 12px;">Featured Photo</p>
                        <input type="hidden" value="Featured Photo">
                        <input type="hidden" name="featured-img-name" id="featured-img-name">
                    </span>
                    <span style="text-align: center;" onclick="onUpdate(1)">
                        <input type="file" name="additional[]" id="img1" class="inputfile" accept="image/*" style="display: none;">
                        <label id="label-img1" for="img1">
                            <div class="upload-btn">
                                <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                            </div>
                        </label>
                        <div class="uploaded" style="display: none;">
                            <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                        </div>
                        <p class="img-name" style="font-size: 12px;">Image 1</p>
                        <input type="hidden" value="Image 1">
                        <input type="hidden" name="img1-name" id="img1-name">
                    </span>
                    <span style="text-align: center;" onclick="onUpdate(2)">
                        <input type="file" name="additional[]" id="img2" class="inputfile" accept="image/*" style="display: none;">
                        <label id="label-img2" for="img2">
                            <div class="upload-btn">
                                <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                            </div>
                        </label>
                        <div class="uploaded" style="display: none;">
                            <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                        </div>
                        <p class="img-name" style="font-size: 12px;">Image 2</p>
                        <input type="hidden" value="Image 2">
                        <input type="hidden" name="img2-name" id="img2-name">
                    </span>
                    <span style="text-align: center;" onclick="onUpdate(3)">
                        <input type="file" name="additional[]" id="img3" class="inputfile" accept="image/*" style="display: none;">
                        <label id="label-img3" for="img3">
                            <div class="upload-btn">
                                <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                            </div>
                        </label>
                        <div class="uploaded" style="display: none;">
                            <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                        </div>
                        <p class="img-name" style="font-size: 12px;">Image 3</p>
                        <input type="hidden" value="Image 3">
                        <input type="hidden" name="img3-name" id="img3-name">
                    </span>
                    <span style="text-align: center;" onclick="onUpdate(4)">
                        <input type="file" name="additional[]" id="img4" class="inputfile" accept="image/*" style="display: none;">
                        <label id="label-img4" for="img4">
                            <div class="upload-btn">
                                <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                            </div>
                        </label>
                        <div class="uploaded" style="display: none;">
                            <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                        </div>
                        <p class="img-name" style="font-size: 12px;">Image 4</p>
                        <input type="hidden" value="Image 4">
                        <input type="hidden" name="img4-name" id="img4-name">
                    </span>
                    <span style="text-align: center;" onclick="onUpdate(5)">
                        <input type="file" name="additional[]" id="img5" class="inputfile" accept="image/*" style="display: none;">
                        <label id="label-img5" for="img5">
                            <div class="upload-btn">
                                <img src="https://img.icons8.com/plasticine/50/000000/plus-2-math.png" />
                            </div>
                        </label>
                        <div class="uploaded" style="display: none;">
                            <img src="https://img.icons8.com/plasticine/50/000000/cancel.png" />
                        </div>
                        <p class="img-name" style="font-size: 12px;">Image 5</p>
                        <input type="hidden" value="Image 5">
                        <input type="hidden" name="img5-name" id="img5-name">
                    </span>

                </div>
            </div>
        </div>
        <hr><br>
        <h1>Availability</h1>
        <div class="details" style="margin-top: 0; margin-bottom: 2rem;">
            <div class="left avail">
                <!-- <span style="margin-bottom: 1rem;">
                
              </span> -->
                <p>Please indicate the important dates for the Tour Schedule.</p>

                <div class="row">
                    <span>Tour Dates</span>
                    <span>
                        <input id="tourduration" type="date-local" name="resdate" placeholder="Select Tour Start" />
                    </span>
                </div>
                <div class="row">
                    <span>Cut-Off</span>
                    <span>
                        <input type="datetime-local" id="cutdate" name="cutdate" placeholder="Select Booking/Cancellation Cut-off" />
                    </span>
                </div>
                <div class="row three">
                    <div style="display: flex;">
                        <span>
                            Age Limit
                        </span>
                        <span class="toggle" style="position: relative;">
                            <label class="toggleswitch">
                                <input id="agelimit-switch" name='isagelimited' type="checkbox" class="switch__input" checked>
                                <span class="slider-circle"></span>
                            </label>
                        </span>
                    </div>
                    <span><input type="number" name="agemin" id="agemin" placeholder="Minimum Age" min="1"></span>
                    <span><input type="number" name="agemax" id="agemax" placeholder="Maximum Age"></span>
                </div>
                <script>
                    $('#agelimit-switch').change(function() {
                        console.log($('#agemin'));
                        console.log($('#agemax'));
                        if ($(this).prop("checked") === true) {
                            $('#agemin').prop('disabled', false);
                            $('#agemax').prop('disabled', false);

                            $('#agemin').css('cursor', 'unset');
                            $('#agemax').css('cursor', 'unset');
                        } else {
                            $('#agemin').prop('disabled', true);
                            $('#agemax').prop('disabled', true);

                            $('#agemin').css('cursor', 'not-allowed');
                            $('#agemax').css('cursor', 'not-allowed');

                            $('#agemin').val('');
                            $('#agemax').val('');
                        }
                    });
                </script>
                <div class="row three">
                    <span>Participant Limit</span>
                    <span><input type="number" name="headmin" id="headmin" placeholder="Minimum #" min="1"></span>
                    <span><input type="number" name="headmax" id="headmax" placeholder="Maximum #"></span>
                </div>
            </div>
            <div class="right">
                <div class="date-display" id="date-display" style="pointer-events: none;"></div>
            </div>
        </div>
        <hr><br>
        <h1>Pricing</h1>
        <p>Setup various Pricing options for the Travel Package.</p>
        <div class="details">
            <div class="left price-fixed">

                <div class="row" style="align-items: unset;">
                    <span>Pricing Method</span>
                    <span>
                        <select name="c-price-method" id="c-price-method">
                            <option value="fixed">Fixed Pricing</option>
                            <option value="person">Priced by Participant Type</option>
                        </select>
                        <span style="font-size: 12px; text-align: justify;">
                            <p id="price-help">The amount to be inputted would be the fixed price of the Package.</p>
                        </span>
                    </span>

                </div>

                <div class="row desc" id="row-base">
                    <span>Base Price</span>
                    <span>
                        <input type="number" name="price-adult" id="price-fixed" placeholder="PHP" min="1">
                    </span>
                </div>

                <div class="row-var" id="row-var" style="display: none;">
                    <div class="row">
                        <span><label for="c-price-senior"><span style="color: red;">*</span>Price per Senior</label></span>
                        <span><input type="number" name="c-price-senior" id="c-price-senior" placeholder="PHP"></span>
                    </div>
                    <div class="row">
                        <span><label for="c-price-adult"><span style="color: red;">*</span>Price per Adult</label></span>
                        <span><input type="number" name="c-price-adult" id="c-price-adult" placeholder="PHP"></span>
                    </div>
                    <div class="row">
                        <span><label for="c-price-child"><span style="color: red;">*</span>Price per Child</label></span>
                        <span><input type="number" name="c-price-child" id="c-price-child" placeholder="PHP"></span>
                    </div>
                </div>

                <script>
                    $('#c-price-method').change(function() {
                        if ($(this).val() == 'person') {
                            $('#row-var').css("display", "grid");
                            $('#row-base').css("display", "none");
                            $('#price-help').text("The pricing will vary depending on the age of the participant.")
                        } else {
                            $('#row-var').css("display", "none");
                            $('#row-base').css("display", "grid");
                            $('#price-help').text('The amount to be inputted would be the fixed price of the Package.')
                        }
                    });
                </script>
            </div>
            <div class="right" style="margin: 0 auto; width: 75%">
                <div class="payment-setting" style="display: grid; grid-template-rows: .3fr .5fr;">
                    <div class="row" style="display: grid; grid-template-columns: 1fr .2fr;">
                        <span>
                            Enable Partial Payment
                        </span>
                        <span class="toggle" style="position: relative;">
                            <label class="toggleswitch">
                                <input id="partial-switch" name='ispartial' type="checkbox" class="switch__input" checked>
                                <span class="slider-circle"></span>
                            </label>
                        </span>
                    </div>
                    <div class="row-setting" style="display: grid; grid-template-rows: .3fr .3fr; margin-top: 1rem;">
                        <div id="radio-div">
                            Set Partial Payment by:
                            <span>
                                <span style=" display: grid; grid-template-columns: .1fr .4fr; align-items: center;">
                                    <input type="radio" name="partial-method" value="percent" id="percentage" checked>
                                    <label for="percentage" style="padding-left: 5px;">Percentage</label>
                                </span>
                                <span style=" display: grid; grid-template-columns: .1fr .4fr; align-items: center;">
                                    <input type="radio" name="partial-method" value="exact" id="amount">
                                    <label for="amount" style="padding-left: 5px;">Exact Amount</label>
                                </span>
                            </span>
                        </div>
                        <div style="margin-top: .6rem; display: grid; grid-template-rows: .2fr .2fr;">
                            <span id="partial-label">Input the Percentage</span>
                            <span>
                                <input type="number" name="partial-amount" id="partial-amount">
                            </span>
                        </div>
                    </div>
                    <script>
                        $('#partial-switch').change(function() {
                            if ($(this).prop("checked") === true) {
                                $('.row-setting').css("display", "grid");

                            } else {
                                $('.row-setting').css("display", "none");
                            }
                        });

                        $('#radio-div').on("change", "input[name='partial-method']", function() {
                            console.log("detected")
                            if ($('#percentage').prop("checked") === true) {
                                $('#partial-label').text("Input the Percentage");
                                console.log($('#partial-label'))
                            } else {
                                $('#partial-label').text("Input Exact Amount");
                                console.log($('#partial-label'))
                            }
                        });
                    </script>
                </div>
            </div>

        </div>
        <div style="text-align: right; margin-top: 1rem;">
            <button type="submit" name="submitpack" class="saveform-btn">Save New Package</button>
        </div>
    </form>
    <script>
        var reset = document.querySelectorAll('.resetting');
        var rowdatareq;

        reset.forEach(r => {
            $(r).on('click', () => {
                // Reset the Form
                $('#create-form')[0].reset();
                $('#selected-cat-container').empty();
                $('#selected-loc-container').empty();
                cat_array = [];
                loc_array = [];

                if (r === document.getElementById('package-create')) {
                    $('#create-form .saveform-btn').text('Save New Package');
                    removeupload.forEach(remover => {
                        removeuploadimg(remover);
                    })
                    displayCal.clear();
                    schedCal.clear();
                    cutoffCal.clear();
                } else {
                    $('#create-form .saveform-btn').text('Save Changes');
                    removeupload.forEach(remover => {
                        removeuploadimg(remover);
                    })

                    $tr = $(r).closest('tr');

                    var data = $tr.children('td').map(function() {
                        return $(this).text();
                    }).get();

                    var packageID = parseInt(data[1]);
                    console.log(packageID);
                    $.ajax({
                        url: 'backend/package/packages_search.php',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            is_editing: 'true',
                            packageID: packageID
                        },
                        async: true,
                        context: this,
                        success: function(response) {
                            console.log("requesting");
                            setDetails(response.details)
                            setCategory(response.category)
                            setLocation(response.location)
                            setDates(response.details)
                            setImages(response.images)
                        }
                    });

                }

            });

        });

        function setDetails($row) {
            // Basic Travel Package Information
            $("#c-package-name").val($row['packageTitle']);
            $("#c-package-desc").val($row['packageDescription']);

            // Availability
            $("#agemin").val(parseInt($row['packageAgeMin']));
            $("#agemax").val(parseInt($row['packageAgeMax']));
            $("#headmin").val(parseInt($row['packagePersonMin']));
            $("#headmax").val(parseInt($row['packagePersonMax']));


            // Pricing
            if (parseInt($row['packagePriceChild']) == '0' && parseInt($row['packagePriceSenior']) == '0') {
                $('#row-var').css("display", "none");
                $('#row-base').css("display", "grid");

                $("#c-price-method").val('fixed');
                $("#price-fixed").val(parseInt($row['packagePrice']));
            } else {
                $('#row-var').css("display", "grid");
                $('#row-base').css("display", "none");

                $("#c-price-method").val('person');
                $("#c-price-senior").val(parseInt($row['packagePriceSenior']));
                $("#c-price-adult").val(parseInt($row['packagePrice']));
                $("#c-price-child").val(parseInt($row['packagePriceChild']));
            }

            if ($row['packagePartialType'] != 'NOT') {
                $("#partial-switch").prop('checked', true);
                $('.row-setting').css("display", "grid");
                if ($row['packagePartialType'] === 'PERCENT') {
                    $("#percentage").prop('checked', true);
                } else {
                    $("#amount").prop('checked', true);
                }
                $("#partial-amount").val(parseInt($row['packagePartialPrice']));
            } else {
                $("#partial-switch").prop('checked', false);
                $('.row-setting').css("display", "none");
            }

        }

        function setCategory(categ) {
            categ.forEach(cat => {
                cat_array.push(cat);
                var $div = $("<div>", {
                    "class": "selected-loc",
                    "text": cat
                });

                $("#selected-cat-container").append($div);

                var $close = $("<i>", {
                    "class": "fas fa-times remove-cat",
                    "style": "margin-left: 10px; font-size: 12px; cursor: pointer;"
                })
                document.getElementById("hidden-categories").value = cat_array;
                $div.append($close);

            });
        }

        function setLocation(locations) {
            console.log(locations)
            locations.forEach(loc => {
                loc_array.push(loc);
                var $div = $("<div>", {
                    "class": "selected-loc",
                    "text": loc
                });

                $("#selected-loc-container").append($div);

                var $close = $("<i>", {
                    "class": "fas fa-times remove-loc",
                    "style": "margin-left: 10px; font-size: 12px; cursor: pointer;"
                })
                document.getElementById("hidden-location").value = loc_array;
                $div.append($close);

            });
        }

        function setDates(details) {
            var start_date = new Date(details['packageStartDate']);
            var end_date = new Date(details['packageEndDate']);
            var cut_date = new Date(details['packageCutoff']);

            schedCal.set('minDate', start_date);
            schedCal.setDate([start_date, end_date], true);

            cutoffCal.set('minDate', cut_date);
            cutoffCal.setDate(cut_date, true)

        }

        function setImages(images) {
            let filetext = $("#featured-img-name").prev().prev();

            $("#featured-img-name").val(images[0])
            $(filetext).text(images[0]);
            $(filetext).prev().css("display", "flex");
            $(filetext).prev().prev().css("display", "none");

            for (let i = 1; i < images.length; i++) {
                let hiddenimgname = "#img" + i + "-name";
                filetext = $(hiddenimgname).prev().prev();

                $(hiddenimgname).val(images[i])
                $(filetext).text(images[i]);
                $(filetext).prev().css("display", "flex");
                $(filetext).prev().prev().css("display", "none");
            }

        }

        function onUpdate(i) {
            let hiddenimgname = "#img" + i + "-name";
            filetext = $(hiddenimgname).prev().prev().text();

            $(hiddenimgname).val(filetext);
        }

        function changeForm() {
            var change = document.getElementById("create-form");
            change.action = "backend\\package\\package_edit.php";
        }

        function returnForm() {
            var change = document.getElementById("create-form");
            change.action = "backend\\package\\package_add.php";
        }
    </script>
</div>