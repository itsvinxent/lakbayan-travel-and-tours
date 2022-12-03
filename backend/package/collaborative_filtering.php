<?php 
include __DIR__.'/vendor/autoload.php';
include __DIR__.'/../connect/dbCon.php';
use Tigo\Recommendation\Recommend;


function getCollabRecommendation(int $userId): array {
    $table = array();
    $rate = 0;

    // $conn = new mysqli('localhost','root','1234','traveldb');
    global $conn;
    if($conn->connect_errno){
        echo "There's an error connecting with the database";
    }
    if($result = $conn->query("SELECT packageID_rated, package_rating, userID_rating  FROM packagerating_tbl ORDER BY RAND() LIMIT 200")){
        $row = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($row as $rows) {
            if($rows['package_rating'] >= 3) $rate = 1;
            else $rate = 0;
            array_push($table, array(
                                    'product_id' => strval($rows['packageID_rated']),
                                    'score' => $rate,
                                    'user_id' => intval($rows['userID_rating'])
            ));
            // echo '<br>'.$rows['user_id'];
        }
    }

    // echo '<pre>';
    // print_r($table);
    // echo '</pre>';
    
    $client = new Recommend();
    $result = $client->ranking($table, $userId);
    return $result;
}

// $table1 = [
//     ['product_id'=> 'A',
//     'score'=> 0, 
//     'user_id'=> 1
//     ],
//     ['product_id'=> 'B',
//     'score'=> 1, 
//     'user_id'=> 1
//     ],
//     ['product_id'=> 'C',
//     'score'=> 1, 
//     'user_id'=> 1
//     ],
//     ['product_id'=> 'A',
//     'score'=> 0, 
//     'user_id'=> 2
//     ],
//     ['product_id'=> 'B',
//     'score'=> 1, 
//     'user_id'=> 2
//     ],
//     ['product_id'=> 'C',
//     'score'=> 1, 
//     'user_id'=> 2
//     ],
//     ['product_id'=> 'D',
//     'score'=> 1, 
//     'user_id'=> 2
//     ],
//     ['product_id'=> 'B',
//     'score'=> 0, 
//     'user_id'=> 3
//     ],
//     ['product_id'=> 'D',
//     'score'=> 1, 
//     'user_id'=> 3
//     ]
// ];

// $result = getCollabRecommendation(49);

// $sql = "SELECT *, CASE ";

// foreach($result as $results){
//     $sql .= 'WHERE package_id='.$results.' THEN 1 ';
//     echo "<br>";
// }
// $sql .=  "FROM remotasks.packages
//           ORDER BY priority DESC
//           LIMIT 0, 10" ;

// echo $sql;

// foreach ($table as $key => $content){
//     print_r ($table[$key]);
//     echo "<br>";
// }


// echo '<pre>';
// print_r($result);
// echo '</pre>';
?>