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

if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User ID is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['payment_method'])) {
    $response['success'] = false;
    $response['message'] = "Payment Method is Empty";
    print_r(json_encode($response));
    return false;
}
$user_id = $db->escapeString($_POST['user_id']);
$payment_method = $db->escapeString($_POST['payment_method']);
$sql = "SELECT COUNT(*) AS totalproducts
FROM cart
WHERE user_id = '" . $user_id . "'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);

$sql = "SELECT SUM(products.price) AS totalprice,SUM(products.discounted_price) AS orderprice
FROM cart
LEFT JOIN products
ON cart.product_id = products.id WHERE user_id ='" . $user_id . "'";
$db->sql($sql);
$respro = $db->getResult();

$sql = "SELECT * FROM delivery";
$db->sql($sql);
$resdel = $db->getResult();


if ($num >= 1) {
    if($payment_method == 1){
        $deliverycharge = 0; 

    }
    else {
        $deliverycharge = round($resdel[0]['charges']);

    }
    $temp['no_of_products'] = round($res[0]['totalproducts']);
    $temp['totalprice'] = round($respro[0]['totalprice']);
    $temp['orderprice'] = round($respro[0]['orderprice']);
    $temp['delivery_price'] = $deliverycharge;
    $temp['delivery_days'] = round($resdel[0]['days']);
    $saved = $respro[0]['totalprice'] - $respro[0]['orderprice'];
    $temp['grandtotal'] = round($respro[0]['orderprice']) + $deliverycharge;
    $temp['saved'] = $saved;
    $response['success'] = true;
    $response['message'] = "Checkout Retrived Successfully";
    $response['data'] = $temp;
    print_r(json_encode($response));

}
else{
    $response['success'] = false;
    $response['message'] = "Not Found";
    $response['data'] = $res;
    print_r(json_encode($response));

}




?>