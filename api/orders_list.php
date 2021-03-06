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
$user_id = $db->escapeString($_POST['user_id']);
$sql = "SELECT *,orders.payment_status,orders.id AS id,products.id AS product_id,orders.status AS status FROM orders,products WHERE orders.product_id = products.id AND orders.user_id = '" . $user_id . "' ORDER BY orders.id DESC";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $tempRow['id'] = $row['id'];
        $tempRow['product_id'] = $row['product_id'];
        $tempRow['name'] = $row['name'];
        $tempRow['discounted_price'] = $row['discounted_price'];
        $tempRow['quantity'] = $row['quantity'];
        $tempRow['buy_method'] = $row['buy_method'];
        $tempRow['status'] = $row['status'];
        $tempRow['payment_status'] = $row['payment_status'];
        $tempRow['image'] = DOMAIN_URL . $row['image'];
        $rows[] = $tempRow;

    }
    $response['success'] = true;
    $response['message'] = "Orders Retrived Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));

}
else{
    $response['success'] = false;
    $response['message'] = "Orders Not Found";
    $response['data'] = $res;
    print_r(json_encode($response));

}




?>