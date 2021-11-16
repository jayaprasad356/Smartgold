<?php
session_start();

// set time for session timeout
$currentTime = time() + 25200;
$expired = 3600;

// // if session not set go to login page
// if (!isset($_SESSION['user'])) {
//     header("location:index.php");
// }

// // if current time is more than session timeout back to login page
// if ($currentTime > $_SESSION['timeout']) {
//     session_destroy();
//     header("location:index.php");
// }

// destroy previous session timeout and create new one
unset($_SESSION['timeout']);
$_SESSION['timeout'] = $currentTime + $expired;

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






if (isset($_GET['table']) && $_GET['table'] == 'customers') {
    
   
    $sql = "SELECT * FROM users";
    $db->sql($sql);
    $res = $db->getResult();
    
    $bulkData = array();
    
    $rows = array();
    $tempRow = array();

   
    
    foreach ($res as $row) {
        //$operate .= ' <a class="btn btn-xs btn-danger" href="delete-product.php?id=' . $row['product_variant_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>&nbsp;';
        
        $tempRow['id'] = $row['id'];
        $tempRow['name'] = $row['name'];
        $tempRow['mobile'] = $row['mobile'];
        $tempRow['email'] = $row['email'];
        
         
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
if (isset($_GET['table']) && $_GET['table'] == 'seller') {
    
   
    $sql = "SELECT * FROM seller";
    $db->sql($sql);
    $res = $db->getResult();
    
    $bulkData = array();
    
    $rows = array();
    $tempRow = array();

   
    $path = 'upload/seller/';
    foreach ($res as $row) {
        //$operate .= ' <a class="btn btn-xs btn-danger" href="delete-product.php?id=' . $row['product_variant_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>&nbsp;';
        
        $tempRow['id'] = $row['id'];
        $tempRow['name'] = $row['name'];
        $tempRow['mobile'] = $row['mobile'];
        $tempRow['email'] = $row['email'];
        $tempRow['store_name'] = $row['store_name'];
        $tempRow['store_url'] = $row['store_url'];
        $tempRow['logo'] = "<a data-lightbox='product' href='" . DOMAIN_URL . $path . $row['logo'] . "'><img src='" . DOMAIN_URL . $path . $row['logo'] . "' height='50' /></a>";
        
        
        $tempRow['store_description'] = $row['store_description'];
        $tempRow['street'] = $row['street'];
        $tempRow['pincode'] = $row['pincode'];
        $tempRow['city'] = $row['city'];
        $tempRow['state'] = $row['state'];
        $tempRow['account_number'] = $row['account_number'];
        $tempRow['bank_name'] = $row['bank_name'];
        $tempRow['bank_ifsc_code'] = $row['bank_ifsc_code'];
        $tempRow['account_name'] = $row['account_name'];
        $tempRow['status'] = $row['status'];
        $tempRow['address_proof'] = "<a data-lightbox='product' href='" . DOMAIN_URL . $path . $row['address_proof'] . "'><img src='" . DOMAIN_URL . $path . $row['address_proof'] . "' height='50' /></a>";
        $tempRow['national_identity_card'] = "<a data-lightbox='product' href='" . DOMAIN_URL . $path . $row['national_identity_card'] . "'><img src='" . DOMAIN_URL . $path . $row['national_identity_card'] . "' height='50' /></a>";
        $tempRow['pan_number'] = $row['pan_number'];
        $tempRow['latitude'] = $row['latitude'];
        $tempRow['longitude'] = $row['longitude'];
        
         
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
// data of 'CATEGORY' table goes here
if (isset($_GET['table']) && $_GET['table'] == 'category') {

    $offset = 0;
    $limit = 10;
    $sort = 'id';
    $order = 'DESC';
    $where = '';
    


    $sql = "SELECT * FROM `category`";
    $db->sql($sql);
    $res = $db->getResult();

    
    $rows = array();
    $tempRow = array();

    foreach ($res as $row) {

        
        $operate = ' <a href="edit-category.php?id=' . $row['id'] . '"><i class="fa fa-edit"></i>Edit</a>';
        $operate .= ' <a class="btn-xs btn-danger" href="delete-category.php?id=' . $row['id'] . '"><i class="fa fa-trash-o"></i>Delete</a>';

        $tempRow['id'] = $row['id'];
        $tempRow['name'] = $row['name'];
        
        $tempRow['image'] = "<a data-lightbox='category' href='" . $row['image'] . "' data-caption='" . $row['name'] . "'><img src='" . $row['image'] . "' title='" . $row['name'] . "' height='50' /></a>";
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
// data of 'Sellers Nickename' table goes here
if (isset($_GET['table']) && $_GET['table'] == 'nickname') {

    


    $sql = "SELECT * FROM `nickname`";
    $db->sql($sql);
    $res = $db->getResult();

    
    $rows = array();
    $tempRow = array();

    foreach ($res as $row) {

        
        
        $tempRow['id'] = $row['id'];
        $tempRow['name'] = $row['nickname'];
        
    
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
// data of 'Price/Duration' table goes here
if (isset($_GET['table']) && $_GET['table'] == 'settings') {

    


    $sql = "SELECT * FROM `settings`";
    $db->sql($sql);
    $res = $db->getResult();

    
    $rows = array();
    $tempRow = array();

    foreach ($res as $row) {

        
        
        $tempRow['id'] = $row['id'];
        $tempRow['price'] = $row['price'];
        $tempRow['days'] = $row['days'];
        
    
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
// data of 'banners' table goes here
if (isset($_GET['table']) && $_GET['table'] == 'banners') {

    $offset = 0;
    $limit = 10;
    $sort = 'id';
    $order = 'DESC';
    $where = '';
    


    $sql = "SELECT * FROM `banners`";
    $db->sql($sql);
    $res = $db->getResult();

    
    $rows = array();
    $tempRow = array();

    foreach ($res as $row) {

        
        

        $tempRow['id'] = $row['id'];
        
        $tempRow['image'] = "<a data-lightbox='category' href='" . $row['imgUrl'] . "' data-caption='" . $row['id'] . "'><img src='" . $row['imgUrl'] . "' title='" . $row['id'] . "' height='50' /></a>";
       
        $rows[] = $tempRow;
        
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}



$db->disconnect();
