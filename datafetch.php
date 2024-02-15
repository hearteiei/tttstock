<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "tttstock");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM item ";

if(isset($_POST["search"]["value"])) {
    $query .= 'WHERE item_name LIKE "%'.$_POST["search"]["value"].'%"';
}

if(isset($_POST["order"])) {
    // Add your order by logic here if needed
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
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["item_id"].'" data-column="item_name">' . $row["item_name"] . '</div>';
    $sub_array[] = '<div contenteditable class="update" data-id="'.$row["item_id"].'" data-column="item_unit">' . $row["item_unit"] . '</div>';
    $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["item_id"].'">Delete</button>';
    
    $data[] = $sub_array;
}

function get_all_data($connect) {
    $query = "SELECT * FROM item";
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
// echo($number_filter_row);
mysqli_close($connect);
?>
