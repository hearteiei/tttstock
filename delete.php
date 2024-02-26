<?php
include 'connect.php';
if(isset($_POST["id"]))
{
    $id = $_POST['id'];
    $query = "DELETE FROM itembranch WHERE item_id = $id;
              DELETE FROM item WHERE item_id = $id";
    if(mysqli_multi_query($connect, $query))
    {
        echo 'Data Deleted';
    }
    else
    {
        echo 'Error deleting data: ' . mysqli_error($connect);
    }
}
?>