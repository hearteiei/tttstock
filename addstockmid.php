<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tttstock";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the AJAX request
$inputValue = $_POST['input']; // Input value
$name = $_POST['name']; // Item name
$branch = $_POST['branch']; // Branch name
$remain = $_POST['remainnew']; // Branch name

// Prepare SQL statement
$sql_update_stock = "UPDATE item 
SET stockmid = stockmid + '$inputValue' 
WHERE item_id IN (SELECT item_id FROM item WHERE item_name = '$name')";

// Execute SQL statement
if ($conn->query($sql_update_stock) === TRUE) {
    // If update is successful, insert transaction into history table
    $sql_insert_history = "INSERT INTO history (item_name, branch_name, quantity, remain, action)
                            VALUES ('$name', '$branch', '$inputValue','$remain','เพิ่ม')";
    if ($conn->query($sql_insert_history) === TRUE) {
        // If insertion is successful
        echo "Stock updated and transaction recorded successfully";
    } else {
        // If there's an error with insertion
        echo "Error recording transaction: " . $conn->error;
    }
} else {
    // If there's an error with updating stock
    echo "Error updating stock: " . $conn->error;
}

// Close database connection
$conn->close();
