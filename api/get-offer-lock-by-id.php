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
$user_id = $db->escapeString($_POST['user_id']);
$sql = "SELECT *,ol.id AS id,ol.status AS status from offer_lock ol INNER JOIN offers o on ol.offer_id = o.id INNER JOIN seller s ON o.seller_id = s.id WHERE ol.user_id = '" . $user_id . "' ORDER BY ol.id DESC";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    foreach ($res as $row) {
        $offer_id = $row['offer_id'];
        $sql = "SELECT * FROM offer_lock WHERE offer_id='$offer_id'";
        $db->sql($sql);
        $res = $db->getResult();
        $lockcount = $db->numRows($res);

        $temp['id'] = 'smartgold_'.$row['id'];
        $temp['store_name'] = $row['store_name'];
        $temp['valid_date'] = $row['valid_date'];
        $temp['description'] = $row['description'];
        $temp['street'] = $row['street'];
        $temp['mobile'] = $row['mobile'];
        $temp['latitude'] = $row['latitude'];
        $temp['longitude'] = $row['longitude'];
        $temp['paid_amt'] = $row['paid_amt'];
        $temp['gram_price'] = $row['gram_price'];
        $temp['wastage'] = $row['wastage'];
        $temp['total_locked'] = $lockcount;

        $status = $row['status'];
        if($status == 0){
            $status = 'Offer Locked';
        }
        else{
            $sql = "SELECT id,title FROM offer_lock_status WHERE id='$status'";
            $db->sql($sql);
            $res = $db->getResult();
            $status = $res[0]['title'];

        }



        $temp['status'] = $status;
        
        
        $temp1[] = $temp;
    }
    $response['success'] = true;
    $response['message'] = "Locked Offer Successfully Retrived";
    $response['data'] = $temp1;
    print_r(json_encode($response));

}
else{
    
    $response['success'] = false;
    $response['message'] = "No Data Found";
    
    print_r(json_encode($response));

}




?>