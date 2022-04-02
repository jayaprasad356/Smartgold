<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../includes/crud.php');
include_once('verify-token.php');
include_once('../includes/variables.php');
$db = new Database();
$db->connect();

if (!verify_token()) {
    return false;
}

if (!isset($_POST['accesskey'])  || trim($_POST['accesskey']) != $access_key) {
    $response['success'] = false;
    $response['message'] = "No Accsess key found!";
    print_r(json_encode($response));
    return false;
    exit();
}

if (empty($_POST['seller_id'])) {
    $response['success'] = false;
    $response['message'] = "Seller ID is Empty";
    print_r(json_encode($response));
    return false;
}
$seller_id = $db->escapeString($_POST['seller_id']);
$sql = "SELECT * FROM products WHERE seller_id = '" . $seller_id . "'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['seller_id'] = $row['seller_id'];
        $temp['name'] = $row['name'];
        $temp['category_id'] = $row['category_id'];
        $temp['image'] = DOMAIN_URL . $row['image'];
        $temp['description'] = $row['description'];
        $temp['gender'] = $row['gender'];
        $temp['weight'] = $row['weight'];
        $temp['discounted_price'] = $row['discounted_price'];
        $temp['price'] = $row['price'];
        
        $temp1[] = $temp;
    }
    $response['success'] = true;
    $response['message'] = "products Retrived Successfully";
    $response['data'] = $temp1;
    print_r(json_encode($response));

}
else{
    $response['success'] = false;
    $response['message'] = "products Not Found";
    $response['data'] = $res;
    print_r(json_encode($response));

}




?>