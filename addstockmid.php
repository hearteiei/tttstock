<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tttstock";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$inputValue = $_POST['input']; 
$name = $_POST['name'];
$branch = $_POST['branch']; 
$remain = $_POST['remainnew']; 


$sql_update_stock = "UPDATE item 
SET stockmid = stockmid + '$inputValue' 
WHERE item_id IN (SELECT item_id FROM item WHERE item_name = '$name')";


if ($conn->query($sql_update_stock) === TRUE) {
    
    $sql_insert_history = "INSERT INTO history (item_name, branch_name, quantity, remain, action)
                            VALUES ('$name', '$branch', '$inputValue','$remain','เพิ่ม')";
    if ($conn->query($sql_insert_history) === TRUE) {
        echo "Stock updated and transaction recorded successfully";
    } else {
        echo "Error recording transaction: " . $conn->error;
    }
} else {
    echo "Error updating stock: " . $conn->error;
}
$conn->close();
