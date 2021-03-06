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
//select s.* from offers p join seller s on s.id=p.seller_id
if (empty($_POST['user_id'])) {
    $response['success'] = false;
    $response['message'] = "User ID is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['seller_id'])) {
    $response['success'] = false;
    $response['message'] = "Seller ID is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['offer_id'])) {
    $response['success'] = false;
    $response['message'] = "Offer ID is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['paid_amt'])) {
    $response['success'] = false;
    $response['message'] = "Paid Amount is Empty";
    print_r(json_encode($response));
    return false;
}
$user_id = $db->escapeString($_POST['user_id']);
$offer_id = $db->escapeString($_POST['offer_id']);
$seller_id = $db->escapeString($_POST['seller_id']);
$paid_amt = $db->escapeString($_POST['paid_amt']);
$status = $db->escapeString('Locked');

$sql = "SELECT * FROM offer_lock WHERE offer_id='$offer_id'";
$db->sql($sql);
$res = $db->getResult();
$lockcount = $db->numRows($res);

$sql = "SELECT * FROM offers WHERE id='$offer_id'";
$db->sql($sql);
$res = $db->getResult();

$maxlocked = $res[0]['max_locked'];

if($maxlocked > $lockcount){
    $lock_date = date('Y-m-d h:i A');
    $sql = "INSERT INTO offer_lock(`user_id`,`offer_id`, `paid_amt`,`lock_date`,`status`)VALUES($user_id,$offer_id,$paid_amt,'$lock_date','Offer Locked')";
    $db->sql($sql);
    $res = $db->getResult();
    $sql = "SELECT * FROM offer_lock ORDER BY ID DESC";
    $db->sql($sql);
    $resoffer = $db->getResult();
    
    $sql = "SELECT *,offers.valid_date FROM `seller`,`offers` WHERE seller.id = offers.seller_id AND seller.id = '" . $seller_id . "'";
    $db->sql($sql);
    $res = $db->getResult();
    $num = $db->numRows($res);
    if ($num >= 1) {
        foreach ($res as $row) {
            $ref_id = 'smartgold_'.$resoffer[0]['id'];
            $temp['id'] = $ref_id;
            $temp['name'] = $row['name'];
            $temp['store_name'] = $row['store_name'];
            $temp['email'] = $row['email'];
            $temp['mobile'] = $row['mobile'];
            $temp['store_url'] = $row['store_url'];
            $temp['logo'] = $row['logo'];
            $temp['store_description'] = $row['store_description'];
            $temp['street'] = $row['street'];
            $temp['pincode'] = $row['pincode'];
            $temp['city'] = $row['city'];
            $temp['state'] = $row['state'];
            $temp['latitude'] = $row['latitude'];
            $temp['longitude'] = $row['longitude'];
            $temp['valid_till'] = $row['valid_date'];
            $temp1[] = $temp;
            
        }
        $response['success'] = true;
        $response['message'] = "Smart Gold is Locked Successfully";
        $response['data'] = $temp;
        print_r(json_encode($response));

    }
    else{
        
        $response['success'] = false;
        $response['message'] = "Smart Gold is not Locked";
        $response['data'] = $res;
        print_r(json_encode($response));
    }

}
else{
    $response['success'] = false;
    $response['message'] = "Maximum locked reached";
    print_r(json_encode($response));
}
?>