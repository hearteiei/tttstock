<?php
$connect = mysqli_connect("localhost", "root", "", "tttstock");
if(isset($_POST["id"]))
{
    $id = $_POST['id'];
    $query = "DELETE FROM itembranch WHERE branch_id = $id;
              DELETE FROM branch WHERE branch_id = $id";
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