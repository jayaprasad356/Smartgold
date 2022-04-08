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


    $sql = "SELECT * FROM `products` WHERE seller_id = '" . $id . "' ";
    $db->sql($sql);
    $res = $db->getResult();
    
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {
        $currency = "Rs.";
        
        

        // $operate = '<a href="view-product-variants.php?id=' . $row['id'] . '" title="View"><i class="fa fa-folder-open"></i></a>';
        // $operate .= ' <a href="edit-product.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';

        $operate = ' <a href="edit-product.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
        $operate .= ' <a id="deleteproduct" class="btn btn-xs btn-danger" href="delete-product.php?id=' . $row['id'] . '" title="Delete"><i class="fa fa-trash-o"></i></a>&nbsp;';
        

        
        $tempRow['id'] = $row['id'];
        $tempRow['seller_id'] = (!empty($row['seller_id'])) ? $row['seller_id'] : "";
        $tempRow['seller_name'] = (!empty($row['seller_name'])) ? $row['seller_name'] : "";
        $tempRow['name'] = $row['name'];
        
        $tempRow['price'] = $currency . " " . $row['price'];
        

        $tempRow['is_approved'] = ($row['is_approved'] == 1)
            ? "<label class='label label-success'>Approved</label>"
            : (($row['is_approved'] == 2)
                ? "<label class='label label-danger'>Not-Approved</label>"
                : "<label class='label label-warning'>Not-Processed</label>");
        $tempRow['description'] = $row['description'];
        $tempRow['discounted_price'] = $currency . " " . $row['discounted_price'];
        $tempRow['status'] = $row['status'] == 'Sold Out' ? "<span class='label label-danger'>Sold Out</label>" : "<span class='label label-success'>Available</label>";
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
