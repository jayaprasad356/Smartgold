<?php
//session_save_path("../temp");
include_once('includes/crud.php');
$db = new Database();
$db->connect();
    $product_id = $_GET['id'];
    $sql_query = "DELETE FROM category WHERE id = '$product_id'";
    $db->sql($sql_query);
	header("location:categories.php");
