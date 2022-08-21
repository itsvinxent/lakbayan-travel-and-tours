<?php 
    include '../connect/dbCon.php';


    if(mysqli_connect_error()) {
        echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Failed connecting to databasee")
            </script>
        END;
    } else {
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

                
                
                $iniValue = 110111;

                $addAgency = "INSERT INTO traveldb.agency_tbl (`agencyName`, `agencyAddress`, `agencyDescription`, `agencyManID`, `agencyManPass`) 
                            VALUES ('$_POST[aName]', '$_POST[aAddress]', '$_POST[aDesc]', '$gotID', '$hash')";
                
                if (mysqli_query($conn, $addAgency)){
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

    mysqli_close($conn);
    
?>

<meta http-equiv="refresh" content="0;URL=../../agencyreg.php" />