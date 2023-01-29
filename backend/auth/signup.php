<?php
    include __DIR__.'/../connect/dbCon.php';
    include __DIR__.'/../auth/dboperation.php';

    if(mysqli_connect_error()) {
        echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Failed connecting to databasee");
            window.location.replace("../../index.php");
            </script>
        END;
    } else {
        // Check if the email is existing
        $sendto = mysqli_real_escape_string($conn, $_POST['email']);
        $isExisting = "SELECT id, email, is_verified FROM user_tbl WHERE email='$sendto'";
        $result = mysqli_fetch_row(mysqli_query($conn,$isExisting));

        
        // If it already exists
        if (isset($result[0]) and $result[0] != 0 and $result[2] == '1') {
            echo<<<END
                <script type ="text/JavaScript">  
                alert("An account with this email already exists. Use another email.");
                window.location.replace("../../index.php");
                </script>
            END;
        } else {
            
            $fname =  mysqli_real_escape_string($conn, $_POST['fname']);
            $lname =  mysqli_real_escape_string($conn, $_POST['lname']);
            $date = new DateTime();
            $date_now = $date->format('y-m-d m:s');

            $verification = md5(rand(0, 1000));
           

            $hash = password_hash(mysqli_real_escape_string($conn, $_POST['password']), PASSWORD_BCRYPT);
            $query = "INSERT INTO  user_tbl (`fname`, `lname`, `email`, `password`, `verification_code`) 
            VALUES('$fname', '$lname', '$sendto', '$hash', '$verification')";

            if (isset($result[0]) and $result[0] != 0 and $result[2] == '0') {
                $query = "UPDATE  user_tbl SET `fname`='$_POST[fname]', `lname`='$_POST[lname]',
                `email`='$_POST[email]', `password`='$hash', `verification_code`='$verification' WHERE `id`='$result[0]'";
                $hasSent = true;
            }
            

            if(mysqli_query($conn,$query)){
                // INSERT USER PREFERENCES
                $preferencesGot = array();
                $userPref = $_POST['trav-preferences'];
                if(strstr($userPref, ',')) $preferencesGot = explode(",", $userPref);
                else array_push($preferencesGot, $userPref);

                // SET USER ID
                $userID = mysqli_insert_id($conn);
                if ($hasSent) {
                    $userID = $result[0];
            
                    // GET CURRENT PREFERENCES FROM DATABASE
                    $currPref = "SELECT GROUP_CONCAT(userPreferences) FROM traveldb.userpreference_tbl where userID ='$userID'";
                    $result = mysqli_fetch_row(mysqli_query($conn,$currPref));

                    // STORE CURRENT PREFERENCES TO AN ARRAY
                    $removedPreferencesGot = array();
                    $currPref = $result[0];
                    if(strstr($currPref, ',')) $removedPreferencesGot = explode(",", $currPref);
                    else array_push($removedPreferencesGot, $currPref);

                    // DELETE CURRENT PREFERENCES FROM THE DATABASE
                    for($i = 0; $i < count(array_filter($removedPreferencesGot)) ; $i++){
                        $data = array(
                            'userPreferences' => $removedPreferencesGot[$i]
                        );
                        multi_deletedb($conn, $data, "userpreference_tbl", "userID", $userID);
                    }

                }

                for($i=0; $i<count($preferencesGot); $i++){
                    $data = array(
                        'userID' => $userID,
                        'userPreferences' => $preferencesGot[$i]
                    );

                    multi_insertdb($conn, $data, "userpreference_tbl");
                }
                
                // CREATE A NEW DIRECTORY FOR THE USER
                $placehere = '../../assets/img/users/traveler/'.$userID.'/';
                //checks if dir exist and makes one if it does not
                if(!file_exists($placehere)){
                    mkdir($placehere, 0777, true);
                }

                require __DIR__.'/../package/vendor/autoload.php';
                // require "Mail/phpmailer/PHPMailerAutoload.php";
                
                $dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/../");
                $dotenv->load();

                $mail_address = $_ENV['MAIL_ADDRESS'];
                $mail_pass = $_ENV['MAIL_PASS'];
                
                $mail = new PHPMailer\PHPMailer\PHPMailer;
                $mail->isSMTP();
                $mail->Host='mail.lakbaysabayan.com';
                $mail->Port=465;
                $mail->SMTPAuth=true;
                $mail->SMTPSecure='ssl';
    
                $mail->Username=$mail_address;
                $mail->Password=$mail_pass;
    
                $mail->setFrom('no-reply@lakbaysabayan.com', 'OTP Verification');

                $mail->addAddress($sendto);

             

                
                $mail->isHTML(true);
                $mail->Subject="LAKBAYAN VERIFICATION";
                // BODY
                $mail->Body='
                
                <head>
                <!--[if gte mso 9]>
                <xml>
                <o:OfficeDocumentSettings>
                    <o:AllowPNG/>
                    <o:PixelsPerInch>96</o:PixelsPerInch>
                </o:OfficeDocumentSettings>
                </xml>
                <![endif]-->
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="x-apple-disable-message-reformatting">
                <!--[if !mso]><!--><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]-->
                <title></title>
                
                    <style type="text/css">
                    @media only screen and (min-width: 620px) {
                .u-row {
                    width: 600px !important;
                }
                .u-row .u-col {
                    vertical-align: top;
                }

                .u-row .u-col-100 {
                    width: 600px !important;
                }

                }

                @media (max-width: 620px) {
                .u-row-container {
                    max-width: 100% !important;
                    padding-left: 0px !important;
                    padding-right: 0px !important;
                }
                .u-row .u-col {
                    min-width: 320px !important;
                    max-width: 100% !important;
                    display: block !important;
                }
                .u-row {
                    width: 100% !important;
                }
                .u-col {
                    width: 100% !important;
                }
                .u-col > div {
                    margin: 0 auto;
                }
                }
                body {
                margin: 0;
                padding: 0;
                }

                table,
                tr,
                td {
                vertical-align: top;
                border-collapse: collapse;
                }

                p {
                margin: 0;
                }

                .ie-container table,
                .mso-container table {
                table-layout: fixed;
                }

                * {
                line-height: inherit;
                }

                a[x-apple-data-detectors=\'true\'] {
                color: inherit !important;
                text-decoration: none !important;
                }

                table, td { color: #000000; } #u_body a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_image_1 .v-src-width { width: auto !important; } #u_content_image_1 .v-src-max-width { max-width: 40% !important; } #u_content_heading_1 .v-font-size { font-size: 38px !important; } #u_content_image_3 .v-src-width { width: 100% !important; } #u_content_image_3 .v-src-max-width { max-width: 100% !important; } #u_content_text_5 .v-container-padding-padding { padding: 10px 30px 11px 10px !important; } }
                    </style>
                
                

                <!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet" type="text/css"><!--<![endif]-->

                </head>

                <body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #536068;color: #000000">
                <!--[if IE]><div class="ie-container"><![endif]-->
                <!--[if mso]><div class="mso-container"><![endif]-->
                <table id="u_body" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #536068;width:100%" cellpadding="0" cellspacing="0">
                <tbody>
                <tr style="vertical-align: top">
                    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #536068;"><![endif]-->
                    

                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f1f2f6;">
                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #f1f2f6;"><![endif]-->
                    
                <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                <div style="height: 100%;width: 100% !important;">
                <!--[if (!mso)&(!IE)]><!--><div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
                
                <table id="u_content_image_1" style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                    <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 30px;font-family:\'Montserrat\',sans-serif;" align="left">
                        
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="padding-right: 0px;padding-left: 0px;" align="center">
                    
                    <img align="center" border="0" src="cid:image-3.png" alt="Logo" title="Logo" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 18%;max-width: 104.4px;" width="104.4" class="v-src-width v-src-max-width"/>
                    
                    </td>
                </tr>
                </table>

                    </td>
                    </tr>
                </tbody>
                </table>

                <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                </div>
                </div>
                <!--[if (mso)|(IE)]></td><![endif]-->
                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
                </div>



                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #fbfcff;">
                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #fbfcff;"><![endif]-->
                    
                <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                <div style="height: 80%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                <!--[if (!mso)&(!IE)]><!--><div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
                
                <table id="u_content_heading_1" style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                    <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px 30px;font-family:\'Montserrat\',sans-serif;" align="left">
                        
                <h1 class="v-font-size" style="margin: 0px; color: #34495e; line-height: 100%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: \'Montserrat\',sans-serif; font-size: 35px;"><strong>Verify Your Email Account</strong></h1>

                    </td>
                    </tr>
                </tbody>
                </table>

                <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                </div>
                </div>
                <!--[if (mso)|(IE)]></td><![endif]-->
                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
                </div>



                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                    
                <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                <!--[if (!mso)&(!IE)]><!--><div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
                
                <table id="u_content_text_5" style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                    <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 30px 20px 30px;font-family:\'Montserrat\',sans-serif;" align="left">
                        
                <div style="color: #4b4a4a; line-height: 190%; text-align: left; word-wrap: break-word;">
                    <p style="font-size: 14px; line-height: 190%;"><span style="font-size: 18px; line-height: 34.2px;"><strong><span style="line-height: 34.2px; font-size: 18px;">Hello '.strtoupper($_POST['fname']).',</span></strong></span></p>
                <p style="font-size: 14px; line-height: 190%;"><span style="font-size: 16px; line-height: 30.4px;">We are very excited to see you join our Lakbayan family! 
                But before that, verify your account now! 

                Just click the link below to complete the verification:</span>
                <span style="opacity: 0"> '.$date_now.' </span></p>
                </div>

                    </td>
                    </tr>
                </tbody>
                </table>

                <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                </div>
                </div>
                <!--[if (mso)|(IE)]></td><![endif]-->
                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
                </div>



                <div class="u-row-container" style="padding: 0px;background-color: transparent">
                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
                    
                <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                <!--[if (!mso)&(!IE)]><!--><div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;"><!--<![endif]-->
                
                <table style="font-family:\'Montserrat\',sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                <tbody>
                    <tr>
                    <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 30px;font-family:\'Montserrat\',sans-serif;" align="left">
                        
                <!--[if mso]><style>.v-button {background: transparent !important;}</style><![endif]-->
                <div align="center">
                <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://unlayer.com" style="height:49px; v-text-anchor:middle; width:224px;" arcsize="0%"  stroke="f" fillcolor="#ff8600"><w:anchorlock/><center style="color:#FFFFFF;font-family:\'Montserrat\',sans-serif;"><![endif]-->  
                    <a href="https://lakbaysabayan.com/backend/auth/verifyuser.php?email='.$sendto.'&verification_code='.$verification.'" target="_blank" class="v-button" style="box-sizing: border-box;display: inline-block;font-family:\'Montserrat\',sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #ff8600; border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; width:auto; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;">
                    <span style="display:block;padding:16px 50px;line-height:120%;"><strong><span style="font-size: 14px; line-height: 16.8px;">V E R I F Y   N O W</span></strong></span>
                    </a>
                <!--[if mso]></center></v:roundrect><![endif]-->
                </div>

                    </td>
                    </tr>
                </tbody>
                </table>

                <!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
                </div>
                </div>
                <!--[if (mso)|(IE)]></td><![endif]-->
                    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                    </div>
                </div>
                </div>


                    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                    </td>
                </tr>
                </tbody>
                </table>
                <!--[if mso]></div><![endif]-->
                <!--[if IE]></div><![endif]-->
                </body>



                </html>

                ';
                // BODY END
                $mail->addEmbeddedImage('../../assets/img/image-3.png', 'image-3.png');
                if(!$mail->send()){
                    ?>
                        <script>
                            alert("Registration Failed! Invalid Email.");
                            window.location.replace("../../index.php");
                        </script>
                    <?php
                }else{
                    ?>
                    <script>
                        alert("<?php echo "Registration Successful! A verification link has been sent to " . $sendto ?>");
                        window.location.replace("../../index.php");
                    </script>
                    <?php
                }
            }
            else{
                echo<<<END
                    <script type ="text/JavaScript">  
                    alert("ERROR. Record not added.")
                    window.location.replace("../../index.php");
                    </script>
                END;
            }
        }

    }

    ?>