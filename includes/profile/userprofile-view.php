<?php 
    include 'backend\auth\getuser.php';

if(isset($_GET['id'])){
    $viewID = $_GET['id'];

    $display = view_otheruser($conn, $viewID);

    $now = new DateTime(date("Y-m-d"));
    $userbday = new DateTime($display['birthday']);

    $age =  date_diff($now, $userbday);

    $current_age =  $age->format("%y");

}else{
    $viewID = $_SESSION['id'];

    $display = view_otheruser($conn, $viewID);

    $now = new DateTime(date("Y-m-d"));
    $userbday = new DateTime($display['birthday']);

    $age =  date_diff($now, $userbday);

    $current_age =  $age->format("%y");
}
?>

<script>
    $(function() {
        $(document).scroll(function() {
        var $nav = $("._nav");

        $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
        });
    });
</script>

<section class="sections profile-user" id="packages">

    <div class="banner-half profile">
         <?php if (isset($display['userbanner'])) 
        {
        echo '<img id="img-banner" src="assets/img/users/traveler/'.$display['id'].'/banner/'.$display['userbanner'].'" alt="">';
        }
        else {
        echo '<img id="img-banner" src="assets/img/users/traveler/DefaultBanner.jpg" alt="">';
        }
        ?> 
    </div>

    <div class="profile-container">
        <div class="banner-logo profile">
            <div class="image">
            <?php if (isset($display['profpicture'])) 
                {
                echo '<img id="img-banner" src="assets/img/users/traveler/'.$display['id'].'/pfp/'.$display['profpicture'].'" alt="">';
                }
                else {
                echo '<img id="img-banner" src="assets/img/users/traveler/DefaultProf.jpg" alt="">';
                }
            ?> 
            </div>
            <div class="top">
                <span>
                    <h1 class="agency-name"><?php echo $display['fullname']?></h1>
                    <?php echo '<p>'.$display['email'].'</p>'?>
                </span>
                <span class="ico-container">

                </span>
            </div>

        </div>

        <div class="nav">
            <ul class="tabs">
                <li data-tab-target="#info" class="tab active">Traveler Information</li>
                <!-- <li data-tab-target="#package" class="tab">Bookings</li> -->
            </ul>
        </div>

        <div class="tab-content">
            <div id="info" data-tab-content class=" data-tab-content active">

                <h1>Account Information</h1>
                <div class="details">
                    <input type="hidden" name="id" id="user_id">
                    <div class="row top">
                        <span class="col-left">First Name</span>
                        <span class="col-right active" id="">
                            <?php echo '<p>'.$display['fname'].'</p>'?>
                        </span>
                    </div>

                    <div class="row">
                        <span class="col-left">Last Name</span>
                        <span class="col-right active" id="">
                            <?php echo '<p>'.$display['lname'].'</p>'?>
                        </span>
                    </div>

                    <div class="row">
                        <span class="col-left">Email</span>
                        <span class="col-right active" id="">
                            <?php echo '<p>'.$display['email'].'</p>'?>
                        </span>
                    </div>
                    
                </div>

                <h1>Personal Information</h1>
                <div class="details">
                    <div class="row">
                        <span class="col-left">Birthday</span>
                        <span class="col-right active" id="">
                            <?php echo '<p>'.$display['birthday'].'</p>'?>
                        </span>
                    </div>

                    <div class="row">
                        <span class="col-left">Age</span>
                        <span class="col-right active" id="">
                            <?php echo '<p>'.$current_age.'</p>'?>
                        </span>
                    </div>

                    <div class="row">
                        <span class="col-left">Gender</span>
                        <span class="col-right active" id="">
                        <?php echo '<p>'.$display['gender'].'</p>'?>
                        </span>
                    </div>

                    <div class="row">
                        <span class="col-left">Address</span>
                        <span class="col-right active" id="">
                            <?php echo '<p>'.$display['address'].'</p>'?>
                        </span>
                    </div>

                    <div class="row">
                        <span class="col-left">Telephone #</span>
                        <span class="col-right active" id="">
                            <?php echo '<p>'.$display['contactnumber'].'</p>'?>
                        </span>
                    </div>

                    <div class="row">
                        <span class="col-left">Race</span>
                        <span class="col-right active" id="">
                            <?php echo '<p>'.$display['race'].'</p>'?>
                        </span>
                    </div>

                    <div class="row">
                        <span class="col-left">Nationality</span>
                        <span class="col-right active" id="">
                            <?php echo '<p>'.$display['nationality'].'</p>'?>
                        </span>
                    </div>

                    <div class="row">
                        <span class="col-left">Religion</span>
                        <span class="col-right active" id="">
                            <?php echo '<p>'.$display['religion'].'</p>'?>
                        </span>
                    </div>

                </div>

                <h1>Travel Preferences</h1>
                <div class="details">
                    <div class="row top">
                        <span class="col-left">Beaches and Resorts</span>
                    </div>
                    <div class="row">
                        <span class="col-left">Historical and Cultural Landmarks</span>
                    </div>
                </div>

            </div>

            <!-- <div id="package" data-tab-content class="data-tab-content">
                <div class="card-container">
                    <div class="wrap user">
                        <div class="image">
                            <img src="assets/img/Lakawon1.jpg" alt="" />
                        </div>

                        <div class="cap">
                            <h2 class="title">Lakawon Island Day Tour</h2>
                            <p>Price: P7,500 per person</p>
                            <p>Booking Status: Checking Availability</p>
                            <p>Persons: 2</p>
                <p>Duration: 2 day(s)</p>
                <p>Booked Date: September 5, 2022</p>
                        </div>

                        <div class="func-btn">
                            <span class="cost">
                                <p class="amt">P15,000</p>
                                <p style="font-size: 12px;">TOTAL BILL</p>
                            </span>
                            <span class="check-order">
                                <a href="">Travel Order</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>


    </div>
</section>