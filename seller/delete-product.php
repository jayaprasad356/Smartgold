<?php
include"header.php";
include_once('../includes/functions.php');
date_default_timezone_set('Asia/Kolkata');
$function = new functions;
include_once('../includes/custom-functions.php');
$fn = new custom_functions;
if (!isset($_SESSION['seller_id']) && !isset($_SESSION['seller_name'])) {
    header("location:index.php");
} else {
    $ID = $_SESSION['seller_id'];
}
$product_id = $_GET['id'];
$sql_query = "DELETE FROM products WHERE id = '$product_id'";
$db->sql($sql_query);
header("location:products.php");
?>