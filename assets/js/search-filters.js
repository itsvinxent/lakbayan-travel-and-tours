var count = 4;
var filter_req, filter_timeout;
var pack_transact, pack_id, pack_customer;
var bookingpostdata = {
  booking: true,
  logged_user: "",
  b_name: "",
  customer_name: "",
  trn: "",
  package_id: 0,
  status: "s-all"
}
var pack_name, pack_location, pack_cat, pack_duration = 0;
var postdata = {
  is_filtering: true,
  logged_user: "",
  name: "",
  location: "",
  category: "",
  duration: 0,
  availability: "a-all"
}
var ver_agencyname, ver_dotnum, ver_agencyid = 0, ver_mgname;
var verpostdata = {
  verify: true,
  agency_name: "",
  dot_num: "",
  agency_id: 0,
  manager_name: "",
  verstatus: "v-all"
}

var usr_name, usr_email, usr_id;
var usrpostdata = {
  is_user: true,
  user_name: "",
  email: "",
  user_id: 0
}

function filterTimeout($postdata, $tableid) {
  if (filter_timeout) {
    clearTimeout(filter_timeout);
  }
  if (filter_req) {
    filter_req.abort();
  }

  filter_timeout = setTimeout(function () {
    filterPackages($postdata, $tableid).then(function (data) {
      $($tableid).empty();
      $($tableid).html(data);
    });
  }, 500);
}

function filterPackages($postdata, $tableid) {
  var url;
  if ($tableid == '#full-table' || $tableid == '#fullb-table') {
    url = 'backend/package/packages_search.php';
  } else if ($tableid == '#full-vtable') {
    url = 'backend/admin/agency_search.php';
  } else {
    url = 'backend/admin/user_search.php';
  }

  filter_req = $.ajax({
    url: url,
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
    // delete postdata[name];
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

function verify_data_input() {
  verpostdata = postdata_append(verpostdata, 'agency_name', ver_agencyname)
  verpostdata = postdata_append(verpostdata, 'dot_num', ver_dotnum)
  verpostdata = postdata_append(verpostdata, 'agency_id', ver_agencyid)
  verpostdata = postdata_append(verpostdata, 'manager_name', ver_mgname)
}

function user_data_input() {
  usrpostdata = postdata_append(usrpostdata, 'user_name', usr_name)
  usrpostdata = postdata_append(usrpostdata, 'email', usr_email)
  usrpostdata = postdata_append(usrpostdata, 'user_id', usr_id)
}

// Availablity Filter
function filterTable($inputclass, $type, $post) {
  $($inputclass).change(function () {
    var checkbox = this;
    if ($(this).is(":checked"))
      this.labels[0].classList.remove('active');

    $($inputclass).each(function () {
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
    } else if ($type == 'verstatus') {
      verify_data_input();
      filterTimeout($post, '#full-vtable');
    } else if ($type == 'usertype') {
      user_data_input();
      filterTimeout($post, '#full-utable');
    } else {
      booking_data_input();
      filterTimeout($post, '#fullb-table');
    }
  });
}