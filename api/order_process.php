<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../includes/custom-functions.php');
include_once('../includes/crud.php');
$db = new Database();
$db->connect();

$function = new custom_functions();
if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User ID is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['product_id'])) {
    $response['success'] = false;
    $response['message'] = "Product ID is Empty";
    print_r(json_encode($response));
    return false;
}
$items = $_POST['product_id'];
$user_id = $db->escapeString($_POST['user_id']);
$item_details = $function->get_product_by_id($items);
for ($i = 0; $i < count($item_details); $i++) {
    $product_id = $db->escapeString($item_details[$i]['id']);
    $sql = "INSERT INTO orders(`user_id`,`product_id`,`status`)VALUES('$user_id','$product_id','received')";
    $db->sql($sql);

}
$response['success'] = true;
$response['message'] = "Order Placed";
print_r(json_encode($response));
// $items = $_POST['product_id'];
// $items = stripslashes($items);
// $items = json_decode($items, 1);

// $cars = array();

// for ($i = 0; $i < count($items); $i++){
//     if($items[$i] == '12' || $items[$i] == '15'){
//         $cars[$i]=array($items[$i]);
//         $response['success'] = false;
//         $response['message'] = "Product ID is Empty".$cars[$i];
//         print_r(json_encode($response));

//     }
    

// }

// foreach ($cars as $it) {
//     // $response['success'] = false;
//     // $response['message'] = "Product ID is Empty".$it[1];
//     // print_r(json_encode($response));
    
    
    

// }
// $a=array('a','b','c');
//     foreach($a as $b){
//         $c = array();
//         for($i=0;$i<count($a);$i++){                
//             $c[$i]=$b;
//             $response['success'] = false;
//         $response['message'] = "Product ID is Empty".$c[$i];
//         print_r(json_encode($response));
//         }
        
//     }


?>