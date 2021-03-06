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
$name = $db->escapeString($_POST['name']);
$address = $db->escapeString($_POST['address']);

$area = $db->escapeString($_POST['area']);
$city = $db->escapeString($_POST['city']);
$pincode = $db->escapeString($_POST['pincode']);

$sql = "SELECT * FROM address WHERE user_id = '" . $user_id . "'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    $sql = "INSERT INTO address(`user_id`,`name`,`address`, `landmark`, `area`, `city`, `pincode`)VALUES('$user_id','$name','$address','$landmark','$area','$city','$pincode')";
    $db->sql($sql);
    $res = $db->getResult();
    $response['success'] = true;
    $response['message'] = "Address added successfully";

    $response['data'] = $res;
    print_r(json_encode($response));

}
else {
    $sql = "INSERT INTO address(`user_id`,`name`,`address`, `landmark`, `area`, `city`, `pincode`, `default_address`)VALUES('$user_id','$name','$address','$landmark','$area','$city','$pincode',1)";
    $db->sql($sql);
    $res = $db->getResult();
    $response['success'] = true;
    $response['message'] = "Address added successfully";
            
    $response['data'] = $res;
    print_r(json_encode($response));

}



?>