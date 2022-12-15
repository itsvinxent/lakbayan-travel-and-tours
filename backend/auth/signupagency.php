<?php 
set_include_path(dirname(__FILE__));

require 'imgverification.php';
    include __DIR__.'/../connect/dbCon.php';

if(isset($_POST['aTerms']) && isset($_FILES['aVerify'])) {

        $gotVerify  = $_FILES['aVerify'];
        $chk =  image_verification($gotVerify);

        if($chk == false){
            echo<<<END
                <script type ="text/JavaScript">  
                alert("ERROR. Upload your verification photo")
                </script>
            END;
        }else{
            // echo "BOINGO";

            if(mysqli_connect_error()) {
            echo<<<END
                <script type ="text/JavaScript">  
                alert("ERROR. Failed connecting to databasee")
                </script>
            END;

            } else {
                // Checks if email exists
                $gotEmail =  mysqli_real_escape_string($conn, $_POST['aEmail']);
                $emailCheck = "SELECT EXISTS(SELECT * FROM  user_tbl WHERE email='$gotEmail')";
                $result = mysqli_fetch_row(mysqli_query($conn, $emailCheck));
                
                if($result[0]=='1'){
                    echo<<<END
                    <script type ="text/JavaScript">  
                    alert("An account with this email already exists. Use another email.")
                    </script>
                    END;

                }else{
                    
                    $updated = rename_image($gotVerify, "DOT-");
                    $gotMFName =  mysqli_real_escape_string($conn, $_POST['aMFName']);
                    $gotMLName =  mysqli_real_escape_string($conn, $_POST['aMLName']);

                    $hash = password_hash(mysqli_real_escape_string($conn, $_POST['aPassword']), PASSWORD_BCRYPT);
                    $addManager = "INSERT INTO  user_tbl (fname, lname, email, `password`, usertype) 
                                VALUES('$gotMFName', '$gotMLName', '$gotEmail', '$hash', 'manager' )";

                    if(mysqli_query($conn, $addManager)){

                        $gotID = mysqli_insert_id($conn);
                        
                        $gotAName =  mysqli_real_escape_string($conn, $_POST['aName']);
                        $gotAAddress =  mysqli_real_escape_string($conn, $_POST['aAddress']);
                        $gotAccred =  mysqli_real_escape_string($conn, $_POST['aDot']);
                        $isFound =  mysqli_real_escape_string($conn, $_POST['is_found']);

                        $addAgency = "INSERT INTO  agency_tbl (`agencyName`, `agencyAddress`, `agencyManID`, agencyImageProof, `agencyAccreditation`,`is_found`) 
                                    VALUES ('$gotAName', '$gotAAddress', '$gotID', '$updated', '$gotAccred', $isFound)";
                        
                        if (mysqli_query($conn, $addAgency)){

                            $getid = mysqli_insert_id($conn);

                            $newagent = '../../assets/img/users/travelagent/'.$getid.'/';

                            if(!file_exists($newagent)){
                                mkdir($newagent, 0777, true);
                            }

                            $placehere = '../../assets/img/users/admin/certificates/';
                            $placever = $placehere.$updated;

                            //checks if dir exist and makes one if it does not
                            if(!file_exists($placehere)){
                                mkdir($placehere, 0777, true);
                            }

                            move_uploaded_file($gotVerify['tmp_name'], $placever);
                            
                            echo<<<END
                            <script type ="text/JavaScript">  
                            alert("Record successfully added")
                            </script>
                        END;

                        } else {
                            echo<<<END
                            <script type ="text/JavaScript">  
                            alert("ERROR. Record not added.")
                            </script>
                        END;
                        }
                    }
                    else{
                        echo<<<END
                        <script type ="text/JavaScript">  
                        alert("ERROR. Query Error")
                        </script>
                        END;
                    }
                    
                }
            }
        }
 }
?>

<meta http-equiv="refresh" content="0;URL=../../index.php" />