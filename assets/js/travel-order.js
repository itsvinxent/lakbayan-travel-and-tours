var currentResponse;
$('#fullb-table').on('click', '.to_travel_order', function () {
    $tr = $(this).closest('tr');
    // var inquiryInfoID = parseInt($($tr.children('td')[1]).text());
    var bookingID = parseInt($($tr.children('td')[2]).text());

    requestData(bookingID);
});

function requestData(bookingID) {
    $.ajax({
        url: 'backend/package/packages_search.php',
        method: 'POST',
        dataType: 'json',
        data: {
            is_travel: 'true',
            // inquiryInfoID: inquiryID,
            bookingID: bookingID
        },
        async: true,
        context: this,
        success: function (response) {
            currentResponse = response;
            $('#progress-bar').children().each(function () {
                $(this).removeClass('gray');
                $(this).removeClass('green');
            })
            $('input[name="current-bookingID"]').val(parseInt(response.inq['bookingID']));
            $('input[name="current-userID"]').val(parseInt(response.inq['id_user']));
            $('input[name="current-packageID"]').val(parseInt(response.inq['packageID']));
            $('input[name="current-transacNum"]').val(response.inq['bookingTransacNum']);
           
            setTabs(response.inq['bookingStatus']);
            setBooking(response);
            setPayment(response);
            setTrip(response);
            setTimeline(response);
        }
    });
}

function setTabs(status) {
    var limit = 0;

    switch (status) {
        case 'pay-pending':
            limit = 2;
            break;
        case 'confirm-pending':
            limit = 2;
            break;
        case 'pay-denied':
            limit = 2;
            break;
        case 'trip-sched':
            limit = 4;
            break;
        case 'refund-request':
            limit = 4;
            break;
        case 'refund-denied':
            limit = 4;
            break;
        case 'refunded':
            limit = 4;
            break;
        case 'rate-pending':
            limit = 6;
            break;
        case 'complete':
            limit = 8;
            break;
        default:
            limit = 2;
            break;
    }
    
    for (let index = 0; index <= 8; index += 2) {
        var target = $('#progress-bar').children()[index];
        var bar = $('#progress-bar').children()[index - 1];

        if (index <= limit) {
            $(target).css('pointer-events', 'all');
            $(target).removeClass('gray');
            $(target).toggleClass('green');

            if (index != 0) {
                $(bar).removeClass('gray');
                $(bar).toggleClass('green');
            }
        } else {
            $(target).css('pointer-events', 'none');
            $(target).toggleClass('gray');
            $(target).removeClass('green');
            $(bar).toggleClass('gray');
            $(bar).removeClass('green');
        }
    }
    // Reset Tab Visibility and Title ()
    $('#tbooking-placed').addClass('active');
    $('#tpayment-info').removeClass('active');
    $('#trate-dest').removeClass('active');
    $('.title').each(function () {
        $(this).removeClass('active');
    });
    $('#bktitle').addClass('active');
}

function setBooking(response) {
    var inq = response.inq;
    // Booking Placed Tab
    $('.ord_packageTitle').text(inq['packageTitle']);
    $('.ord_packageCreator').text(inq['agencyName']);
    // Client Information
    $('.ord_name').text(inq['fullname']);
    $('.ord_email').text(inq['email']);
    $('.ord_contact').text(inq['contactnumber']);
    $('.ord_address').text(inq['address']);

    // Booking Information
    var totalpersons = parseInt(inq['childrenCount']) + parseInt(inq['adultCount']) + parseInt(inq['seniorCount']);
    $('input[name="current-slots"]').val(parseInt(inq['packageSlots']) - totalpersons);
    
    if (parseInt(inq['packagePriceChild']) == 0 && parseInt(inq['packagePriceSenior']) == 0) {
        $('.booking-per-person').css('display', 'none');
        $('.booking-fixed').css('display', 'contents');

        var chword;
        var price = parseInt(inq['packagePrice']) * totalpersons;
        totalpersons > 1 ? chword = 'Persons' : chword = 'Person';
        $('.ord_fixedcomp').text('₱' + inq['packagePrice'] + ' x ' + totalpersons + ' ' + chword);
        $('.ord_fixedtotal').text('₱' + price);
        $('.ord_booktotal').text('₱' + price);
        $('.ord_packagePrice').text('₱' + inq['packagePrice']);

    } else {
        var totalPrice = 0;
        $('.booking-per-person').css('display', 'contents');
        $('.booking-fixed').css('display', 'none');

        var chword;
        inq['infantCount'] > 1 ? chword = 'Infants' : chword = 'Infant'
        $('.ord_infantcomp').text('₱0 x ' + inq['infantCount'] + ' ' + chword)
        $('.ord_infanttotal').text('₱0');

        var childTotal = (parseInt(inq['childrenCount']) * parseInt(inq['packagePriceChild']));
        totalPrice += childTotal;
        inq['childrenCount'] > 1 ? chword = 'Children' : chword = 'Child'
        $('.ord_childrencomp').text('₱' + inq['packagePriceChild'] + ' x ' + inq['childrenCount'] + ' ' + chword)
        $('.ord_childrentotal').text('₱' + childTotal);

        var adultTotal = (parseInt(inq['adultCount']) * parseInt(inq['packagePrice']));
        totalPrice += adultTotal;
        inq['adultCount'] > 1 ? chword = 'Adults' : chword = 'Adult'
        $('.ord_adultcomp').text('₱' + inq['packagePrice'] + ' x ' + inq['adultCount'] + ' ' + chword)
        $('.ord_adulttotal').text('₱' + adultTotal);

        var seniorTotal = (parseInt(inq['seniorCount']) * parseInt(inq['packagePriceSenior']));
        totalPrice += seniorTotal;
        inq['seniorCount'] > 1 ? chword = 'Seniors' : chword = 'Senior'
        $('.ord_seniorcomp').text('₱' + inq['packagePriceSenior'] + ' x ' + inq['seniorCount'] + ' ' + chword)
        $('.ord_seniortotal').text('₱' + seniorTotal);

        $('.ord_booktotal').text('₱' + totalPrice);
        $('.ord_packagePrice').text('₱' + inq['packagePriceChild']);

    }

}

function setPayment(response) {
    var inq = response.inq;

    // Payment Tab
    // Reset UI
    $('#upForm').css('display', 'none');
    $('#waiting-status').css('display', 'none');
    $('#approveForm').css('display', 'none');
    $('#waiting-confirm').css('display', 'none');
    $('#trip-confirmed').css('display', 'none');
    $('#before-trip').css('display', 'none');
    $('#before-rate').css('display', 'none');
    $('#trip-done').css('display', 'none');
    $('#transaction-complete').css('display', 'none');
    $('#trip-cancelled').css('display', 'none');

    $('#respond-refund-btn').css('display', 'none');
    $('#refund-requested').css('display', 'none');
    $('#trip-refunded').css('display', 'none');
    $('#before-trip-agency').css('display', 'none');

    $('.method-selection').css('display', 'none');
    $('.rating-sheet').css('display', 'none');
    $('.proof-upload').css('display', 'flex');

    if (inq['bookingStatus'] == 'pay-pending' || inq['bookingStatus'] == 'pay-denied') {
        $('#waiting-status').css('display', 'flex'); // Agency
        $('#upForm').css('display', 'block'); // Traveler
        $('#submit-proof').attr('href','https://pm.link/lakbayantesting/test/'+inq['bookingTransacNum'])
    } else if (inq['bookingStatus'] == 'confirm-pending') {
        $('#approveForm').css('display', 'block'); // Agency
        $('#waiting-confirm').css('display', 'flex'); // Traveler
    } else if (inq['bookingStatus'] == 'cancelled'){
        $('#trip-cancelled').css('display', 'flex');
    } else {
        $('#trip-confirmed').css('display', 'flex');
    }

    if (inq['bookingStatus'] == 'trip-sched' || inq['bookingStatus'] == 'refund-denied') {
        $('#before-trip').css('display', 'block');
        $('#before-trip-agency').css('display', 'block');
    } else if(inq['bookingStatus'] == 'refund-request') { //REQUEST REFUND
        $('#refund-requested').css('display', 'flex')
        $('#before-trip-agency').css('display', 'block');
        $('#respond-refund-btn').css('display', 'block');

        $('#current-refundReason').val(inq['bookingProofImg']);
        $('#current-refundPrice').attr({
            "value" : inq['bookingPrice'],
            "max" : inq['bookingPrice'],
            "min" : inq['bookingPrice'] * .90
        });

    } else if(inq['bookingStatus'] == 'refunded'){
        $('#trip-refunded').css('display', 'flex');
    }
    else {
        $('#trip-done').css('display', 'flex');
    }

    if (inq['bookingStatus'] == 'rate-pending') {
        $('#before-rate').css('display', 'block');
        $('#a-before-rate').css('display', 'flex');
    } else {
        $('#transaction-complete').css('display', 'flex');
    }
        
    // Set Image Proof
    let src = "assets/img/users/traveler/" + inq['id_user'] + "/proof/" + inq['bookingID'] + "/" + inq['bookingProofImg'];
    $('#image-proof').attr("src", src);
    $('.drag-area a').attr("href", src);

    // Set the previously selected payment method
    $('input[name="payment-method"]').filter('[value="' + inq['bookingMethod'] + '"]').prop('checked', true);

}

function setTrip(response) {
    var inq = response.inq;

    // Trip Scheduled Tab
    var startdate = new Date(inq['packageStartDate']).toLocaleDateString('en-us', { weekday: "long", year: "numeric", month: "short", day: "numeric" });
    var enddate = new Date(inq['packageEndDate']).toLocaleDateString('en-us', { weekday: "long", year: "numeric", month: "short", day: "numeric" });

    $('.sched-right .message').text('Payment has been settled. Your trip is scheduled on ' + startdate + ' to ' + enddate + '.');
    $('#book-again-btn').on('click', function (e) {
        e.preventDefault();
        location.href = 'includes/packages/details.php?packageid='+ inq['packageID'] + '&agentid=' + inq['agencyManID'];
    })
    $('#contact-agency-btn').on('click', function (e) {
        e.preventDefault();
        location.href = 'backend/chat/chatmain.php?chatid=' + inq['agencyManID'];
    })
    $('#contact-cust-btn').on('click', function (e) {
        e.preventDefault();
        location.href = 'backend/chat/chatmain.php?chatid=' + inq['id_user'];
    })
}

function newElement(tag, classname, style, text) {
    return $(tag, { "class": classname, "style": style, "text": text })
}

function statusText(status, method, isUser) {
    var text = "";
    switch (status) {
        case 'pay-pending':
            text = 'Awaiting Payment via ' + method;
            break;
        case 'confirm-pending':
            if (isUser) text = 'Awaiting Confirmation of your Payment.';
            else text = 'Awaiting your Confirmation of the Payment.';
            break;
        case 'pay-denied':
            if (isUser) text = 'Your Proof has been denied by the Agency.';
            else text = "You denied the traveler's Payment Proof.";
            break;
        case 'trip-sched':
            if (isUser) text = 'Your trip has been scheduled.';
            else text = 'The trip has been scheduled.';
            break;
        case 'rate-pending':
            if (isUser) text = 'Awaiting for your package rating and review.';
            else text = 'Awaiting for the rating of the customer.';
            break;
        case 'refund-request':
            if (isUser) text = 'You requested a refund';
            else text = 'Traveler requested for a refund';
            break;
        case 'refund-denied':
            if (isUser) text = 'Your refund has been denied';
            else text = 'You denied the refund request';
            break;    
        case 'refunded':
            if (isUser) text = 'Your refund has been granted';
            else text = 'You accepted the refund request';
            break;
        case 'complete':
            text = 'The transaction is completed. Thank you!';
            break;
        case 'cancelled':
            text = 'The transaction has been cancelled.';
            break;
        default:
            text = '';
            break;
    }
    return text;
}

function createTimelineItem(timestamp, statustext, includeBar) {
    var $timeline_item = newElement("<div>", "timeline-item", "", "");
    var $milestone_dot = newElement("<div>", "milestone-dot", "", "");
    var $milestone_bar = newElement("<div>", "milestone-bar", "", "");
    if (includeBar) {
        $($milestone_dot).append($milestone_bar);
    }
    var $row = newElement("<div>", "", "width: 100%; display: flex; flex-wrap: no-wrap;", "");
    var $datetime = newElement("<p>", "datetime", "width: 30%", timestamp);
    var $milestone = newElement("<p>", "milestone", "width: 70%", statustext);
    $($row).append($datetime, $milestone);

    $($timeline_item).append($milestone_dot, $row);

    $('.timeline').append($timeline_item);
}

function setTimeline(response) {
    var path = window.location.pathname;
    var page = path.split("/").pop();
    page == "user-profile.php" ? isUser = true : isUser = false;

    var status = response.status.reverse();
    $('.timeline').empty();

    for (let index = 0; index < status.length; index++) {
        var stat = status[index];

        statText = statusText(stat['bookingStatus'], response.inq['bookingMethod'], isUser);
        statusTimestamp = stat['timestamp'];
        createTimelineItem(statusTimestamp, statText, index > 0);
    }

    createTimelineItem(response.status[status.length - 1]['timestamp'], "Booking Placed by the traveler.", true);

}

function up() {
    // var data = new FormData(document.getElementById("upForm"));

    fetch("backend/booking/booking_proofupload.php", { method: "POST", body: data })
        .then(res => res.text())
        .then(function (code) {
            // 1 = SUCCESS
            // 0 = DATABASE ERROR
            // -1 = IMAGE VERIFICATION ERROR
            // -2 = IMAGE UPLOAD ERROR
            if (code == 1) {
                alert("Successfully uploaded the proof!");
                let inq = currentResponse.inq;
                requestData(inq['bookingID']);
            } else if (code == 0) {
                alert("ERROR Code " + code + " - An error with the database has occurred.");
            } else if (code == -1) {
                alert("ERROR Code " + code + " - An error with the Uploaded Image has been detected.");
            } else {
                alert("ERROR Code " + code + " - Unable to upload the image.");
            }

            $('#payment-proof').remove();
            $(".drag-area").removeClass("active");
            $(".drag-area").empty();
            $(".drag-area").html(olddropArea);
            $("#upForm .file-upload").append(fileinput);
            $('#payment-proof')[0].value = '';

        })
        .catch(err => console.error(err));
    return false;
}

function approve() {
    var data = new FormData(document.getElementById("approveForm"));

    fetch("backend/booking/booking_proofapprove.php", { method: "POST", body: data })
        .then(res => res.text())
        .then(function (code) {
            // 1 = SUCCESS
            // 0 = DATABASE ERROR
            if (code != 0) {
                alert("Your decision has been successfully sent to the traveler.");
                let inq = currentResponse.inq;
                requestData(inq['bookingID']);
            } else {
                alert("ERROR Code " + code + " - Action Failed! Please contact your Administrator.");
            }
        })
        .catch(err => console.error(err));
    return false;
}

function refresh() {
    var data = new FormData(document.getElementById("upForm"));

    fetch("backend/booking/booking_approve.php", {method: "POST", body: data})
        .then(res => res.text())
        .then((code) => {
            if(code == 1){
                alert("Payment Succeeded!.");
                let inq = currentResponse.inq;
                requestData(inq['bookingID']);
            }
            else if(code == 4){
                alert("ERROR Code " + code + " - Paymongo link is null.");
            }
            else {
                alert(code + " Payment still on process.");
                let inq = currentResponse.inq;
                requestData(inq['bookingID']);
            }
        })
        .catch(err => console.error(err));
    return false;
}
