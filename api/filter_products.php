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
if ($_POST['from_price_range'] == '') {
    $response['success'] = false;
    $response['message'] = "From Price Range is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['to_price_range'])) {
    $response['success'] = false;
    $response['message'] = "To Price Range is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['sort'])) {
    $response['success'] = false;
    $response['message'] = "Sort is Empty";
    print_r(json_encode($response));
    return false;
}
$from_price_range = $db->escapeString($_POST['from_price_range']);
$to_price_range = $db->escapeString($_POST['to_price_range']);
$sort = $db->escapeString($_POST['sort']);
$where = '';
$where .= "WHERE discounted_price > '$from_price_range' AND discounted_price < '$to_price_range'";
if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {
    $category_id = $db->escapeString($_POST['category_id']);
    $where .= "AND category_id = '$category_id'";
}
if (isset($_POST['gender']) && !empty($_POST['gender'])) {
    $gender = $db->escapeString($_POST['gender']);
    $where .= "AND gender = '$gender'";
}
if (isset($_POST['weight']) && !empty($_POST['weight'])) {
    $gender = $db->escapeString($_POST['weight']);
    $where .= "AND weight = '$gender'";
}

if ($sort == 1){
    $sql = "SELECT *,products.id AS id,products.name AS name FROM products LEFT JOIN seller ON products.seller_id = seller.id ".$where."  ORDER BY discounted_price ASC";

}
else {
    $sql = "SELECT *,products.id AS id,products.name AS name FROM products LEFT JOIN seller ON products.seller_id = seller.id WHERE discounted_price > $from_price_range AND discounted_price < $to_price_range ORDER BY discounted_price DESC";
}
    $db->sql($sql);
    $res = $db->getResult();
    $num = $db->numRows($res);
    if ($num >= 1) {
        foreach ($res as $row) {
            $temp['id'] = $row['id'];
            $temp['seller_id'] = $row['seller_id'];
            $temp['name'] = $row['name'];
            $temp['store_name'] = $row['store_name'];
        
            $temp['category_id'] = $row['category_id'];
           
            // $temp['image'] = array();
            $temp['image'] = DOMAIN_URL . $row['image'];
            $temp['gender'] = $row['gender'];
            $temp['weight'] = $row['weight'];
            // $temp['image'][1] = DOMAIN_URL . $row['image'];
            // $temp['image'][2] = DOMAIN_URL . $row['image'];
            $temp['description'] = $row['description'];
            $temp['discounted_price'] = $row['discounted_price'];
            $temp['price'] = $row['price'];
            
            $temp1[] = $temp;
        }
        $response['success'] = true;
        $response['message'] = "products Retrived Successfully";
        $response['data'] = $temp1;
        print_r(json_encode($response));
    
    }
    else{
        $response['success'] = false;
        $response['message'] = "products Not Found";
        $response['data'] = $res;
        print_r(json_encode($response));
    
    }




?>