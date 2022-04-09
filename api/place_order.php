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
if (empty($_POST['buy_method'])) {
    $response['success'] = false;
    $response['message'] = "Buy Method is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['is_paid'])) {
    $response['success'] = false;
    $response['message'] = "Paid Status is Empty";
    print_r(json_encode($response));
    return false;
}
$user_id = $db->escapeString($_POST['user_id']);
$buy_method = $db->escapeString($_POST['buy_method']);
$is_paid = $db->escapeString($_POST['is_paid']);
$sql = "SELECT cart.product_id AS product_id,cart.quantity AS quantity,products.discounted_price AS discounted_price,products.seller_id AS seller_id FROM cart,products WHERE cart.product_id = products.id AND user_id = $user_id";
$db->sql($sql);
$res = $db->getResult();
$sql = "SELECT COUNT(id) AS count FROM cart WHERE user_id = '" . $user_id . "'";
$db->sql($sql);
$rescount = $db->getResult();
$productcount = $rescount[0]['count'];
if($is_paid == 'true'){
    $payment_status = "Paid";
}else{
    $payment_status = "UnPaid";
}
$sql = "SELECT * FROM delivery WHERE title = 'delivery'";
$db->sql($sql);
$resdeliver = $db->getResult();

if($productcount > 0){
    for ($i = 0; $i < $productcount; $i++) {
        $product_id = $res[$i]['product_id'];
        $quantity = $res[$i]['quantity'];
        $total_price = $res[$i]['quantity'] * $res[$i]['discounted_price'];
        
        $delivery_charges = $resdeliver[0]['charges'];
        $seller_id = $res[$i]['seller_id'];
        
        $sql = "INSERT INTO orders(`user_id`,`product_id`,`seller_id`,`quantity`,`status`,`delivery_charges`,`buy_method`,`payment_status`,`total`)VALUES('$user_id','$product_id','$seller_id','$quantity','Received',$delivery_charges,'$buy_method','$payment_status','$total_price')";
        $db->sql($sql);
        $sql = "DELETE FROM cart WHERE product_id = '" . $product_id . "' AND user_id = '$user_id'";
        $db->sql($sql);
    
    }
    $response['success'] = true;
    $response['message'] = "Order Placed Successfully";

}
else {
    $response['success'] = false;
    $response['message'] = "No Products Found In Cart";

}





print_r(json_encode($response));


?>