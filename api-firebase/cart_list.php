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

if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User ID is Empty";
    print_r(json_encode($response));
    return false;
}
$user_id = $db->escapeString($_POST['user_id']);
$sql = "SELECT *,cart.id,products.id AS product_id
FROM cart
LEFT JOIN products
ON cart.product_id = products.id WHERE user_id ='" . $user_id . "'";
//$sql = "SELECT * FROM products,cart WHERE products.id = cart.product_id AND cart.user_id = '" . $user_id . "'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $temp['id'] = $row['id'];
        $temp['product_id'] = $row['product_id'];
        $temp['name'] = $row['name'];
        $temp['category_id'] = $row['category_id'];
        $temp['description'] = $row['description'];
        $temp['quantity'] = $row['quantity'];
        $temp['image'] = DOMAIN_URL . $row['image'];
        $temp['discounted_price'] = $row['quantity'] * $row['discounted_price'];
        $temp['price'] = $row['quantity'] * $row['price'];
        $rows[] = $temp;

    }
    $response['success'] = true;
    $response['message'] = "Cart Retrived Successfully";
    $response['data'] = $rows;
    print_r(json_encode($response));

}
else{
    $response['success'] = false;
    $response['message'] = "Cart Not Found";
    $response['data'] = $res;
    print_r(json_encode($response));

}




?>