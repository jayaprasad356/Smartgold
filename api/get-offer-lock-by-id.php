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
//select s.* from offers p join seller s on s.id=p.seller_id
if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User ID is Empty";
    print_r(json_encode($response));
    return false;
}

$user_id = $db->escapeString($_POST['user_id']);



$sql = "SELECT *,ol.id AS id from offer_lock ol INNER JOIN offers o on ol.offer_id = o.id INNER JOIN seller s ON o.seller_id = s.id WHERE ol.user_id = '" . $user_id . "'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    
    $response['success'] = true;
    $response['message'] = "Locked Offer Successfully Retrived";
    $response['data'] = $res;
    print_r(json_encode($response));

}
else{
    
    $response['success'] = false;
    $response['message'] = "No Data Found";
    
    print_r(json_encode($response));

}




?>