<?php 

    include __DIR__."/../connect/dbCon.php";
    include __DIR__."/user_display.php";
    
    // Function for determining the proper prefix/suffix to be added to the SQL Query
    function get_prefix() {
        global $has_previous_value;
        if ($has_previous_value)
            return " AND ";
        return " WHERE ";
    }

    if (isset($_POST['is_user']) and $_POST['is_user'] == 'true') {
        try {
            $query_string = "SELECT *, CONCAT(fname, ' ', lname) AS fullname FROM  user_tbl where is_deleted = 0 ";
            $has_previous_value = true;

            if (isset($_POST['email'])) {
                $query_string .= get_prefix() . "email LIKE '%{$_POST['email']}%'";
                $has_previous_value = true;
            }

            if (isset($_POST['user_id'])) {
                $query_string .= get_prefix() . "id = {$_POST['user_id']}";
                $has_previous_value = true;
            }

            if (isset($_POST['user_name'])) {
                $query_string .= " HAVING fullname LIKE '%{$_POST['user_name']}%'";
                $has_previous_value = true;
            }

        } finally {
            fetch_user_accounts($query_string, $conn);
            // echo $query_string;
        }
    }
?>