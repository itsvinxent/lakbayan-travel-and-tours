<?php 

require_once __DIR__.'/content-based/recommend.php';
require_once __DIR__.'/content-based/content_based.php';
// require 'collaborative_filtering.php';

function getContentBasedRecommend($userID): array{

    include __DIR__.'/../connect/dbCon.php';

    $usercat = array();

    $array = array();
    $array2 = array();
    $array3 = array();

    $initial_merge = array();
    $final_merge = array();



    if($conn->connect_errno){
        echo "There's an error connecting with the database";
    }
    if($userCateg = $conn->query("SELECT CONCAT('USER-',userID) AS userID, userPreferences 
                                  FROM userpreference_tbl 
                                  WHERE userID = {$userID}")){
        $userRow = $userCateg->fetch_all(MYSQLI_ASSOC);

        foreach($userRow as $userRows){
                //GETS USER CATEGORIES
                array_push($usercat, $userRows['userPreferences']);
        }
    }

    if(count($usercat)==0) {
    return $usercat;}

    //GET PACKAGE CATEGORIES FROM DB
    if($result = $conn->query("SELECT PT.packageTitle, packageCategory  
                               FROM packagecateg_tbl AS PC 
                               INNER JOIN package_tbl AS PT ON PC.packageID_from=PT.packageID
                               ORDER BY RAND() LIMIT 200")){
        $row = $result->fetch_all(MYSQLI_ASSOC);
        foreach($row as $rows){
            if(!array_key_exists($rows['packageTitle'], $array)){
                //PUT INITIAL CATEGORIES IN ARRAY
                $array += array(strval($rows['packageTitle']) => [$rows['packageCategory']]);
            } 
            else if(!array_key_exists($rows['packageTitle'], $array2)){
                //PUT THE SECOND CATEGORY OF PACKAGES WITH TWO CATEGORIES
                $array2 += array(strval($rows['packageTitle']) => $rows['packageCategory']);
            }
            else 
                //PACKAGES WITH THREE CATEGORIES, THIRD CATEGORY
                $array3 += array(strval($rows['packageTitle']) => $rows['packageCategory']); 
        }
    
        //MERGE THE ARRAYS WITH SIMILAR KEYS 
        $initial_merge = array_merge_recursive($array, $array2);
        //FINAL MERGE FOR THOSE PACKAGES WITH THREE CATEGORIES 
        //TO BE USED IN RECOMMENDING 
        $final_merge = array_merge_recursive($initial_merge, $array3);

    }

    $engine = new ContentBasedRecommend($usercat, $final_merge);

    return array_slice($engine->getRecommendation(), 0, 3);

    // echo '<pre>';
    // print_r(array_slice($engine->getRecommendation(), 0, 3));
    // echo '</pre>';

}


?>