<?php
include 'connect.php';

if(isset($_POST['insertdata'])) {
    echo $_POST['insertdata'];
    $name = $_POST['name'];
    $unit = $_POST['unit'];
    if (!preg_match('/^[A-Za-z0-9ก-๙]+$/u', $name) || !preg_match('/^[A-Za-z0-9ก-๙]+$/u', $unit)) {
        // Invalid name or unit format
        echo '<script> alert("กรุณาใส่ชื่อและหน่วยโดยไม่ใช้ช่องว่างหรืออักขระพิเศษ"); </script>';
        header('Location: item.php?status=char');
        exit(); // Stop further execution
    }

    // Check if the item name already exists in the database
    $check_query = "SELECT * FROM item WHERE item_name = '$name'";
    $check_result = mysqli_query($connect, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        // Item name already exists in the database
        echo '<script> alert("ณายการสินค้านี้มีในระบบแล้ว!!!"); </script>';
        header('Location: item.php?status=already');
    } else {
        // Item name does not exist in the database, proceed with insertion
        $query = "INSERT INTO item (`item_name`,`item_unit`) VALUES ('$name','$unit')";
        $query_run = mysqli_query($connect, $query);

        if($query_run) {
            // Data insertion successful
            echo '<script> alert("Data Saved"); </script>';
            header("Location: item.php?status=success&name=" . urlencode($name));
        } else {
            // Data insertion failed
            echo '<script> alert("Data Not Saved"); </script>';
            header('Location: item.php');
        }
    }
}
?>