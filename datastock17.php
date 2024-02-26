<?php
include 'connect.php';
$query = "SELECT *
FROM itembranch
JOIN item ON itembranch.item_id = item.item_id where branch_id = 1";

if(isset($_POST["search"]["value"])) {
    $query .= ' AND item_name LIKE "%'.$_POST["search"]["value"].'%"';
}

if(isset($_POST["order"])) {
 
}

$query1 = '';

if($_POST["length"] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$result = mysqli_query($connect, $query . $query1);

if (!$result) {
    die("Query failed: " . mysqli_error($connect));
}

$number_filter_row = mysqli_num_rows($result);

$data = array();

while($row = mysqli_fetch_array($result)) {
    $sub_array = array();
    $sub_array[] = '<div  class="update" data-id="'.$row["itembranch_id"].'" data-column="item_name">' . $row["item_name"] . '</div>';
    // $sub_array[] = '<div contenteditable class="update" data-id="'.$row["itembranch_id"].'" data-column="minimum">' . $row["minimum"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["itembranch_id"].'" data-column="stockmid">' . $row["stock"] . '</div>';
    $sub_array[] = '<button type="button" name="withdraw" class="btn btn-danger btn-xs withdraw" id="'.$row["item_id"].'">เบิกสินค้า</button>';
    
    $data[] = $sub_array;
}

function get_all_data($connect) {
    $query = "SELECT *
    FROM itembranch
    JOIN item ON itembranch.item_id = item.item_id where branch_id = 1";
    $result = mysqli_query($connect, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connect));
    }

    return mysqli_num_rows($result);
}

$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  get_all_data($connect),
    "recordsFiltered" => get_all_data($connect),
    "data"    => $data
);
echo json_encode($output);
mysqli_close($connect);
?>
