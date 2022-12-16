<?php 
//include __DIR__.'/..\..\backend\connect\dbCon.php';

function multi_insertdb($conn, $data, $table){
    foreach($data as $key => $val){
        $name[] =  $key;
        $value[] = "'".$val."'";
    }

    $name = implode(",", $name);
    $value = implode(",", $value);

    // echo '<br>'. $name. ' ' .$value;

    $sql = "INSERT INTO ".$table."($name)"." VALUES "."($value)";
    
    // echo $sql;
    if(mysqli_query($conn, $sql)){

    }else{
        echo<<<END
                    <script type ="text/JavaScript">  
                    alert("ERROR. There's a problem with your request.")
                    </script>
                END;
    }

}

function multi_getid($conn, $data, $table, $id): int{
    foreach($data as $key => $val){
        $name[] =  $key;
        $value[] = "'".$val."'";
    }

    $name = implode(",", $name);
    $value = implode(",", $value);

    // echo '<br>'. $name. ' ' .$value;

    $sql = "SELECT * FROM ".$table." WHERE $name = $value";
    
    // echo $sql;
    if($qry = mysqli_query($conn, $sql)){
        $idgot = mysqli_fetch_assoc($qry);
        return $idgot[$id];
    }
}

function multi_deletedb($conn, $data, $table, $idname, $id){
    foreach($data as $key => $val){
        $name[] =  $key;
        $value[] = "'".$val."'";
    }

    $name = implode(",", $name);
    $value = implode(",", $value);  

    // echo '<br>'. $name. ' ' .$value;

    //$sql = "".$this->insert."".$table."($name)".$this->values."($value)";
    $sql = "DELETE FROM ".$table." WHERE ".$name."=".$value." AND ".$idname."=".$id."";
    // echo '<br>'.$sql;

    if(mysqli_query($conn, $sql)){

    }

}


?>