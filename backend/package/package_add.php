<?php 
    //set_include_path(dirname(__FILE__));

    //echo get_include_path();
    session_start();

    include '../../backend/auth/imgverification.php';
    include '../../backend/connect/dbCon.php';
    include '../../backend/auth/dboperation.php';
    include_once __DIR__.'\..\..\backend\notifications\notification_model.php';
    

    $featuredImg = $_FILES['featured-img'];
    $ftchk = image_verification($featuredImg);

    // print_r($featuredImg);

    $addImg = $_FILES['additional'];
    $adchk = image_verification($addImg,true);

    if(isset($_POST['submitpack']) && $ftchk == true && $adchk == true){
        //TO PACKAGE TABLE PROCESS ================================================================================================
        $packName = $_POST['c-package-name']; //INSERT TO PACKAGE_TBL
        $packDesc = $_POST['c-package-desc']; //INSERT TO PACKAGE_TBL

        $datechosen = $_POST['resdate'];
        $divdate = explode("to", $datechosen);

        $sdateconv = date('Y-m-d h:i:s', strtotime($divdate[0])); //INSERT TO PACKAGE_TBL
        $edateconv = date('Y-m-d h:i:s', strtotime($divdate[1]));//INSERT TO PACKAGE_TBL

        $cutdate = $_POST['cutdate'];
        $cutoff = date('Y-m-d h:i:s', strtotime($cutdate));
       
        $minage = 0; $maxage = 0;

        $minage = $_POST['agemin']; //INSERT TO PACKAGE_TBL
        $maxage = $_POST['agemax']; //INSERT TO PACKAGE_TBL

        $headmin = $_POST['headmin']; //INSERT TO PACKAGE_TBL
        $headmax = $_POST['headmax']; //INSERT TO PACKAGE_TBL
        $headavail = $headmax; //INSERT TO PACKAGE_TBL

        $young = 0; $senior = 0;

        if($_POST['c-price-method'] == 'person'){ //INSERT TO PACKAGE_TBL
        $adult = $_POST['c-price-adult'];
        $young = $_POST['c-price-child'];
        $senior = $_POST['c-price-senior'];
        } else $adult = $_POST['price-adult'];

        $partialtype = 'NOT'; //INSERT TO PACKAGE_TBL
        $partialamt = 0;
        if(isset($_POST['ispartial'])){
            if($_POST['partial-method'] == 'percent'){
                $partialtype = 'PERCENT';
                $partialamt = $_POST['partial-amount'];}
            else if ($_POST['partial-method'] == 'exact'){
                $partialtype = 'EXACT';
                $partialamt = $_POST['partial-amount'];
            }
        }

        if ($_SESSION['utype'] == 'manager')
            $myid = $_SESSION['setID'];
        else if ($_SESSION['utype'] == 'admin')
            $myid = $_POST['c-agency-id'];


        if(!$conn){
            echo<<<END
            <script type ="text/JavaScript">  
            alert("ERROR. Connection Error.")
            </script>
        END;
        }else{
            $packsql = "INSERT INTO package_tbl (packageCreator, 
            packageTitle, 
            packageDescription, 
            packagePrice, 
            packagePriceChild, 
            packagePriceSenior,
            packageAgeMin,
            packageAgeMax,
            packagePersonMin,
            packagePersonMax,
            packagePartialType,
            packagePartialPrice,
            packageStartDate,
            packageEndDate,
            packageUploadDate,
            packageCutoff,
            packageSlots) VALUES ('$myid',
                                   '$packName',
                                   '$packDesc',
                                   '$adult',
                                   '$young',
                                   '$senior',
                                   '$minage',
                                   '$maxage',
                                   '$headmin',
                                   '$headmax',
                                   '$partialtype',
                                   '$partialamt',
                                   '$sdateconv',
                                   '$edateconv',
                                    now(),
                                   '$cutoff',
                                   '$headavail')";
            
            if(mysqli_query($conn, $packsql)){
                $gotpkID = mysqli_insert_id($conn);
            }else{
                echo<<<END
                    <script type ="text/JavaScript">  
                    alert("ERROR. Record not added.")
                    </script>
                END;
            }
        }

        

        //TO PACKAGECATEG_TBL PROCESS ================================================================================================
        $categoriesGot = array();
        $packCategory = $_POST['hidden-categories']; //INSERT TO PACKAGECATEG_TBL
        if(strstr($packCategory, ',')) $categoriesGot = explode(",", $packCategory);
        else array_push($categoriesGot, $packCategory);

        for($i=0; $i<count($categoriesGot); $i++){
            $data = array(
                'packageID_from' => $gotpkID,
                'packageCategory' => $categoriesGot[$i]
            );

            multi_insertdb($conn, $data, "packagecateg_tbl");
        }
        // echo 'Number of categ is '.count($categoriesGot);

        //TO PACKAGELOC_TBL PROCESS ================================================================================================
        $locationsGot = array();
        $packLocation = $_POST['hidden-location']; //INSERT TO PACKAGELOC_TBL
        if(strstr($packLocation, ',')) $locationsGot = explode(",", $packLocation);
        else array_push($locationsGot, $packLocation);

        $areasid = array();
        for($i=0; $i<count($locationsGot); $i++){
            $data = array(
                'City' => $locationsGot[$i]
            );

            array_push($areasid, multi_getid($conn, $data, "areas_tbl", "cityID"));
            
            $insert = array(
                'packageAreasID' => $areasid[$i],
                'packageDestID' => $gotpkID
            );

            multi_insertdb($conn, $insert, "packagedest_tbl");

        }

        //TO PACKAGEINC_TBL PROCESS ================================================================================================
        $inclusionsGot = array();
        $packInclusion = $_POST['hidden-inclusions']; //INSERT TO PACKAGELOC_TBL
        if(strstr($packInclusion, ',')) $inclusionsGot = explode(",", $packInclusion);
        else array_push($inclusionsGot, $packInclusion);

        for($i=0; $i<count($inclusionsGot); $i++){
            $data = array(
                'packageID_from' => $gotpkID,
                'packageInclusion' => $inclusionsGot[$i]
            );

            multi_insertdb($conn, $data, "packageincl_tbl");
        }

        //TO PACKAGEIMG_TBL PROCESS ================================================================================================
        $featuredImg = $_FILES['featured-img'];
        $ftchk = image_verification($featuredImg);

        // print_r($featuredImg);

        $addImg = $_FILES['additional'];
        $adchk = image_verification($addImg,true);

        // print_r($addImg);

        if($ftchk == true && $adchk == true ){
            echo '<br>';
            echo 'pass';

            $placehere = '../../assets/img/users/travelagent/'.$myid.'/package/'.$gotpkID.'/img/';
            if(!file_exists($placehere)){
                mkdir($placehere, 0777, true);
            }

            $insertfeat = rename_image($featuredImg, "PCK-F-");

            $insertqry = "INSERT INTO packageimg_tbl (packageIDFrom, packageImg_Name) VALUES ('$gotpkID', '$insertfeat')";
            mysqli_query($conn, $insertqry);

            $placefeat = $placehere.$insertfeat;
            
            move_uploaded_file($featuredImg['tmp_name'], $placefeat);

            for($i=0; $i<count(array_filter($addImg['name'])); $i++){

                if($addImg['error'][$i] == 4){
                    continue;
                }else{
    
                $temploc = $addImg['tmp_name'][$i];
                $extension = strtolower(pathinfo($addImg['name'][$i], PATHINFO_EXTENSION));
                $updated = uniqid("PCK-A-", true).'.'.$extension;

                $placeadd = $placehere.$updated;

                $data = array(
                        'packageIDFrom' => $gotpkID,
                        'packageImg_Name' => $updated,
                );

                    multi_insertdb($conn, $data, "packageimg_tbl");

                    move_uploaded_file($addImg['tmp_name'][$i], $placeadd);
                }
            }
        }
        sendNotification($_SESSION['id'], "package", "Package creation success!");

        //echo "SUCCEEEEEEEEEEEEESS";
    }else ;
?>
<meta http-equiv="refresh" content="0;URL=../../agency-profile.php" />
