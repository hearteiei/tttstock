<?php
$connect = mysqli_connect("localhost", "root", "", "tttstock");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT *
FROM history";
if(isset($_POST["search"]["value"])) {
    $query .= ' WHERE item_name LIKE "%'.$_POST["search"]["value"].'%"';
}

$query .= 'ORDER BY transaction_date DESC';

if(isset($_POST["order"])) {
 
}

$query1 = '';



$result = mysqli_query($connect, $query . $query1);

if (!$result) {
    die("Query failed: " . mysqli_error($connect));
}

$number_filter_row = mysqli_num_rows($result);

$data = array();

while($row = mysqli_fetch_array($result)) {
    $sub_array = array();
    $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="item_name">' . $row["item_name"] . '</div>';
    $sub_array[] = '<div  class="update" data-id="'.$row["id"].'" data-column="minimum">' . $row["branch_name"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-column="stockmid">' . $row["quantity"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-column="stockmid">' . $row["remain"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-column="stockmid">' . $row["action"] . '</div>';
    $sub_array[] = '<div class="update" data-id="'.$row["id"].'" data-column="stockmid">' . $row["transaction_date"] . '</div>';
    
    // $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["item_id"].'">Delete</button>';
    
    $data[] = $sub_array;
}

function get_all_data($connect) {
    $query = "SELECT *
    FROM history";
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
