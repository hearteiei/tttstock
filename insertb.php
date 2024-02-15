<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'tttstock');
if(isset($_POST['insertdata']))
{
    $name = $_POST['name'];
    $query = "INSERT INTO branch (`branch_name`) VALUES ('$name')";
    $query_run = mysqli_query($connection, $query);

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