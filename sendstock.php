<?php

include 'connect.php';


$inputValue = $_POST['input']; 
$name = $_POST['name']; 
$branch = $_POST['branch']; 
$remain = $_POST['remainnew']; 
$remainmid = $_POST['remainmid']; 
if ($branch == "soi13") {
    $branchname = "13";
} elseif ($branch == "soi17") {
    $branchname = "17";
}


$sql_check_remaining = "SELECT stockmid FROM itembranch,item
                        WHERE itembranch.item_id IN (SELECT item_id FROM item WHERE item_name = '$name') 
                        AND branch_id IN (SELECT branch_id FROM branch WHERE branch_name = '$branch')
                        AND item.item_name='$name'";
$result_check_remaining = $connect->query($sql_check_remaining);

if ($result_check_remaining->num_rows > 0) {
    $row = $result_check_remaining->fetch_assoc();
    $remaining_quantity = $row["stockmid"];

    if ($inputValue > $remaining_quantity) {
   
        echo "Input quantity cannot be greater than remaining quantity.";
        exit;
    }
}



$sql_update_stock = "UPDATE itembranch,item
        SET stock = stock + $inputValue,stockmid = stockmid - $inputValue
        WHERE itembranch.item_id IN (SELECT item_id FROM item WHERE item_name = '$name') 
        AND branch_id IN (SELECT branch_id FROM branch WHERE branch_name = '$branch')
        AND item.item_name='$name'";


if ($connect->query($sql_update_stock) === TRUE) {
   
    $sql_insert_history = "INSERT INTO history (item_name, branch_name, quantity, remain, action)
                            VALUES ('$name', '$branch', '$inputValue','$remain','เพิ่ม'),('$name', 'ครัวกลาง', '$inputValue','$remainmid','ส่งไปซอย$branchname')";
    if ($connect->query($sql_insert_history) === TRUE) {

        echo "Stock updated and transaction recorded successfully";
    } else {

        echo "Error recording transaction: " . $connect->error;
    }
} else {
  
    echo "Error updating stock: " . $connect->error;
}


$connect->close();
?>



