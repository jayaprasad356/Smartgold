<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../includes/crud.php');
$db = new Database();
$db->connect();


$sql = "SELECT * FROM `settings`";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    $temp['id'] = $res[0]['id'];
    $temp['price'] = $res[0]['price'];
    $temp['days'] = $res[0]['days'];
    
    $response['success'] = true;
    $response['message'] = "Price/Duration Retrived Successfully";
    $response['data'] = $temp;
    print_r(json_encode($response));

}
else{
    $response['success'] = false;
    $response['message'] = "Price/Duration Not Found";
    $response['data'] = $res;
    print_r(json_encode($response));

}




?>