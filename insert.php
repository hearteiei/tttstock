<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'tttstock');
if(isset($_POST['insertdata']))
{
    $name = $_POST['name'];
    $unit = $_POST['unit'];
    $query = "INSERT INTO item (`item_name`,`item_unit`) VALUES ('$name','$unit')";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: item.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
        header('Location: item.php');
    }
}

?>