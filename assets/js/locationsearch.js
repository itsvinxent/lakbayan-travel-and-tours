var searchTimeout;
var searchReq;

$("#package-location").on('keyup click', function () {
    var locquery = $(this).val();

    if (searchTimeout) {
        clearTimeout(searchTimeout);
    }
    if (searchReq) {
        searchReq.abort();
    }
    if (locquery != "") {
        $('.hints').css('display', 'none');
        $('.empty-hints').css('display', 'none');
        $('.loading-hints').css('display', 'flex');
    }

    searchTimeout = setTimeout(function () {
        if (locquery != "") {
            $('.loading-hints').css('display', 'none');
            getLocations(locquery).then(function (data) {
                if (data != "") {
                    console.log(data);
                    $('.hints').empty();
                    $('.hints').html(data);
                    $('.hints').css('display', 'flex');
                    $('.loading-hints').css('display', 'none');
                } else {
                    $('.empty-hints').css('display', 'flex');
                    $('.loading-hints').css('display', 'none');
                }
            });
        } else if (locquery == "") {
            $('.hints').empty();
            $('.hints').css('display', 'none');
            $('.empty-hints').css('display', 'none');
            $('.loading-hints').css('display', 'none');
        } else {
            $('.hints').empty();
            $('.hints').css('display', 'none');
            $('.empty-hints').css('display', 'flex');
            $('.loading-hints').css('display', 'none');
        }
    }, 500);

});

function getLocations(locquery) {
    $('.empty-hints').css('display', 'none');
    $('.hints').css('display', 'none');
    searchReq = $.ajax({
        url: 'backend/package/fetch_locations.php',
        method: 'POST',
        data: {
            locquery: locquery
        },
        async: true,
        context: this,
        complete: function () {
            $('.loading-hints').css('display', 'none');
        }

    });
    return searchReq;
}

$(document).click(function () {
    if ($("#package-location").is(':focus')) {
        if ($('#package-location').val() != "" & $('.hints').css('display') != "flex" & $('.empty-hints').css('display') != "flex") {
            $('.loading-hints').css('display', 'flex');
        }
    } else {
        $('.hints').empty();
        $('.hints').css('display', 'none');
        $('.empty-hints').css('display', 'none');
        $('.loading-hints').css('display', 'none');
    }
});