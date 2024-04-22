<?php
include 'connect.php';
if(isset($_POST['insertitemdata'])) {
    // $name = $_POST['insertitemdata'];
    $remain17 = $_POST['remain17'];
    $remain13 = $_POST['remain13'];
    $remainmid = $_POST['remainmid'];
    $min17 = $_POST['min17'];
    $min13 = $_POST['min13'];
    $minmid = $_POST['minmid'];
    $name = $_POST['name'];
    if (!preg_match('/^[A-Za-z0-9ก-๙]+$/u', $min13) || !preg_match('/^[A-Za-z0-9ก-๙]+$/u', $min17)|| !preg_match('/^[A-Za-z0-9ก-๙]+$/u', $remain13)|| !preg_match('/^[A-Za-z0-9ก-๙]+$/u', $remain17)|| !preg_match('/^[A-Za-z0-9ก-๙]+$/u', $remainmid)|| !preg_match('/^[A-Za-z0-9ก-๙]+$/u', $minmid)) {
        // Invalid name or unit format
        echo '<script> alert("กรุณาใส่ชื่อและหน่วยโดยไม่ใช้ช่องว่างหรืออักขระพิเศษ"); </script>';
        header('Location: item.php?status=char');
        exit(); // Stop further execution
    }
    $query_select_item_id = "SELECT item_id FROM item WHERE item_name = '$name'";
    $result_item_id = mysqli_query($connect, $query_select_item_id);

    if ($result_item_id && mysqli_num_rows($result_item_id) > 0) {
        // Fetch the item_id
        $row_item_id = mysqli_fetch_assoc($result_item_id);
        $item_id = $row_item_id['item_id'];

        // Update itembranch for branch_id = 2
        $query_update_itembranch_13 = "UPDATE itembranch SET minimum = '$min13', stock = '$remain13' WHERE item_id = '$item_id' AND branch_id = 2";
        $result_update_13 = mysqli_query($connect, $query_update_itembranch_13);

        // Update itembranch for branch_id = 1
        $query_update_itembranch_17 = "UPDATE itembranch SET minimum = '$min17', stock = '$remain17' WHERE item_id = '$item_id' AND branch_id = 1";
        $result_update_17 = mysqli_query($connect, $query_update_itembranch_17);

        $query_update_itemmid = "UPDATE item SET midminimum = '$minmid', stockmid = '$remainmid' WHERE item_id = '$item_id'";
        $result_update_17 = mysqli_query($connect, $query_update_itemmid);

        if ($result_update_13 && $result_update_17) {
            // Both updates successful
            echo '<script> alert("Updates successful."); </script>';
            header('Location: item.php?status=successall');
        } else {
            // One or both updates failed
            echo '<script> alert("One or both updates failed."); </script>';
            header('Location: item.php');
        }
    } else {
        // Item not found
        echo '<script> alert("Item not found."); </script>';
        header('Location: item.php');
    }
}
?>