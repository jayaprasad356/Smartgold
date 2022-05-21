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

// if (!verify_token()) {
//     return false;
// }

// if (!isset($_POST['accesskey'])  || trim($_POST['accesskey']) != $access_key) {
//     $response['success'] = false;
//     $response['message'] = "No Accsess key found!";
//     print_r(json_encode($response));
//     return false;
//     exit();
// }
if (empty($_POST['address_id'])) {
    $response['success'] = false;
    $response['message'] = "Address Id is Empty";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User ID is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['name'])) {
    $response['success'] = false;
    $response['message'] = "Name is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['address'])) {
    $response['success'] = false;
    $response['message'] = "Address is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['area'])) {
    $response['success'] = false;
    $response['message'] = "Area is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['city'])) {
    $response['success'] = false;
    $response['message'] = "City is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['pincode'])) {
    $response['success'] = false;
    $response['message'] = "Pincode is Empty";
    print_r(json_encode($response));
    return false;
}

if (empty($_POST['landmark'])) {
    $landmark = $db->escapeString('');
}
else {
    $landmark = $db->escapeString($_POST['landmark']);
}
$user_id = $db->escapeString($_POST['user_id']);
$address_id = $db->escapeString($_POST['address_id']);
$name = $db->escapeString($_POST['name']);
$address = $db->escapeString($_POST['address']);

$area = $db->escapeString($_POST['area']);
$city = $db->escapeString($_POST['city']);
$pincode = $db->escapeString($_POST['pincode']);

$sql = "SELECT * FROM users WHERE id=$user_id";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num == 1) {
    $sql = "UPDATE address SET user_id='$user_id',name='$name',address='$address', landmark='$landmark', area='$area', city='$city', pincode='$pincode' WHERE id='$address_id'";
    $db->sql($sql);
    $res = $db->getResult();
    $sql = "SELECT * FROM address WHERE id=$address_id";
    $db->sql($sql);
    $res = $db->getResult();
    $response['success'] = true;
    $response['message'] = "Address Updated successfully";
    $response['data'] = $res;
    print_r(json_encode($response));

}
else {
    $response['success'] = false;
    $response['message'] = "User not found";
            
    $response['data'] = $res;
    print_r(json_encode($response));

}



?>