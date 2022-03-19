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
//$sql = "SELECT * FROM products WHERE seller_id = '" . $seller_id . "'";
$sql = "SELECT category.id,category.name,category.image FROM `products`,`category` WHERE category.id = products.category_id AND seller_id = '$seller_id' GROUP BY category_id";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['name'] = $row['name'];
        $temp['image'] = DOMAIN_URL . $row['image'];
        
        $temp1[] = $temp;
    }
    $response['success'] = true;
    $response['message'] = "Category Retrived Successfully";
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