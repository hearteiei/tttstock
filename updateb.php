<?php
$connect = mysqli_connect("localhost", "root", "", "tttstock");
if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE branch SET ".$_POST["column_name"]."='".$value."' WHERE brach_id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>
