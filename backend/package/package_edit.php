<?php 
 session_start();

 include __DIR__.'/../../backend/auth/imgverification.php';
 include __DIR__.'/../../backend/connect/dbCon.php';
 include __DIR__.'/../../backend/auth/dboperation.php';
 include __DIR__.'/../../backend/package/packages_display.php';
 include __DIR__ . '/../cloudinary/cloudinary_instance.php';

 if(isset($_POST['submitpack'])){ 
//TO PACKAGE TABLE PROCESS ================================================================================================
     $upName = mysqli_real_escape_string($conn, $_POST['c-package-name']); 
     
     $upDesc = mysqli_real_escape_string($conn, $_POST['c-package-desc']);

    
    $upDateChosen = $_POST['resdate'];
    $divdate = explode("to", $upDateChosen);

    
     $sdateconv = date('Y-m-d h:i:s', strtotime($divdate[0]));
     $edateconv = date('Y-m-d h:i:s', strtotime($divdate[1]));

     
    $upCutoff = $_POST['cutdate'];
     $cutoff = date('Y-m-d h:i:s', strtotime($upCutoff));

     $upMin = 0; $upMax = 0;

    $is_checked = $_POST['isagelimited'] ?? null;
    if($is_checked != null){
        $upMin = $_POST['agemin'] ?? 0 ; //INSERT TO PACKAGE_TBL
        $upMax = $_POST['agemax'] ?? 0; //INSERT TO PACKAGE_TBL
    }
    
     $upMinHead = $_POST['headmin']; 
     $upMaxHead = $_POST['headmax'];
     $upAvailHead = $upMaxHead;

    if ($_SESSION['utype'] == 'manager')
        $myid = $_SESSION['setID'];
    else if ($_SESSION['utype'] == 'admin')
        $myid = $_POST['c-agency-id'];

    $young = 0; $senior = 0;

    
    if($_POST['c-price-method'] == 'person'){ //INSERT TO PACKAGE_TBL
       $adult = $_POST['c-price-adult'];
       $young = $_POST['c-price-child'];
       $senior = $_POST['c-price-senior'];
    }else  $adult = $_POST['price-adult'];

   
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

    if(!$conn){

    }else {
        $qry = "UPDATE package_tbl SET packageTitle='$upName',
                                       packageDescription='$upDesc',
                                       packageStartDate='$sdateconv',
                                       packageEndDate='$edateconv',
                                       packageCutoff='$cutoff',
                                       packageAgeMin='$upMin',
                                       packageAgeMax='$upMax',
                                       packagePersonMin='$upMinHead',
                                       packagePersonMax='$upMaxHead',
                                       packagePrice='$adult',
                                       packagePriceChild='$young',
                                       packagePriceSenior='$senior',
                                       packagePartialType='$partialtype',
                                       packagePartialPrice='$partialamt',
                                       packageSlots='$upAvailHead'
                                       WHERE packageID='$_SESSION[PACKAGE_ID]'";

        if(mysqli_query($conn, $qry)){

        }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }

//TO PACKAGECATEG_TBL PROCESS ================================================================================================
   
    $categoriesGot = array();
    $packCategory = $_POST['hidden-categories']; //INSERT TO PACKAGECATEG_TBL
    if(strstr($packCategory, ',')) $categoriesGot = explode(",", $packCategory);
    else array_push($categoriesGot, $packCategory);
    // echo print_r($_SESSION['CATEGORY_GOT']);
    // echo print_r($categoriesGot);
    
    $removedCategories = array();
    if(!empty($categoriesGot)) $removedCategories = array_merge(array_diff($_SESSION['CATEGORY_GOT'], $categoriesGot));

    for($i = 0; $i < count(array_filter($removedCategories)) ; $i++){
        $data = array(
            'packageCategory' => $removedCategories[$i]
        );
        multi_deletedb($conn, $data, "packagecateg_tbl", "packageID_From", $_SESSION['PACKAGE_ID']);
    }

    $addedCategories = array();
    if(!empty($categoriesGot)) $addedCategories = array_merge(array_diff($categoriesGot, $_SESSION['CATEGORY_GOT']));
    // echo print_r($addedCategories);

    for($i = 0; $i < count(array_filter($addedCategories)) ; $i++){
        $data = array(
            'packageID_From' => $_SESSION['PACKAGE_ID'],
            'packageCategory' => $addedCategories[$i]
        );
        multi_insertdb($conn, $data, "packagecateg_tbl");
    }


//TO PACKAGELOC_TBL PROCESS ================================================================================================

    $locationsGot = array();
    $packLocation = $_POST['hidden-location']; //INSERT TO PACKAGELOC_TBL
    if(strstr($packLocation, ',')) $locationsGot = explode(",", $packLocation);
    else array_push($locationsGot, $packLocation);
    // echo print_r($_SESSION['LOCATIONS_GOT']);
    // echo print_r($locationsGot);

    $removedLocations = array();
    if(!empty($locationsGot)) $removedLocations = array_merge(array_diff($_SESSION['LOCATIONS_GOT'], $locationsGot));

    $areasiddeleted = array();
    for($i=0; $i<count($removedLocations); $i++){
        $data = array(
            'City' => $removedLocations[$i]
        );
        array_push($areasiddeleted, multi_getid($conn, $data, "areas_tbl", "cityID"));

        $delete = array(
            'packageAreasID' => $areasiddeleted[$i]
        );
        multi_deletedb($conn, $delete, "packagedest_tbl", "packageDestID", $_SESSION['PACKAGE_ID']);
    }
    //echo print_r($areasiddeleted);

    $addedLocations = array(); 
    if(!empty($locationsGot)) $addedLocations = array_merge(array_diff($locationsGot, $_SESSION['LOCATIONS_GOT']));

    $areasidadded = array();
    for($i=0; $i<count($addedLocations); $i++){
      $data = array(
          'City' => $addedLocations[$i]
      );

      array_push($areasidadded, multi_getid($conn, $data, "areas_tbl", "cityID"));

      $added = array(
        'packageAreasID' => $areasidadded[$i],
        "packageDestID" => $_SESSION['PACKAGE_ID']
      );

      multi_insertdb($conn, $added, "packagedest_tbl");
    }
    //echo print_r($areasidadded);

//TO PACKAGEINCLUSION_TBL PROCESS ================================================================================================
    $inclusionsGot = array();
    $packInclusion = $_POST['hidden-inclusions']; //INSERT TO PACKAGELOC_TBL
    if(strstr($packInclusion, ',')) $inclusionsGot = explode(",", $packInclusion);
    else array_push($inclusionsGot, $packInclusion);

    $removedInclusions = array();
    if(!empty($inclusionsGot))$removedInclusions = array_merge(array_diff($_SESSION['INCLUSIONS_GOT'], $inclusionsGot));

    for($i = 0; $i < count(array_filter($removedInclusions)) ; $i++){
        $data = array(
            'packageInclusion' => $removedInclusions[$i]
        );
        multi_deletedb($conn, $data, "packageincl_tbl", "packageID_From", $_SESSION['PACKAGE_ID']);
    }

    $addedInclusions = array();
    if(!empty($inclusionsGot))$addedInclusions = array_merge(array_diff($inclusionsGot, $_SESSION['INCLUSIONS_GOT']));

    for($i = 0; $i < count(array_filter($addedInclusions)) ; $i++){
        $data = array(
            'packageID_From' => $_SESSION['PACKAGE_ID'],
            'packageInclusion' => mysqli_real_escape_string($conn, $addedInclusions[$i])
        );
        multi_insertdb($conn, $data, "packageincl_tbl");
    }

//TO PACKAGEIMG_TBL PROCESS ================================================================================================

    //Get Featured Image
    $newFeat = $_FILES['featured-img'];
    $oldFeat = $_POST['featured-img-name'];
    $ftchk = image_verification($newFeat);
    // echo $oldFeat;

    //Get Additional Image
    // echo '<br>';
    $newAdd = $_FILES['additional'];
    $adchk = image_verification($newAdd, true);

    $oldAdd = array();
    for($i=1; $i<6;$i++){
      array_push($oldAdd, $_POST['img'.$i.'-name']);
      if(empty($_POST['img'.$i.'-name'])) break;
    }

    $placehere = '../../assets/img/users/travelagent/'.$myid.'/package/'.$_SESSION['PACKAGE_ID'].'/img/';
    $placecloud = 'assets/img/users/travelagent/'.$myid.'/package/'.$_SESSION['PACKAGE_ID'].'/img/';
    if(!file_exists($placehere)){
        mkdir($placehere, 0777, true);
    }
    
    if(($ftchk == true || $newFeat['error'] == 4) && ($adchk == true || in_array(4, $newAdd['error']))){
        
        if(image_verification($newFeat)){
            $newfeatName = rename_image($newFeat, "PCK-F-");
            $trimmed_ft = trim($newfeatName, '.' . strtolower(pathinfo($newFeat['name'], PATHINFO_EXTENSION)) . '');

            $updatefeatsql = "UPDATE packageimg_tbl SET packageImg_Name='{$newfeatName}' WHERE packageIDFrom={$_SESSION['PACKAGE_ID']} AND packageImg_Name='{$oldFeat}'";
            mysqli_query($conn, $updatefeatsql);
            $placefeat = $placehere.$newfeatName;

            $cloudinary->uploadApi()->upload("$newFeat[tmp_name]", [
                'folder' => $placecloud,
                'public_id' => $trimmed_ft
            ]);

            move_uploaded_file($newFeat['tmp_name'], $placefeat);
        }else if ($newFeat['error'] != 4){
            echo "There's a problem with the image";
        }
        //array_splice($_SESSION['IMAGES_GOT'], 1, 5);
        // echo print_r($_SESSION['IMAGES_GOT']);
        //echo print_r(array_filter($oldAdd));

        $removedImages = array(); 
        if(!empty($oldAdd)) $removedImages = array_merge(array_diff(array_splice($_SESSION['IMAGES_GOT'], 1, 5), $oldAdd));
        //echo print_r($removedImages);

        for($i=0; $i < count($removedImages); $i++){
            $data = array(
                'packageImg_Name' => $removedImages[$i]
            );

            multi_deletedb($conn, $data, "packageimg_tbl", "packageIDFrom", $_SESSION['PACKAGE_ID']);
        }

        //echo print_r(array_filter($newAdd['name']));

        for($i = 0; $i < count($newAdd['name']); $i++){

            if ($newAdd['error'][$i] == 4) {
                continue;
            } 

            $temploc = $newAdd['tmp_name'][$i];
            $extension = strtolower(pathinfo($newAdd['name'][$i], PATHINFO_EXTENSION));
            $preextension = uniqid("PCK-A-", true);
            $updated = $preextension.'.'.$extension;

            $placeadd = $placehere.$updated; 

            $data = array(
                'packageIDFrom' => $_SESSION['PACKAGE_ID'],
                'packageImg_Name' => $updated
            );

            multi_insertdb($conn, $data, "packageimg_tbl");

            $cloudinary->uploadApi()->upload("$temploc", [
                'folder' => $placecloud,
                'public_id' => $preextension
            ]);

            move_uploaded_file($temploc, $placeadd);
            
        }
    }else if ($newFeat['error'] != 4) echo "There's a problem with the image";
    // echo "MY COUNT => ".count(array_filter($newAdd['name']));

    // $removedImages = array_splice($oldAdd, 0, count(array_filter($newAdd['name'])), $newImages);

    // echo print_r(array_filter($oldAdd));

    // echo print_r($removedImages);
    

    // if($chk == true && $newFeat['error']!=4)
    // {echo "SUCCESS";}
    // else if($newFeat['error']==4){
    //  echo "NO IAMGE";
    // }else echo "FAILED";
 }
 if ($_SESSION['utype'] == 'manager')
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=../../agency-profile.php\"/>";
 else if ($_SESSION['utype'] == 'admin')
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=../../admin-panel.php\"/>";

?>