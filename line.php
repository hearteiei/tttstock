<?php
define('LINE_API',"https://notify-api.line.me/api/notify");

// Establish connection to the database (Replace 'hostname', 'username', 'password', and 'database' with your actual database credentials)
$mysqli = new mysqli('localhost', 'root', '', 'tttstock');

// Check connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Perform query
$result = $mysqli->query("SELECT item_name, stock, minimum
                          FROM itembranch
                          JOIN item ON itembranch.item_id = item.item_id 
                          WHERE branch_id = 1 AND stock < minimum");

$json = array();
if ($result->num_rows > 0) {
    // Fetch data and encode into JSON
    while ($row = $result->fetch_assoc()) {
        // Calculate the difference between 'minimum' and 'stock'
        $row['order'] = $row['minimum'] - $row['stock'];
        // Add the modified row to the JSON array
        $json[] = $row;
    }
}
header('Content-Type: application/json; charset=utf-8');
$json=json_encode($json, true);
$js_array=json_decode($json, true);
foreach ($js_array as $item) {
    echo $item['item_name'] ." สั่งเพิ่ม ".$item['order']. "\n";
}
// Initialize an empty array to store values
$token = "xcOCVGPKj01ZyzjHgNXV7u2vhhHczBDeoiZWt85sSsC"; //ใส่Token ที่copy เอาไว้
$str = "\n".'รายการสินค้าหมด:'."\n"; // Initialize an empty string

foreach ($js_array as $item) {
    $str .=  $item['item_name'] ." สั่งเพิ่ม ".$item['order']. "\n";
} //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
 
$res = notify_message($str,$token);
print_r($res);
function notify_message($message,$token){
 $queryData = array('message' => $message);
 $queryData = http_build_query($queryData,'','&');
 $headerOptions = array( 
         'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".$token."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
         ),
 );
 $context = stream_context_create($headerOptions);
 $result = file_get_contents(LINE_API,FALSE,$context);
 $res = json_decode($result);
 return $res;
}

?>
