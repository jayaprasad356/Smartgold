<?php
session_start();

// set time for session timeout
$currentTime = time() + 25200;
$expired = 3600;
if (!isset($_SESSION['seller_id']) && !isset($_SESSION['seller_name'])) {
    header("location:index.php");
} else {
    $id = $_SESSION['seller_id'];
}

// if current time is more than session timeout back to login page
if ($currentTime > $_SESSION['timeout']) {
    session_destroy();
    header("location:index.php");
}

// destroy previous session timeout and create new one
unset($_SESSION['timeout']);
$_SESSION['timeout'] = $currentTime + $expired;

header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");



include_once('../includes/crud.php');

$db = new Database();
$db->connect();


//data of 'OFFERS' table goes here
if (isset($_GET['table']) && $_GET['table'] == 'offers') {
        


    $sql = "SELECT * FROM `offers` WHERE seller_id = '" . $id . "' ";
    $db->sql($sql);
    $res = $db->getResult();
    
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {
        $operate = ' <a href="edit-offer.php?id=' . $row['id'] . '"><i class="fa fa-edit"></i></a>'; 
        $operate .= '<a href="view-offer.php?id=' . $row['id'] . '" class="label label-primary" title="View">View Offer</a>';
    
        if($row['status'] == 0){
            $status = "Deactive";
        }
        else{
            $status = "active";
        }
        $currency = "Rs.";
        if($row['budget_id'] == 1){
            $budget = "upto 1 lakh";
        }
        else if($row['budget_id'] == 2){
            $budget = "1 lakh to 5 lakhs";
        }
        else if($row['budget_id'] == 3){
            $budget = "5 lakhs to 10 lakhs";
        }
        else if($row['budget_id'] == 4){
            $budget = "above 10 lakhs";
        }
        
        

        // $operate = '<a href="view-product-variants.php?id=' . $row['id'] . '" class="label label-success" title="View">View</a>';
        // $operate .= ' <a href="edit-product.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
        $locked = '<a href="offers_lock.php?id=' . $row['id'] . '" class="label label-success" title="View">View</a>';

        
        $tempRow['id'] = $row['id'];
        $tempRow['seller_id'] = $row['seller_id'];
        
        //$tempRow['seller_id'] = (!empty($row['seller_id'])) ? $row['seller_id'] : "";
        //$tempRow['budget_id'] = $row['budget_id'];
        $tempRow['gram_price'] = $currency . " " . $row['gram_price'];
        $tempRow['wastage'] = $row['wastage'];
        $tempRow['max_locked'] = $row['max_locked'];
        $tempRow['status'] = $status;
        $tempRow['valid_date'] = $row['valid_date'];
        $tempRow['budget_range'] = $budget;


        $tempRow['locked'] = $locked;
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
//data of 'ORDERS' table goes here
if (isset($_GET['table']) && $_GET['table'] == 'orders') {


    
    $sql = "SELECT *,orders.id AS id,orders.status AS status FROM orders LEFT JOIN products ON orders.product_id = products.id WHERE products.seller_id = '" . $id . "'";
    $db->sql($sql);
    $res = $db->getResult();
    
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {
        $operate = '<a href="view-order.php?id=' . $row['id'] . '" class="label label-primary" title="View">View Order</a>';
    
        $dc  = $row['date_created'];
        $dc = explode(" ", $dc); 
        
        $update = '<a href="updateorders.php?id=' . $row['id'] . '" class="label label-success" title="Update">Update Orders</a>';
        $tempRow['id'] = $row['id'];
        $tempRow['date_created'] = $dc[0];
        $tempRow['product_id'] = $row['product_id'];
        $tempRow['name'] = $row['name'];
        $tempRow['quantity'] = $row['quantity'];
        $tempRow['delivery_charges'] = $row['delivery_charges'];
        $tempRow['buy_method'] = $row['buy_method'];
        $tempRow['status'] = $row['status'];
        $tempRow['update'] = $update;
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
//data of 'LOCKOFFERS' table goes here
if (isset($_GET['table']) && $_GET['table'] == 'lockoffers') {
    $offerid = $_GET['offerid'];

    $sql = "SELECT *
    FROM users
    LEFT JOIN offer_lock
    ON users.id = offer_lock.user_id WHERE users.id = offer_lock.user_id AND offer_lock.offer_id = '" . $offerid . "' ";
    $db->sql($sql);
    $res = $db->getResult();
    
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {
        $operate = ' <a href="edit-offer-lock.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
        // $operate = '<a href="view-product-variants.php?id=' . $row['id'] . '" class="label label-success" title="View">View</a>';
        // $operate .= ' <a href="edit-product.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
        //$locked = '<a href="offers_lock.php?id=' . $row['id'] . '" class="label label-success" title="View">View</a>';

        
        
        
        $tempRow['name'] = $row['name'];
        $tempRow['mobile'] = $row['mobile'];
        $tempRow['email'] = $row['email'];
        $tempRow['operate'] = $operate;
        
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
//data of 'PRODUCTS' table goes here
if (isset($_GET['table']) && $_GET['table'] == 'products') {
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
        $where .= "WHERE name like '%" . $search . "%' OR gender like '%" . $search . "%' OR price like '%" . $search . "%' AND seller_id = $id";
    }
    else{
        $where .= "WHERE seller_id = $id";

    }
    if (isset($_GET['sort'])){
        $sort = $db->escapeString($_GET['sort']);

    }
    if (isset($_GET['order'])){
        $order = $db->escapeString($_GET['order']);

    }
    $sql = "SELECT COUNT(`id`) as total FROM `products` " . $where;
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row)
        $total = $row['total'];


    //$where .= "AND ''";
    //$sql = "SELECT *,products.id AS id,products.name AS name,category.name AS category_name FROM `products`,`category` " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;;
    
    $sql = "SELECT * FROM `products` " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;;
    $db->sql($sql);
    $res = $db->getResult();
    
    $bulkData = array();
    $bulkData['total'] = $total;
    
   
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {
        $currency = "Rs.";
        $operate = ' <a href="edit-product.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
        //$operate .= ' <a id="deleteproduct" class="btn btn-xs btn-danger" href="delete-product.php?id=' . $row['id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>&nbsp;';
        

        $discounted_price = $currency . " " . $row['discounted_price'];
        if($row['discounted_price'] == $row['price']){
            $discounted_price = "No Discount";
        } 

        
        $tempRow['id'] = $row['id'];
        $tempRow['seller_id'] = (!empty($row['seller_id'])) ? $row['seller_id'] : "";
        $tempRow['seller_name'] = (!empty($row['seller_name'])) ? $row['seller_name'] : "";
        $tempRow['name'] = $row['name'];
        $catid = $row['category_id'];
        $sql = "SELECT * FROM `category` WHERE id = $catid ";
        $db->sql($sql);
        $cat = $db->getResult();
        $tempRow['category_name'] = $cat[0]['name'];
        
        $tempRow['price'] = $currency . " " . $row['price'];
        

        $tempRow['status'] = ($row['status'] == 1)? "<label class='label label-success'>Active</label>": (($row['status'] == 0)? "<label class='label label-danger'>Deactive</label>": "<label class='label label-warning'>Deactive</label>");
        $tempRow['description'] = $row['description'];
        $tempRow['discounted_price'] = $discounted_price;
        $tempRow['weight'] = $row['weight'];
        $tempRow['gender'] = $row['gender'];
        $tempRow['image'] = "<a data-lightbox='product' href='" . DOMAIN_URL . $row['image'] . "' data-caption='" . $row['name'] . "'><img src='" . DOMAIN_URL . $row['image'] . "' title='" . $row['name'] . "' height='50' /></a>";
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}

// data of 'SUBCATEGORY' table goes here
if (isset($_GET['table']) && $_GET['table'] == 'subcategory') {

    $offset = 0;
    $limit = 10;
    $sort = 'id';
    $order = 'DESC';
    $where = '';
    if (isset($_GET['offset']))
        $offset = $db->escapeString($fn->xss_clean($_GET['offset']));
    if (isset($_GET['limit']))
        $limit = $db->escapeString($fn->xss_clean($_GET['limit']));

    if (isset($_GET['sort']))
        $sort = $db->escapeString($fn->xss_clean($_GET['sort']));
    if (isset($_GET['order']))
        $order = $db->escapeString($fn->xss_clean($_GET['order']));

    if (isset($_GET['search']) and $_GET['search'] != '') {
        $search = $db->escapeString($fn->xss_clean($_GET['search']));
        $where = " where (s.`id` like '%" . $search . "%' OR s.`name` like '%" . $search . "%')";
    }

    if (isset($_GET['category_id']) && $_GET['category_id'] != '') {
        $category_id = $db->escapeString($fn->xss_clean($_GET['category_id']));
        $where .= empty($where) ? " WHERE s.category_id = $category_id " : "AND s.category_id = $category_id ";
    }

    $sql1 = "SELECT categories FROM seller WHERE id = " . $id;
    $db->sql($sql1);
    $res1 = $db->getResult();

    $category_ids = explode(',', $res1[0]['categories']);
    $category_id = implode(',', $category_ids);

    if (empty($where)) {
        $where .= " WHERE s.category_id IN($category_id) ";
    } else {
        $where .= " ANd s.category_id IN($category_id) ";
    }

    $sql = "SELECT COUNT(s.id) as total FROM `subcategory` s" . $where;
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row)
        $total = $row['total'];

    $sql = "SELECT s.*,(SELECT name FROM category c WHERE c.id=s.category_id) as category_name FROM `subcategory` s" . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    $db->sql($sql);
    $res = $db->getResult();
    $bulkData = array();
    $bulkData['total'] = $total;
    $rows = array();
    $tempRow = array();

    foreach ($res as $row) {

        $operate = '<a href="view-subcategory-product.php?id=' . $row['id'] . '"><i class="fa fa-folder-open-o"></i>View Products</a>';

        $tempRow['id'] = $row['id'];
        $tempRow['name'] = $row['name'];
        $tempRow['category_name'] = $row['category_name'];
        $tempRow['subtitle'] = $row['subtitle'];
        $tempRow['image'] = "<a data-lightbox='category' href='" . DOMAIN_URL . $row['image'] . "' data-caption='" . $row['name'] . "'><img src='" . DOMAIN_URL . $row['image'] . "' title='" . $row['name'] . "' height='50' /></a>";
        $tempRow['operate'] = $operate;

        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}

function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'KB', 'MB', 'GB', 'TB');

    return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}
// data of 'MEDIA' table goes here
