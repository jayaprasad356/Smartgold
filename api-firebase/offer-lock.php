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
//select s.* from offers p join seller s on s.id=p.seller_id
if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User ID is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['seller_id'])) {
    $response['success'] = false;
    $response['message'] = "Seller ID is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['offer_id'])) {
    $response['success'] = false;
    $response['message'] = "Offer ID is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['paid_amt'])) {
    $response['success'] = false;
    $response['message'] = "Paid Amount is Empty";
    print_r(json_encode($response));
    return false;
}
$user_id = $db->escapeString($_POST['user_id']);
$offer_id = $db->escapeString($_POST['offer_id']);
$seller_id = $db->escapeString($_POST['seller_id']);
$paid_amt = $db->escapeString($_POST['paid_amt']);
$status = $db->escapeString('received');


$sql = "INSERT INTO offer_lock(`user_id`,`offer_id`, `paid_amt`, `status`)VALUES($user_id,$offer_id,$paid_amt,'$status')";

$db->sql($sql);
$res = $db->getResult();

$sql = "SELECT * FROM seller WHERE id = '" . $seller_id . "'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    $response['success'] = true;
    $response['message'] = "Smart Gold is Locked Successfully";
    $response['data'] = $res;
    print_r(json_encode($response));

}
else{
    $response['success'] = false;
    $response['message'] = "Smart Gold is not Locked";
    $response['data'] = $res;
    print_r(json_encode($response));

}




?>