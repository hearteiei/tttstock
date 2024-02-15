<?php
$connect = mysqli_connect("localhost", "root", "", "tttstock");
if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $column_name = mysqli_real_escape_string($connect, $_POST["column_name"]);
 if ($column_name != 'Name' && $value < 0) {
    echo 'Values must be greater than or equal to 0';
    exit;
}
 $query = "UPDATE item SET ".$_POST["column_name"]."='".$value."' WHERE item_id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>
