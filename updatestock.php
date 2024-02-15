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


$sql_check_remaining = "SELECT stock FROM itembranch
                        WHERE itembranch.item_id IN (SELECT item_id FROM item WHERE item_name = '$name') 
                        AND branch_id IN (SELECT branch_id FROM branch WHERE branch_name = '$branch')";
$result_check_remaining = $conn->query($sql_check_remaining);

if ($result_check_remaining->num_rows > 0) {
    $row = $result_check_remaining->fetch_assoc();
    $remaining_quantity = $row["stock"];

    if ($inputValue > $remaining_quantity) {
        // Input quantity is greater than remaining quantity
        echo "Input quantity cannot be greater than remaining quantity.";
        exit; // Stop script execution
    }
}


// Prepare SQL statement
$sql_update_stock = "UPDATE itembranch
        SET stock = stock - $inputValue
        WHERE itembranch.item_id IN (SELECT item_id FROM item WHERE item_name = '$name') 
        AND branch_id IN (SELECT branch_id FROM branch WHERE branch_name = '$branch')";

// Execute SQL statement
if ($conn->query($sql_update_stock) === TRUE) {
    // If update is successful, insert transaction into history table
    $sql_insert_history = "INSERT INTO history (item_name, branch_name, quantity, remain)
                            VALUES ('$name', '$branch', '$inputValue','$remain')";
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
?>
