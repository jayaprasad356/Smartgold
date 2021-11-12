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

if (empty($_POST['name'])) {
    $response['success'] = false;
    $response['message'] = "Name should be filled!";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['email'])) {
    $response['success'] = false;
    $response['message'] = "Email should be filled!";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['mobile'])) {
    $response['success'] = false;
    $response['message'] = "Mobile Number should be filled!";
    print_r(json_encode($response));
    return false;
}
$mobile = $db->escapeString($_POST['mobile']);
$sql = "SELECT * FROM users WHERE mobile = '" . $mobile . "'";
    $db->sql($sql);
    $res = $db->getResult();
    $num = $db->numRows($res);
    if ($num == 1) {
        $response['success'] = false;
        $response['message'] = "Mobile number already registered";
        
        print_r(json_encode($response));

    }
    else {
        $name = $db->escapeString($_POST['name']);
        $email = $db->escapeString($_POST['email']);
        $mobile = $db->escapeString($_POST['mobile']);
        $sql = "INSERT INTO users(`name`,`email`, `mobile`)VALUES('$name','$email','$mobile')";
        $db->sql($sql);
        $res = $db->getResult();

        $sql = "SELECT * FROM users WHERE mobile = '" . $mobile . "'";
        $db->sql($sql);
        $res = $db->getResult();
        $response['success'] = true;
        $response['message'] = "User registered successfully";
        //$response['total'] = $total[0]['total'];
        $response['data'] = $res;
        print_r(json_encode($response));

    }

?>