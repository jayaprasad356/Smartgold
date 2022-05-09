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
include_once('send-email.php');
$db = new Database();
$db->connect();


$to = 'jandraid0.1@gmail.com';
$subject = 'Test';
$item_data1 = '';
$order_data = '';
send_smtp_mail($to, $subject, $item_data1, $order_data);


?>