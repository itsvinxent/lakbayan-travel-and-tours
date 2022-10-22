<?php
  require_once "../connect/dbCon.php"; 

  if(isset($_POST['locquery'])) {
    $locquerystring = "SELECT DISTINCT Province FROM areas_tbl WHERE Province LIKE '%{$_POST['locquery']}%';";
    $array = array();
    $query=mysqli_query($conn, $locquerystring);
    
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['Province'];
    }
    
    for ($i=0; $i < count($array); $i++) { 
      echo '<span>' . $array[$i] . '</span>';
    }

    mysqli_close($conn);
  }

  

?>