<?php

include 'connect.php';

$inputValue = $_POST['input']; 
$name = $_POST['name'];
$branch = $_POST['branch']; 
$remain = $_POST['remainnew']; 


$sql_update_stock = "UPDATE item 
SET stockmid = stockmid + '$inputValue' 
WHERE item_id IN (SELECT item_id FROM item WHERE item_name = '$name')";


if ($connect->query($sql_update_stock) === TRUE) {
    
    $sql_insert_history = "INSERT INTO history (item_name, branch_name, quantity, remain, action)
                            VALUES ('$name', '$branch', '$inputValue','$remain','เพิ่ม')";
    if ($connect->query($sql_insert_history) === TRUE) {
        echo "Stock updated and transaction recorded successfully";
    } else {
        echo "Error recording transaction: " . $connect->error;
    }
} else {
    echo "Error updating stock: " . $connect->error;
}
$connect->close();
