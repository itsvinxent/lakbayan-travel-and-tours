var count = 4;
var filter_req, filter_timeout;
var pack_transact, pack_id, pack_customer;
var bookingpostdata = {
  booking: true,
  logged_user: "",
  b_name: "",
  customer_name: "",
  trn: "",
  package_id: undefined,
  status: "s-all"
}
var pack_name, pack_location, pack_cat, pack_duration = 0;
var postdata = {
  is_filtering: true,
  logged_user: "",
  name: "",
  location: "",
  category: "",
  duration: undefined,
  availability: "a-all"
}


function filterTimeout($postdata, $tableid) {
    if (filter_timeout) {
      clearTimeout(filter_timeout);
    }
    if (filter_req) {
      filter_req.abort();
    }

    filter_timeout = setTimeout(function() {
      filterPackages($postdata).then(function(data) {
        $($tableid).empty();
        $($tableid).html(data);
      });
    }, 500);          
  }

  function filterPackages($postdata) {
    filter_req = $.ajax({
      url: 'backend/package/packages_search.php',
      method: 'POST',
      data: $postdata,
      async: true,
      context: this
    });

    return filter_req;
  }

  function postdata_append(postdata, name, value) {
    if ((value != undefined) & (value != '') & (value != null)) {
      postdata[name] = value;
    } else {
      delete postdata[name];
      count--;
    }
    return postdata
  }

  function package_data_input() {
    postdata = postdata_append(postdata, 'name', pack_name)
    postdata = postdata_append(postdata, 'location', pack_location)
    postdata = postdata_append(postdata, 'category', pack_cat)
    postdata = postdata_append(postdata, 'duration', pack_duration)
  }

  function booking_data_input() {
    bookingpostdata = postdata_append(bookingpostdata, 'b_name', pack_name)
    bookingpostdata = postdata_append(bookingpostdata, 'customer_name', pack_customer)
    bookingpostdata = postdata_append(bookingpostdata, 'trn', pack_transact)
    bookingpostdata = postdata_append(bookingpostdata, 'package_id', pack_id)
  }

  // Availablity Filter
  function filterTable($inputclass, $type, $post) {
    $($inputclass).change(function() {
      var checkbox = this;
      if ($(this).is(":checked"))
        this.labels[0].classList.remove('active');

      $($inputclass).each(function() {
        if (this == checkbox & $(checkbox).is(":checked")) {
          this.labels[0].classList.add('active');
        } else {
          $(this).prop('checked', false);
          this.labels[0].classList.remove('active');
        }
      });
      $post = postdata_append($post, $type, $(checkbox).val())
      if ($type == 'availability') {
        package_data_input();
        filterTimeout($post, '#full-table');
      } else {
        booking_data_input();
        filterTimeout($post, '#fullb-table');
      }
    });
  }