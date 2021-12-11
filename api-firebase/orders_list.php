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

if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User ID is Empty";
    print_r(json_encode($response));
    return false;
}
$user_id = $db->escapeString($_POST['user_id']);
$sql = "SELECT * FROM orders,products WHERE orders.product_id = products.id AND orders.user_id = '" . $user_id . "'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    $response['success'] = true;
    $response['message'] = "Orders Retrived Successfully";
    $response['data'] = $res;
    print_r(json_encode($response));

}
else{
    $response['success'] = false;
    $response['message'] = "Orders Not Found";
    $response['data'] = $res;
    print_r(json_encode($response));

}




?>