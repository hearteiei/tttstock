<?php
include 'connect.php';
if(isset($_POST['insertdata']))
{
    $name = $_POST['name'];
    $query = "INSERT INTO branch (`branch_name`) VALUES ('$name')";
    $query_run = mysqli_query($connect, $query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: branch.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
        header('Location: branch.php');
    }
}

?>