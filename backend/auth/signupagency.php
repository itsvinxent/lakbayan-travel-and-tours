<?php 
    include '../connect/dbCon.php';

    if (isset($_POST['submit']) && isset($_FILES['aPicture'] )){
        $imgName = $_FILES['aPicture']['name'];
        $imgSize = $_FILES['aPicture']['size'];
        $imgTemp = $_FILES['aPicture']['tmp_name'];
        $imgError = $_FILES['aPicture']['error'];

        if ($imgError === 0){
            if ($imgSize > 20000000){
                echo<<<END
                <script type ="text/JavaScript">  
                alert("ERROR. File must be smaller than 20mb")
                </script>
            END;
            }
            else {
                $imgAllowed = pathinfo($imgName, PATHINFO_EXTENSION);
                $toLower = strtolower($imgAllowed);

                $allowedExt = array("jpg", "jpeg", "png");

                if(in_array($toLower, $allowedExt)){
                    $updatedName = uniqid("PFP-", true).'.'.$toLower;
                    $uploadToFile = '../../assets/img/agencypfp/'.$updatedName;

                // VERIFY OTHER INFO


                    if(mysqli_connect_error()) {
                        echo<<<END
                            <script type ="text/JavaScript">  
                            alert("ERROR. Failed connecting to databasee")
                            </script>
                        END;
                
                    } else {
                        // Checks if email exists
                        $emailCheck = "SELECT EXISTS(SELECT * FROM traveldb.user_tbl WHERE email='$_POST[aEmail]')";
                        $result = mysqli_fetch_row(mysqli_query($conn, $emailCheck));
                        
                        if($result[0]=='1'){
                            echo<<<END
                            <script type ="text/JavaScript">  
                            alert("An account with this email already exists. Use another email.")
                            </script>
                            END;
                
                        }else{
                            $hash = password_hash($_POST['aPassword'], PASSWORD_BCRYPT);
                            $addManager = "INSERT INTO traveldb.user_tbl (fname, lname, email, `password`, usertype) 
                                        VALUES('$_POST[aMFName]', '$_POST[aMLName]', '$_POST[aEmail]', '$hash', 'manager' )";
                
                            if(mysqli_query($conn, $addManager)){
                
                                $getManager = "SELECT * FROM user_tbl WHERE lname='$_POST[aMLName]' AND email='$_POST[aEmail]' LIMIT 1";
                                $res = mysqli_query($conn, $getManager) or die(mysqli_connect_error());
                
                                while($row = mysqli_fetch_assoc($res)){
                                    $gotID = $row['id'];
                                }

                                $addAgency = "INSERT INTO traveldb.agency_tbl (`agencyName`, `agencyAddress`, `agencyDescription`, `agencyManID`, `agencyManPass`, agencyPfpicture) 
                                            VALUES ('$_POST[aName]', '$_POST[aAddress]', '$_POST[aDesc]', '$gotID', '$hash', '$updatedName')";
                                
                                if (mysqli_query($conn, $addAgency)){

                                    move_uploaded_file($imgTemp, $uploadToFile);
                                    
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
                


                // VERIFY OTHER INFO END

                }
                else {
                    echo<<<END
                    <script type ="text/JavaScript">  
                    alert("ERROR. Incorrect file type")
                    </script>
                END;
                }
            }

        }
        else {
            echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. There's a problem with uploading the image")
            </script>
        END;
        }
    }

    
    mysqli_close($conn);
    
?>

<meta http-equiv="refresh" content="0;URL=../../agencyreg.php" />