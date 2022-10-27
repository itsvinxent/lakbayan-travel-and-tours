<?php
  require_once "../connect/dbCon.php"; 

  if(isset($_POST['locquery'])) {
    $locquerystring = "SELECT DISTINCT Cities FROM areas_tbl WHERE Cities LIKE '%{$_POST['locquery']}%';";
    $array = array();
    $query=mysqli_query($conn, $locquerystring);
    
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['Cities'];
    }
    
    for ($i=0; $i < count($array); $i++) { 
      echo '<span>' . $array[$i] . '</span>';
    }

    mysqli_close($conn);
  }

  

?>