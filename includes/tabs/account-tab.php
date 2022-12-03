<div id="info" data-tab-content class=" data-tab-content active">
    <form action="backend\auth\updateprof.php" method="POST" enctype="multipart/form-data" style="padding-bottom: 3rem;" id="myaccountform">

        <div class="profile-banner">
            <?php

            echo '<img id="img-banner" src="assets/img/users/travelagent/' . $_SESSION['setID'] . '/banner/' . $_SESSION['setBanner'] . '" alt="">';
            ?>
            <input type="file" name="profBanner" id="aBanner" accept="image/gif, image/jpeg, image/png" style="display: none;">
            <label for="aBanner">
                <div class="banner-hover">
                    <div class="text" for="aBanner">
                        <i class="fas fa-pen"></i>Edit
                    </div>
                </div>
            </label>
        </div>

        <div class="banner-logo">
            <div class="image" style="left: 13%">
                <?php
                echo '<img id="img-pic" src="assets/img/users/travelagent/' . $_SESSION['setID'] . '/pfp/' . $_SESSION['setPfPicture'] . '" alt="">';
                ?>
                <input class="middle" type="file" name="profPicture" id="aPicture" accept="image/gif, image/jpeg, image/png" style="display: none;">
                <label for="aPicture">
                    <div class="middle">
                        <div class="text">
                            <i class="fas fa-pen"></i>Edit
                        </div>
                    </div>
                </label>
            </div>

            <?php
            // '<div class="desc">
            // <p class="desc-body active" id="desc-body">'.$disDesc.'</p>
            // <input type="hidden" value="'.$disDesc.'">
            echo
            '<h1 style="font-size: 1.5em; margin-top: 0;">Agency Description</h1>
              <div class="desc">
                <p class="desc-body active" id="desc-body">' . $_SESSION['setDesc'] . '</p>
                <textarea class="desc-textarea" name="profDesc" id="desc-textarea"></textarea>
                <input type="hidden" value="' . $_SESSION['setDesc'] . '"/>
                <div class="desc-btn">
                  <div class="edit-desc active" id="edit-desc-btn"><i class="fas fa-pen"></i></div>
                  <div class="save-desc" id="save-desc-btn"><i class="fas fa-save"></i></div>
                </div>
              </div>'
            ?>

        </div>

        <h1>Agency Details</h1>
        <div class="details">

            <div class="row top">
                <span class="col-left">Name</span>

                <?php
                // echo '<span class="col-right active" id=""><p>'.$_SESSION['setName'].'</p></span>';
                ?>
                <span class="col-right active" id="">
                    <p><?php echo $_SESSION['setName'] ?></p>
                </span>
                <span class="col-right-edit">
                    <input type="text" name="profName" id="" value="">
                    <input type="hidden" value="<?php echo $_SESSION['setName'] ?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                    <div class="bg">
                        <i class="fas fa-save"></i>
                    </div>
                </span>
            </div>

            <div class="row">
                <span class="col-left">Address</span>

                <?php
                // echo '<span class="col-right active" name="profAdd"><p>'.$disAdd.'</p></span>';
                ?>
                <span class="col-right active" id="">
                    <p><?php echo $_SESSION['setAdd'] ?></p>
                </span>
                <span class="col-right-edit">
                    <input type="text" name="profAdd" id="" value="">
                    <input type="hidden" value="<?php echo $_SESSION['setAdd'] ?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                    <div class="bg">
                        <i class="fas fa-save"></i>
                    </div>
                </span>
            </div>

            <div class="row">
                <span class="col-left">Email</span>

                <?php
                // echo '<span class="col-right active"><p>'.$disEmail.'</p></span>';
                ?>
                <span class="col-right active" id="">
                    <p><?php echo $_SESSION['setEmail'] ?></p>
                </span>
                <span class="col-right-edit">
                    <input type="email" name="profEmail" id="" value="">
                    <input type="hidden" value="<?php echo $_SESSION['setEmail'] ?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                    <div class="bg">
                        <i class="fas fa-save"></i>
                    </div>
                </span>
            </div>

            <div class="row bot">
                <span class="col-left">Telephone #</span>

                <?php
                // echo '<span class="col-right active"><p>'.$disTelNum.'</p></span>'
                ?>
                <span class="col-right active" id="">
                    <p><?php echo $_SESSION['setTelNumber'] ?></p>
                </span>
                <span class="col-right-edit">
                    <input type="text" name="profTel" id="" value="" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    <input type="hidden" value="<?php echo $_SESSION['setTelNumber'] ?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                    <div class="bg">
                        <i class="fas fa-save"></i>
                    </div>
                </span>
            </div>
        </div>

        <h1>Social Media Accounts</h1>
        <div class="details">
            <div class="row top">
                <span class="col-left">Facebook</span>
                <span class="col-right active">www.facebook.com/<p><?php echo $_SESSION['setfblink'] ?></p></span>
                <span class="col-right-edit">
                    <input type="text" name="infblink" id="" value="">
                    <input type="hidden" value="<?php echo $_SESSION['setfblink'] ?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                    <div class="bg">
                        <i class="fas fa-save"></i>
                    </div>
                </span>
            </div>
            <div class="row">
                <span class="col-left">Twitter</span>
                <span class="col-right active">www.twitter.com/<p><?php echo $_SESSION['settwlink'] ?></p></span>
                <span class="col-right-edit">
                    <input type="text" name="intwlink" id="" value="">
                    <input type="hidden" value="<?php echo $_SESSION['settwlink'] ?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                    <div class="bg">
                        <i class="fas fa-save"></i>
                    </div>
                </span>
            </div>
            <div class="row">
                <span class="col-left">Instagram</span>
                <span class="col-right active">www.instagram.com/<p><?php echo $_SESSION['setiglink'] ?></p></span>
                <span class="col-right-edit">
                    <input type="text" name="iniglink" id="" value="">
                    <input type="hidden" value="<?php echo $_SESSION['setiglink'] ?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                    <div class="bg">
                        <i class="fas fa-save"></i>
                    </div>
                </span>
            </div>
            <div class="row bot">
                <span class="col-left">Youtube</span>
                <span class="col-right active">www.youtube.com/<p>lakbayantours</p></span>
                <span class="col-right-edit">
                    <input type="text" name="" id="" value="">
                    <input type="hidden" value="<?php echo "lakbayantours" ?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                    <div class="bg">
                        <i class="fas fa-save"></i>
                    </div>
                </span>
            </div>
        </div>

        <h1>Manager Information</h1>
        <div class="details">
            <div class="row top">
                <span class="col-left">Name</span>

                <?php
                // echo '<span class="col-right active">'.$disMName.'</span>';
                ?>
                <span class="col-right active" id="">
                    <p><?php echo $_SESSION['setMName'] ?></p>
                </span>
                <span class="col-right-edit">
                    <input type="text" name="" id="" value="">
                    <input type="hidden" value="<?php echo $_SESSION['setMName'] ?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                    <div class="bg">
                        <i class="fas fa-save"></i>
                    </div>
                </span>
            </div>
            <div class="row">
                <span class="col-left">Contact #</span>
                <?php

                // echo '<span class="col-right active">'.$disMContact.'</span>';

                ?>
                <span class="col-right active" id="">
                    <p><?php echo $_SESSION['setMContact'] ?></p>
                </span>
                <span class="col-right-edit">
                    <input type="text" name="" id="" value="">
                    <input type="hidden" value="<?php echo $_SESSION['setMContact'] ?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                    <div class="bg">
                        <i class="fas fa-save"></i>
                    </div>
                </span>
            </div>
            <div class="row bot">
                <span class="col-left">Email</span>

                <?php
                // echo '<span class="col-right active">'.$disEmail.'</span>';
                ?>
                <span class="col-right active" id="">
                    <p><?php echo $_SESSION['setMEmail'] ?></p>
                </span>
                <span class="col-right-edit">
                    <input type="text" name="" id="" value="">
                    <input type="hidden" value="<?php echo $_SESSION['setMEmail'] ?>">
                </span>
                <span class="col-edit active"><i class="fas fa-pen"></i></span>
                <span class="col-save">
                    <div class="bg">
                        <i class="fas fa-save"></i>
                    </div>
                </span>
            </div>
        </div>

    </form>
</div>