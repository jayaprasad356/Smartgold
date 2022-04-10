<?php
session_start();
include_once('../includes/crud.php');
$db = new Database();
$db->connect();
$db->sql("SET NAMES 'utf8'");
include_once('../includes/functions.php');
$function = new functions; 
include_once('../includes/custom-functions.php');
$fn = new custom_functions;

if (!isset($_SESSION['seller_id']) && !isset($_SESSION['seller_name'])) {
        header("location:index.php");
} else {
        $ID = $_SESSION['seller_id'];
}

$expiryDate = $db->escapeString($_POST['expiryDate']);
$plan = $db->escapeString($_POST['plan']);

$sql = "UPDATE `seller` SET `valid`='$expiryDate',`plan`='$plan' WHERE id=" . $ID;
if ($db->sql($sql)) {
        $_SESSION['expiry_date'] = $expiryDate;
        echo 'Updated Successfully';
}
$data = [ 
        'user_id' => '1',
        'payment_id' => $_POST['razorpay_payment_id'],
        'amount' => $_POST['totalAmount'],
        'product_id' => $_POST['product_id'],
];

 // you can write your database insertation code here
 // after successfully insert transaction in database, pass the response accordingly
 $arr = array('msg' => 'Payment successfully credited', 'status' => true);  

 echo json_encode($arr);

?>

