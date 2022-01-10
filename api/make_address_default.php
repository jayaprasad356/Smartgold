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

if (empty($_POST['address_id'])) {
    $response['success'] = false;
    $response['message'] = "Address ID is Empty";
    print_r(json_encode($response));
    return false;
}
$user_id = $db->escapeString($_POST['user_id']);
$address_id = $db->escapeString($_POST['address_id']);
$sql = "UPDATE address SET default_address = 0 WHERE user_id = '" . $user_id . "'";
$db->sql($sql);

$sql = "UPDATE address SET default_address = 1 WHERE user_id = '" . $user_id . "' AND id =  '" . $address_id . "'";
$db->sql($sql);
$response['success'] = true;
$response['message'] = "Address Default Set Successfully";

print_r(json_encode($response));

?>