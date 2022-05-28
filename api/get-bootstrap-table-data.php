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






if (isset($_GET['table']) && $_GET['table'] == 'customers') 
{
    $offset = 0;
    $limit = 10;
    $where = '';
    $sort = 'id';
    $order = 'DESC';
    if (isset($_GET['offset']))
        $offset = $db->escapeString($_GET['offset']);
    if (isset($_GET['limit']))
        $limit = $db->escapeString($_GET['limit']);
    if (isset($_GET['sort']))
        $sort = $db->escapeString($_GET['sort']);
    if (isset($_GET['order']))
        $order = $db->escapeString($_GET['order']);

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $db->escapeString($_GET['search']);
        $where .= "WHERE name like '%" . $search . "%' OR id like '%" . $search . "%' OR email like '%" . $search . "%' OR mobile like '%" . $search . "%' ";
    }
    if (isset($_GET['sort'])){
        $sort = $db->escapeString($_GET['sort']);

    }
    if (isset($_GET['order'])){
        $order = $db->escapeString($_GET['order']);

    }
    $sql = "SELECT COUNT(`id`) as total FROM `users` " . $where;
    $db->sql($sql);
    $res = $db->getResult();
   
    
    foreach ($res as $row)
        $total = $row['total'];
       
   
    //$sql = "SELECT * FROM users $where ORDER BY $sort $order";
    $sql = "SELECT * FROM users " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    $db->sql($sql);
    $res = $db->getResult();
    
    $bulkData = array();
    $bulkData['total'] = $total;
   
    
    $rows = array();
    $tempRow = array();

   
    
    foreach ($res as $row) {
        //$operate .= ' <a class="btn btn-xs btn-danger" href="delete-product.php?id=' . $row['product_variant_id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>&nbsp;';
        $operate = '<a href="view-customer.php?id=' . $row['id'] . '" class="label label-primary" title="View">View</a>';
        $user_id=$row['id'];
        $sql="SELECT * FROM offer_lock WHERE user_id=$user_id";
        $db->sql($sql);
        $res = $db->getResult();
        $offers_locked_count = $db->numRows($res);

        $user_id=$row['id'];
        $sql="SELECT * FROM orders WHERE user_id=$user_id";
        $db->sql($sql);
        $res = $db->getResult();
        $orders_purchased = $db->numRows($res);

        $tempRow['id'] = $row['id'];
        $tempRow['name'] = $row['name'];
        $tempRow['mobile'] = $row['mobile'];
        $tempRow['email'] = $row['email'];
        $tempRow['offers_locked_count'] = $offers_locked_count;
        $tempRow['orders_purchased'] = $orders_purchased;
        $tempRow['operate'] = $operate;
        
        
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
if (isset($_GET['table']) && $_GET['table'] == 'seller') {

    $offset = 0;
    $limit = 10;
    $where = '';
    $sort = 'id';
    $order = 'DESC';

    if (isset($_GET['offset']))
        $offset = $db->escapeString($_GET['offset']);
    if (isset($_GET['limit']))
        $limit = $db->escapeString($_GET['limit']);
    if (isset($_GET['sort']))
        $sort = $db->escapeString($_GET['sort']);
    if (isset($_GET['order']))
        $order = $db->escapeString($_GET['order']);

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $db->escapeString($_GET['search']);
        $where .= "AND name like '%" . $search . "%' OR id like '%" . $search . "%' OR email like '%" . $search . "%' OR mobile like '%" . $search . "%' OR store_name like '%" . $search . "%' OR store_url like '%" . $search . "%' OR store_description like '%" . $search . "%' OR street like '%" . $search . "%' OR pincode like '%" . $search . "%' OR city like '%" . $search . "%' OR state like '%" . $search . "%'";
    }
    if (isset($_GET['sort'])){
        $sort = $db->escapeString($_GET['sort']);

    }
    if (isset($_GET['order'])){
        $order = $db->escapeString($_GET['order']);

    }
    if (isset($_GET['status']) && $_GET['status'] != '') {
        $status = $db->escapeString($_GET['status']);
        $where .= " AND status = '$status' ";
    }
    if (isset($_GET['plan']) && $_GET['plan'] != '') {
        $plan = $db->escapeString($_GET['plan']);
        $where .= " AND plan = '$plan' ";
    }
    $sql = "SELECT COUNT(`id`) as total FROM `seller` WHERE ID IS NOT NULL " . $where;
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row)
        $total = $row['total'];


    $sql = "SELECT * FROM seller WHERE ID IS NOT NULL $where ORDER BY $sort $order";
    $db->sql($sql);
    $res = $db->getResult();
    
    $bulkData = array();
    $bulkData['total'] = $total;
    
    $rows = array();
    $tempRow = array();

   
    $path = 'upload/seller/';
    foreach ($res as $row) {
        $operate = ' <a href="edit-seller.php?id=' . $row['id'] . '"><i class="fa fa-edit"></i></a>'; 
        $dc  = $row['date_created'];
        $dc = explode(" ", $dc); 
        $tempRow['id'] = $row['id'];
        $tempRow['date_created'] = $dc[0];
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
        $tempRow['plan'] = $row['plan'];
        if ($row['status'] == 2)
            $tempRow['status'] = "<label class='text-primary'>Not-Approved</label>";
        else if ($row['status'] == 1)
            $tempRow['status'] = "<label class='text-success'>Approved</label>";
        else if ($row['status'] == 0)
            $tempRow['status'] = "<label style='color:brown;'>Deactive</label>";
        //$tempRow['status'] = $row['status'];
        $tempRow['address_proof'] = "<a data-lightbox='product' href='" . DOMAIN_URL . $path . $row['address_proof'] . "'><img src='" . DOMAIN_URL . $path . $row['address_proof'] . "' height='50' /></a>";
        $tempRow['national_identity_card'] = "<a data-lightbox='product' href='" . DOMAIN_URL . $path . $row['national_identity_card'] . "'><img src='" . DOMAIN_URL . $path . $row['national_identity_card'] . "' height='50' /></a>";
        $tempRow['pan_number'] = $row['pan_number'];
        $tempRow['latitude'] = $row['latitude'];
        $tempRow['longitude'] = $row['longitude'];
        $tempRow['operate'] = $operate;
        
         
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
// data of 'CATEGORY' table goes here
if (isset($_GET['table']) && $_GET['table'] == 'category') {

    $offset = 0;
    $limit = 10;
    $where = '';
    $sort = 'id';
    $order = 'DESC';
    if (isset($_GET['offset']))
        $offset = $db->escapeString($_GET['offset']);
    if (isset($_GET['limit']))
        $limit = $db->escapeString($_GET['limit']);
    if (isset($_GET['sort']))
        $sort = $db->escapeString($_GET['sort']);
    if (isset($_GET['order']))
        $order = $db->escapeString($_GET['order']);

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $db->escapeString($_GET['search']);
        $where .= "WHERE name like '%" . $search . "%' OR id like '%" . $search . "%'";
    }
    if (isset($_GET['sort'])){
        $sort = $db->escapeString($_GET['sort']);
    }
    if (isset($_GET['order'])){
        $order = $db->escapeString($_GET['order']);
    }
    $sql = "SELECT COUNT(`id`) as total FROM `category` ";
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row)
        $total = $row['total'];
   
    $sql = "SELECT * FROM category " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    $db->sql($sql);
    $res = $db->getResult();

    $bulkData = array();
    $bulkData['total'] = $total;
    
    $rows = array();
    $tempRow = array();

    foreach ($res as $row) {

        
        $operate = ' <a href="edit-category.php?id=' . $row['id'] . '"><i class="fa fa-edit"></i></a>';
        //$operate = ' <a class="btn-xs btn-danger" href="delete-category.php?id=' . $row['id'] . '"><i class="fa fa-trash-o"></i>Delete</a>';

        $tempRow['id'] = $row['id'];
        $tempRow['name'] = $row['name'];
        if(!empty($row['image'])){
            $tempRow['image'] = "<a data-lightbox='category' href='" . $row['image'] . "' data-caption='" . $row['name'] . "'><img src='" . $row['image'] . "' title='" . $row['name'] . "' height='50' /></a>";

        }else{
            $tempRow['image'] = 'No Image';

        }
        
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
if (isset($_GET['table']) && $_GET['table'] == 'offer_lock_status') {

    $offset = 0;
    $limit = 10;
    $where = '';
    $sort = 'id';
    $order = 'DESC';
    if (isset($_GET['offset']))
        $offset = $db->escapeString($_GET['offset']);
    if (isset($_GET['limit']))
        $limit = $db->escapeString($_GET['limit']);
    if (isset($_GET['sort']))
        $sort = $db->escapeString($_GET['sort']);
    if (isset($_GET['order']))
        $order = $db->escapeString($_GET['order']);

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $db->escapeString($_GET['search']);
        $where .= "WHERE title like '%" . $search ."%'";
    }
    if (isset($_GET['sort'])){
        $sort = $db->escapeString($_GET['sort']);
    }
    if (isset($_GET['order'])){
        $order = $db->escapeString($_GET['order']);
    }
    $sql = "SELECT COUNT(`id`) as total FROM `offer_lock_status` ";
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row)
        $total = $row['total'];
   
    $sql = "SELECT * FROM offer_lock_status " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    $db->sql($sql);
    $res = $db->getResult();

    $bulkData = array();
    $bulkData['total'] = $total;
    
    $rows = array();
    $tempRow = array();

    foreach ($res as $row) {

        
        $operate = ' <a href="edit-offer-lock-status.php?id=' . $row['id'] . '"><i class="fa fa-edit"></i></a>';
        //$operate = ' <a class="btn-xs btn-danger" href="delete-category.php?id=' . $row['id'] . '"><i class="fa fa-trash-o"></i>Delete</a>';

        $tempRow['id'] = $row['id'];
        $tempRow['title'] = $row['title'];
        
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
if (isset($_GET['table']) && $_GET['table'] == 'plans') {

    $offset = 0;
    $limit = 10;
    $where = '';
    $sort = 'id';
    $order = 'DESC';
    if (isset($_GET['offset']))
        $offset = $db->escapeString($_GET['offset']);
    if (isset($_GET['limit']))
        $limit = $db->escapeString($_GET['limit']);
    if (isset($_GET['sort']))
        $sort = $db->escapeString($_GET['sort']);
    if (isset($_GET['order']))
        $order = $db->escapeString($_GET['order']);

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $db->escapeString($_GET['search']);
        $where .= "WHERE title like '%" . $search ."%'";
    }
    if (isset($_GET['sort'])){
        $sort = $db->escapeString($_GET['sort']);
    }
    if (isset($_GET['order'])){
        $order = $db->escapeString($_GET['order']);
    }
    $sql = "SELECT COUNT(`id`) as total FROM `plans` ";
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row)
        $total = $row['total'];
   
    $sql = "SELECT * FROM plans " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    $db->sql($sql);
    $res = $db->getResult();

    $bulkData = array();
    $bulkData['total'] = $total;
    
    $rows = array();
    $tempRow = array();

    foreach ($res as $row) {

        
        $operate = ' <a href="edit-plan.php?id=' . $row['id'] . '"><i class="fa fa-edit"></i></a>';
        //$operate = ' <a class="btn-xs btn-danger" href="delete-category.php?id=' . $row['id'] . '"><i class="fa fa-trash-o"></i>Delete</a>';

        $tempRow['id'] = $row['id'];
        $tempRow['name'] = $row['name'];
        $tempRow['validity'] = $row['validity'];
        $tempRow['price'] = $row['price'];
        $tempRow['products'] = $row['products'];
        $tempRow['access'] = $row['access'];
        
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
if (isset($_GET['table']) && $_GET['table'] == 'admin') {

    $offset = 0;
    $limit = 10;
    $where = '';
    $sort = 'id';
    $order = 'DESC';
    if (isset($_GET['offset']))
        $offset = $db->escapeString($_GET['offset']);
    if (isset($_GET['limit']))
        $limit = $db->escapeString($_GET['limit']);
    if (isset($_GET['sort']))
        $sort = $db->escapeString($_GET['sort']);
    if (isset($_GET['order']))
        $order = $db->escapeString($_GET['order']);

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $db->escapeString($_GET['search']);
        $where .= "WHERE title like '%" . $search ."%'";
    }
    if (isset($_GET['sort'])){
        $sort = $db->escapeString($_GET['sort']);
    }
    if (isset($_GET['order'])){
        $order = $db->escapeString($_GET['order']);
    }
    $sql = "SELECT COUNT(`id`) as total FROM `admin` ";
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row)
        $total = $row['total'];
   
    $sql = "SELECT * FROM admin " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    $db->sql($sql);
    $res = $db->getResult();

    $bulkData = array();
    $bulkData['total'] = $total;
    
    $rows = array();
    $tempRow = array();

    foreach ($res as $row) {
        $operate = ' <a href="edit-admin-access.php?id=' . $row['id'] . '"><i class="fa fa-edit"></i></a>';
        $tempRow['id'] = $row['id'];
        $tempRow['name'] = $row['name'];
        $tempRow['email'] = $row['email'];
        $tempRow['role'] = $row['role'];
        
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}




$db->disconnect();
