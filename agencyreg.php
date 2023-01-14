<?php
session_start();
$_SESSION['active'] = 'register';
if(isset($_SESSION['isLoggedIn']) == false) {
  $_SESSION['isLoggedIn'] = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Agency Registration</title>

    <link rel="stylesheet" href="assets/css/modal.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/agencyreg.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@6/dist/css/smart_wizard_all.min.css" rel="stylesheet" type="text/css" />

    <link rel="icon" href="assets/img/logo.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>

<?php 
    include __DIR__.'/includes/components/nav.php';
    include __DIR__.'/includes/components/accountModal.php';
?>
<!-- FORM FIELD -->

<video autoplay muted loop id="bg-vid">
  <source src="assets\media\Sunset.mp4" type="video/mp4" >
</video>

 <div class="wrapper">
            <form action="backend\auth\signupagency.php" id="wizard" method="POST" enctype="multipart/form-data">
        		<!-- SECTION 1 -->
                <h2></h2>
                <section>
                    <div class="inner">
                      <div class="image-holder">
                        <img src="assets\img\AgencyReg1.jfif" alt="">
                      </div>
                      <div class="form-content" >
                  
                        <div class="form-header">
                          <h3>AGENCY INFORMATION</h3>
                          <h4>1 of 3</h4>
                          <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                          </div>
                        </div>
                        <p>Please fill with your agency details</p>
                        <div class="form-row">
                          <div class="form-holder w-100">
                            <input type="text" name="aName" id="aName" placeholder="Agency Name" class="form-control" >
                          </div>
                          <!-- <div class="form-holder">
                            <input type="text" placeholder="Last Name" class="form-control">
                          </div> -->
                        </div>
                        <div class="form-row">
                          <div class="form-holder">
                            <input type="email" name="aEmail" id="aEmail" placeholder="Agency Email" class="form-control" >
                          </div>
                          <div class="form-holder"> 
                            <input type="text" name="aNumber" id="aNumber" placeholder="Phone Number" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="11" >
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-holder w-100">
                            <input type="text" name="aAddress" id="aAddress" placeholder="Agency Address" class="form-control" >
                          </div>
                          <!-- <div class="form-holder" style="align-self: flex-end; transform: translateY(4px);">
                            <div class="checkbox-tick">
                              <label class="male">
                                <input type="radio" name="gender" value="male" checked> Male<br>
                                <span class="checkmark"></span>
                              </label>
                              <label class="female">
                                <input type="radio" name="gender" value="female"> Female<br>
                                <span class="checkmark"></span>
                              </label>
                            </div> 
                          </div>-->
                        </div>
                          <!-- <div class="form-row">
                            <div class="form-holder w-65">
                              <textarea name="" id="" placeholder="Agency Description" class="form-control" style="height: 99px;"></textarea>
                            </div>
                          </div> -->
                        <!-- <div class="checkbox-circle">
                          <label>
                            <input type="checkbox" checked> Nor again is there anyone who loves or pursues or desires to obtaini.
                            <span class="checkmark"></span>
                          </label>
                        </div> -->
                      </div>
                    </div>
                </section>

				<!-- SECTION 2 -->
                <h2></h2>
                <section>
                    <div class="inner">
                      <div class="image-holder">
                        <img src="assets\img\AgencyReg2.jfif" alt="">
                      </div>
                      <div class="form-content">
                        <div class="form-header">
                          <h3>MANAGER INFORMATION</h3>
                          <h4>2 of 3</h4>
                        </div>
                        <p>Please fill with additional info</p>
                        <div class="form-row">
                          <div class="form-holder">
                            <input type="text" name="aMFName" id="aMFName" placeholder="First Name" class="form-control">
                          </div>

                          <div class="form-holder">
                            <input type="text" name="aMLName" id="aMLName" placeholder="Last Name" class="form-control">
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-holder w-100">
                            <input type="text" name="aPassword" id="aPassword" placeholder="Password" class="form-control">
                          </div>
                        </div>

                        <div class="form-row">
                          <!-- <div class="select">
                            <div class="form-holder">
                              <div class="select-control">Your country</div>
                              <i class="zmdi zmdi-caret-down"></i>
                            </div>
                            <ul class="dropdown">
                              <li rel="United States">United States</li>
                              <li rel="United Kingdom">United Kingdom</li>
                              <li rel="Viet Nam">Viet Nam</li>
                            </ul>
                          </div> -->
                          <div class="form-holder"></div>
                        </div>
                      </div>
                    </div>
                </section>

                <!-- SECTION 3 -->
                <h2></h2>
                <section>
                    <div class="inner">
                      <div class="image-holder">
                        <img src="assets\img\AgencyReg3.jfif" alt="">
                      </div>
                      <div class="form-content">
                        <div class="form-header">
                          <h3>VERIFICATION</h3>
                          <h4>3 of 3</h4>
                        </div>
                        <p>Verify your Travel Agency</p>
                        <div class="form-row">
                        <div id="accred" class="form-holder w-100" style="position: relative; display: flex; flex-wrap: nowrap;">
                            <input style="width: 50%; min-width: unset;" type="text" name="aDot" id="aDot" placeholder="Enter DOT Accreditation #" class="form-control"> 
                            <select name="region" id="region" style="margin-left: 15px; width: 40%; min-width: unset; color: #666;">
                              <option disabled selected hidden style="opacity: .5;">Select Region</option>
                              <option value="NCR">NCR</option>
                              <option value="CAR">CAR</option>
                              <option value="REGI">Region I</option>
                              <option value="REGII">Region II</option>
                              <option value="REGIII">Region III</option>
                              <option value="REGIVA">Region IV-A</option>
                              <option value="REGIVB">Region IV-B</option>
                              <option value="REGV">Region V</option>
                              <option value="REGVI">Region VI</option>
                              <option value="REGVII">Region VII</option>
                              <option value="REGVIII">Region VIII</option>
                              <option value="REGIX">Region IX</option>
                              <option value="REGX">Region X</option>
                              <option value="REGXI">Region XI</option>
                              <option value="REGXII">Region XII</option>
                              <option value="REGXIII">Region XIII</option>
                            </select>
                          </div>
                          <input type="hidden" name="is_found">
                          <input type="hidden" name="accreditationNum">
                        </div>
                        <p>Upload your Accredition Certificate <i></i></p>
                        <div class="form-row">
                        <div class="form-holder w-100">
                            <input type="file" name="aVerify" id="aVerify" placeholder="Upload your Accredition Certificate" class="form-control">
                          </div>
                        </div>
                        <div class="checkbox-circle mt-24">
                          <label>
                            <input type="checkbox" name="aTerms" id="aTerms" checked>  Please accept <a href="#">terms and conditions</a>
                            <span class="checkmark"></span>
                          </label>
                        </div>
                      </div>
                    </div>
                </section>
            </form>
	</div>


<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>

<script>
  // $(function(){
  //   $("#wizard").validate({
  //   rules: {
  //     aName: "required",
  //     aEmail: {
  //       required: true,
  //       email: true
  //     },
  //     aNumber: {
  //       phoneUS:true,
  //       range: [1, 11]
  //     },
  //     agree: 'required',
  //     aAddress: "required",
  //     aNumber: "required",
  //     aMFName: "required",
  //     aMLName: "required",
  //     aPassword: "required"


  //   }
  // })
  // })
  
  $(function(){

    $('ul[role="tablist"]').hide();

    var form = $("#wizard").show();
    var tinybutt = $('.wizard > .steps li a');
    var count = 0;
    var dataresult;

    form.steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slide",
        enableAllSteps: true,
        transitionEffectSpeed: 275,
        errorClass: "error",
        loadingTemplate: '<span class="spinner"></span> #text#',
        autoFocus: true,
        labels: {
            finish: "Submit",
            next: "Next",
            previous: "Back"
        },
        onStepChanging: function(event, currentIndex, newIndex)
        {

          form.validate().settings.ignore = ":disabled,:hidden";

          console.log(count);
          if (($('#aName').val() === null || $('#aEmail').val() === null || $('#aAddress').val() === null || $('#aNumber').val() === null ) && currentIndex == 0 ) {
            count++;
            return false;}

          if (($('#aMFName').val() === null || $('#aMLName').val() === null || $('#aPassword').val() === null) && currentIndex == 1 ) {
          return false;}

          if(currentIndex > newIndex) return true;

          return form.valid();
        },
        onStepChanged: function(event, currentIndex, priorIndex){
          //if(currentIndex === 2 && priorIndex === 3) form.steps("previous");
          console.log("CI => " + currentIndex);
          console.log("PI => " + priorIndex);
        },
        onFinishing: function(event, currentIndex){
          if($('#aDot').val() === null || $('#aVerify').val() === null || $('#aTerms').val() === null){
            return false;
          }
          if ($('#aName').val().toUpperCase().trim() != dataresult) {
            alert("Your inputted Agency Name should be the same as the registered Agency Name of the given accreditation number.");
            return false;
          }

          return form.valid();
        },
        onFinished: function (event, currentIndex){
          form.submit();
        }

    }).validate({
    rules: {
      aName: "required",
      aEmail: {
        required: true,
        email: true
      },
      aNumber: {
        phoneUS:true,
        range: [1, 11]
      },
      agree: 'required',
      aAddress: "required",
      aNumber: "required",
      aMFName: "required",
      aMLName: "required",
      aPassword: "required",
      aDot: "required",
      aVerify: {
        required: true
      },
      aTerms: "required"
    },
    messages: {
      aTerms: "Please accept the terms and service",
      aVerify: "Please select a file",
      aDot: "Please enter your DOT number"
    }
    });
    $('.wizard > .steps li a').click(function(){
    	$(this).parent().addClass('checked');
      $(this).parent().prevAll().addClass('checked');
      $(this).parent().nextAll().removeClass('checked');
    });
    // Custome Jquery Step Button
    // $('.forward').click(function(){
    //   if($('#aName').val() === null){
    //     return false;
    //   }else
    // 	$("#wizard").steps('next');
    // })
    // $('.backward').click(function(){
    //     $("#wizard").steps('previous');
    // })

    // Select Dropdown
    $('html').click(function() {
        $('.select .dropdown').hide(); 
    });
    $('.select').click(function(event){
        event.stopPropagation();
    });
    $('.select .select-control').click(function(){
        $(this).parent().next().toggle();
    })    
    $('.select .dropdown li').click(function(){
        $(this).parent().toggle();
        var text = $(this).attr('rel');
        $(this).parent().prev().find('div').text(text);
    })

    function validateForm(form) {
      var isValid = true;
      $('.form-holder').each(function() {
        if ( $(this).val() === '' )
            isValid = false;
      });
      return isValid;
    }


    var filter_timeout, filter_req;
    
    function checkAccredication() {
      if ($('#aDot').val().length >= 20 && $('#region').val() != null) {
        $.ajax({
          url: 'backend/verify/agency_verification.php',
          method: 'POST',
          data: {
            region: $('#region').val(),
            accredNum: $('#aDot').val()
          },
          async: true,
          context: this,
          beforeSend: function() {
            let imghtml = `<img id="resultMark" style="height: 30px; position: absolute; top: 50%; right: -5%; transform: translate(-50%, -50%);" src="assets/img/icons8-loading-bar.gif"/>`;
            $('#resultMark').remove();
            $('#accred').append(imghtml);
          },
          success: function(data) {
            if (data != "NOT FOUND") {
              $('#resultMark').attr("src", "https://img.icons8.com/fluency/30/null/checkmark.png");
              if (data.trim() != $('#aName').val().toUpperCase().trim()) {
                alert('Please set the same Agency Name used in the DOT Accreditation.')
              }
              dataresult = data.trim();
              $('input[name="is_found"]').val(1);
            } else {
              $('#resultMark').attr("src", "https://img.icons8.com/fluency/30/null/delete-sign.png");
              $('input[name="is_found"]').val(0);
            }
          }
        });

      }
    }

    $('#wizard').on('input', 'input[name="aDot"]', function() {
      if (filter_timeout) {
        clearTimeout(filter_timeout);
      }
      if (filter_req) {
        filter_req.abort();
      }

      filter_timeout = setTimeout(function () {
        checkAccredication();
      }, 500);

    });

    $('#wizard').on('change', 'select[name="region"]', function() {
      if (filter_timeout) {
        clearTimeout(filter_timeout);
      }
      if (filter_req) {
        filter_req.abort();
      }

      filter_timeout = setTimeout(function () {
        checkAccredication();
      }, 500);

    });
})


</script>

<script>
var prevImage = function(event) {
  var pcontainer = document.getElementById('prev-container');
  
  if(document.getElementById('aPicture').files.length != 0){
  pcontainer.style.display='block';
  window.setTimeout(function(){
    pcontainer.style.opacity = 1;
    pcontainer.style.transform = 'translateY(0)';
  }, 100);
  } 
  
  if (document.getElementById('aPicture').files.length === 0){
    pcontainer.style.opacity = 0;
    pcontainer.style.transform = 'translateY(-50px)';

    window.setTimeout(function(){
    pcontainer.style.display='none';
   
    }, 400);
  }else {
    var showselected = document.getElementById('prev');
    showselected.src = URL.createObjectURL(event.target.files[0]);
  }
  
};

// function nextform(){
//   var travelpart = document.getElementById("agencyform");
//   var managerpart = document.getElementById("managerform")
//   travelpart.style.display = "none";
// }

// const showmanager = document.querySelector('.form-manager-part');

// document.querySelector(".shownext").addEventListener("click", 
// () => {
//   showmanager.removeAttribute('hidden');
//   showmanager.classList.toggle("is-active");
// })

// // function showman(){
// //   showmanager.removeAttribute('hidden');

// //   const reflow = element.offsetHeight;
  
// //   showmanager.classList.add('is-active');
// // }


</script>

<!-- Footer section -->

<footer class="site-footer">
    <div class="container">
      <div class="logo">
        <img src="assets/img/logo.png" alt="" />
      </div>
      <div class="abt">
        <h1>About</h1>
        <p>Lakbayan Travel and Tours will provide a convenient and
          premium travel and tour service for local destinations in the
          Philippines. Lakbayan Travel and Tours offers tourists destinations
          that they would love and relax in. We also provide essential
          information to clients so that they are familiar with the culture of
          their chosen places.</p>
      </div>
      <div class="quick-links">
        <h1>Quick Links</h1>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="destinations.php">Destinations</a></li>
          <li><a href="packages.php">Packages</a></li>
          <li><a href="about.php">About</a></li>
        </ul>
      </div>
      <div class="soc-med">
        <h1>Contact Us</h1>
        <div class="contact">
          <div class="info">
            <span><i class="fas fa-phone-alt"></i></span>
            <p>0961 285 3038</p>
          </div>
          <div class="info">
            <span><i class="fas fa-map-marker-alt"></i></span>
            <p>Manila, Philippines</p>
          </div>
        </div>

        <div class="icons">
          <a href="facebook.com"><i class="fab fa-facebook-f"></i></a>
          <a href="twitter.com"><i class="fab fa-twitter"></i></a>
          <a href="instagram.com"><i class="fab fa-instagram"></i></a>
          <a href="youtube.com"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
</footer>



  <script>
    $(function() {
      $(document).scroll(function() {
        var $nav = $("._nav");

        $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
      });
    });
  </script>

</body>
</html>