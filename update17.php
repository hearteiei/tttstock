<?php
include 'connect.php';
if(isset($_POST["id"]))
{
    $value = mysqli_real_escape_string($connect, $_POST["value"]);
    $column_name = mysqli_real_escape_string($connect, $_POST["column_name"]);
    $id = mysqli_real_escape_string($connect, $_POST["id"]);
    
    if ($column_name != 'Name' && $value < 0) {
        echo 'Values must be greater than or equal to 0';
        exit;
    }

    $query = "UPDATE itembranch SET $column_name = ? WHERE itembranch_id = ? AND branch_id = 1";

    $stmt = mysqli_prepare($connect, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $value, $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo 'Data Updated';
    } else {
        die("Query preparation failed: " . mysqli_error($connect));
    }
}
?>
