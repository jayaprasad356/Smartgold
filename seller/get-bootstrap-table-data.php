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
    $offset = 0;
    $limit = 10;
    $where = '';
    $sort = 'id';
    $order = 'DESC';
    if (isset($_GET['limit']))
        $limit = $db->escapeString($_GET['limit']);
    if (isset($_GET['sort']))
        $sort = $db->escapeString($_GET['sort']);
    if (isset($_GET['order']))
        $order = $db->escapeString($_GET['order']);

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $db->escapeString($_GET['search']);
        $where .= "Where valid_date like '%" . $search . "%' OR gram_price like '%" . $search . "%' OR wastage like '%" . $search . "%' OR max_locked like '%" . $search . "%' OR valid_date like '%" . $search . "%' AND seller_id = $id";
    }
    else{
        $where .= "Where seller_id = $id";

    }
    if (isset($_GET['sort'])){
        $sort = $db->escapeString($_GET['sort']);

    }
    if (isset($_GET['order'])){
        $order = $db->escapeString($_GET['order']);

    }
    if (isset($_GET['offer_id']) && $_GET['offer_id'] != '') {
        $offer_id = $db->escapeString($_GET['offer_id']);
        $where .= ' AND id =' . $offer_id;
    }
    if (isset($_GET['budget_id']) && $_GET['budget_id'] != '') {
        $budget_id = $db->escapeString($_GET['budget_id']);
        $where .= ' AND budget_id =' . $budget_id;
    }
    if (isset($_GET['status']) && $_GET['status'] != '') {
        $status = $db->escapeString($_GET['status']);
        $where .= ' AND status =' . $status;
    }


    $sql = "SELECT COUNT(`id`) as total FROM `offers` " . $where;
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row)
        $total = $row['total'];

    $sql = "SELECT * FROM `offers` " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    $db->sql($sql);
    $res = $db->getResult();
    $bulkData = array();
    $bulkData['total'] = $total;
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {
        $operate = ' <a href="edit-offer.php?id=' . $row['id'] . '"><i class="fa fa-edit"></i></a>'; 
        //$operate .= '<a href="view-product.php?id=' . $row['id'] . '" class="label label-primary" title="View">View</a>';
        $tempRow['status'] = ($row['status'] == 1)? "<label class='text-success'>Active</label>": (($row['status'] == 0)? "<label class='text-danger'>Deactive</label>": "<label class='label label-warning'>Deactive</label>");
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
        else if($row['budget_id'] == 5){
            $budget = "Any Budget";
        }
        else{
            $budget = "Not Specified";
        }
        
        
        $locked = '<a href="offers_lock.php?id=' . $row['id'] . '" class="label label-primary" title="Show Locked Customers">Show Locked Customers</a>';
        $tempRow['id'] = $row['id'];
        $offerid = $row['id'];
        $sql = "SELECT * FROM offer_lock WHERE offer_id = '$offerid'";
        $db->sql($sql);
        $res = $db->getResult();
        $num = $db->numRows($res);
        $tempRow['total_locked_customers'] = $num;


        $tempRow['seller_id'] = $row['seller_id'];
        $tempRow['gram_price'] = $currency . " " . $row['gram_price'];
        $tempRow['wastage'] = $row['wastage'] . ' grams';
        $tempRow['max_locked'] = $row['max_locked'];
        $tempRow['valid_date'] = $row['valid_date'];
        $tempRow['claim_validity'] = $row['claim_validity'];
        $tempRow['budget_range'] = $budget;

        if ($num != 0) {
            $tempRow['locked'] = $locked;
        }
        else{
            $tempRow['locked'] = "No Locked Customers";
        }

        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }
    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
//data of 'ORDERS' table goes here
if (isset($_GET['table']) && $_GET['table'] == 'orders') {
    $offset = 0;
    $limit = 10;
    $where = '';
    $sort = 'orders.id';
    $order = 'DESC';
    if (isset($_GET['limit']))
        $limit = $db->escapeString($_GET['limit']);
    if (isset($_GET['sort']))
        $sort = $db->escapeString($_GET['sort']);
    if (isset($_GET['order']))
        $order = $db->escapeString($_GET['order']);

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $db->escapeString($_GET['search']);
        $where .= "WHERE orders.product_id = products.id AND products.name like '%" . $search ."%' OR orders.order_date like '%" . $search . "%' OR orders.quantity like '%" . $search . "%' OR orders.delivery_charges like '%" . $search . "%' AND orders.seller_id = $id";
        //$where .= "Where gram_price like '%" . $search . "%' OR wastage like '%" . $search . "%' OR max_locked like '%" . $search . "%' OR valid_date like '%" . $search . "%' AND seller_id = $id";
    }
    else{
        $where .= "WHERE orders.product_id = products.id AND orders.seller_id = '$id'";
    }
    if (isset($_GET['sort'])){
        $sort = $db->escapeString($_GET['sort']);
    }
    if (isset($_GET['order'])){
        $order = $db->escapeString($_GET['order']);
    }

    if (isset($_GET['product_id']) && $_GET['product_id'] != '') {
        $product_id = $db->escapeString($_GET['product_id']);
        $where .= ' AND orders.product_id =' . $product_id;
    }
    if (isset($_GET['order_id']) && $_GET['order_id'] != '') {
        $order_id = $db->escapeString($_GET['order_id']);
        $where .= ' AND orders.id =' . $order_id;
    }
    if (isset($_GET['buy_method']) && $_GET['buy_method'] != '') {
        $buy_method = $db->escapeString($_GET['buy_method']);
        $where .= ' AND orders.buy_method =' . $buy_method;
    }
    if (isset($_GET['payment_status']) && $_GET['payment_status'] != '') {
        $payment_status = $db->escapeString($_GET['payment_status']);
        $where .= " AND orders.payment_status = '$payment_status'";
        
    }
    if (isset($_GET['status']) && $_GET['status'] != '') {
        $status = $db->escapeString($_GET['status']);
        $where .= " AND orders.status = '$status'";
    }
    // $sql = "SELECT COUNT(`id`) as total FROM `orders` WHERE seller_id = '$id' ";
    // $db->sql($sql);
    // $res = $db->getResult();
    // foreach ($res as $row)
    //     $total = $row['total'];
    //$sql = "SELECT *,orders.id AS id,orders.status AS status FROM orders LEFT JOIN products ON orders.product_id = products.id WHERE products.seller_id = '" . $id . "'";
    $sql = "SELECT *,orders.id AS id,orders.status AS status FROM `orders`,`products` " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    
    $db->sql($sql);
    $res = $db->getResult();
    $num = $db->numRows($res);
    $total = $num;

    $bulkData = array();
    $bulkData['total'] = $total;
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {
        $operate = '<a href="view-order.php?id=' . $row['id'] . '" class="label label-primary" title="View">View</a>';
        $dc  = $row['date_created'];
        $dc = explode(" ", $dc); 
        if($row['status']!='Completed'){
            $update = '<a href="updateorders.php?id=' . $row['id'] . '" class="label  label-primary" title="Update">Update Orders</a>';
        }
        else{
            $update = '';
        }
        
        $tempRow['id'] = $row['id'];
        $tempRow['order_date'] = $row['order_date'];
        $tempRow['product_id'] = $row['product_id'];
        $tempRow['name'] = $row['name'];
        $tempRow['quantity'] = $row['quantity'];
        $tempRow['delivery_charges'] = $row['delivery_charges'];
        if($row['status'] == 'Cancelled'){
            $tempRow['status'] = $row['status'];

        }
        else if($row['status'] == 'Completed'){
            $tempRow['status'] = $row['status'];

        }
        else{
            $tempRow['status'] = $row['status'];

        }

        if($row['payment_status'] == 'Unpaid'){
            $tempRow['payment_status'] = $row['payment_status'];

        }
        else{
            $tempRow['payment_status'] = $row['payment_status'];

        }
        
        
        $tempRow['buy_method'] = ($row['buy_method'] == 1)? "<p>Pick Up at Store</p>": (($row['buy_method'] == 2)? "<p>Delivery at Home</p>": "<p>Delivery at Home</p>");
        
        // $tempRow['buy_method'] = $row['buy_method'];
        // $tempRow['status'] = $row['status'];
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
        $where .= "AND users.name like '%" . $search . "%' OR users.mobile like '%" . $search . "%'";
    }
    // else{
    //     $where .= "WHERE users.id = offer_lock.user_id ";
    // }
    if (isset($_GET['sort'])){
        $sort = $db->escapeString($_GET['sort']);

    }
    if (isset($_GET['order'])){
        $order = $db->escapeString($_GET['order']);
    }
    $sql = "SELECT COUNT(`id`) as total FROM offer_lock WHERE offer_id = '$offerid'";
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row)
        $total = $row['total'];

    $sql = "SELECT *,offer_lock.id AS id,offer_lock.lock_date AS lock_date FROM users LEFT JOIN offer_lock  ON users.id = offer_lock.user_id WHERE offer_lock.offer_id = '$offerid'" . $where ;
    $db->sql($sql);
    $res = $db->getResult();
    $bulkData = array();
    $bulkData['total'] = $total;
    
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {
        $operate = '<a href="edit-offer-lock.php?id=' . $row['id'] . '" class="label label-primary" title="Update">Update</a>';
        $viewoperate = '<a href="view-offer-lock.php?id=' . $row['id'] . '" class="label label-primary" title="View">View</a>';
        
        //$operate = ' <a href="edit-offer-lock.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
        // $operate = '<a href="view-product-variants.php?id=' . $row['id'] . '" class="label label-success" title="View">View</a>';
        // $operate .= ' <a href="edit-product.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
        //$locked = '<a href="offers_lock.php?id=' . $row['id'] . '" class="label label-success" title="View">View</a>';
        $tempRow['id'] = $row['id'];
        $tempRow['name'] = $row['name'];
        $tempRow['mobile'] = $row['mobile'];
        $tempRow['email'] = $row['email'];
        $tempRow['lock_date'] = $row['lock_date'];
        $tempRow['status'] = $row['status'];
        
        if($row['status'] == 'Offer Locked'){
            $tempRow['operate'] = $operate;

        }
        else{
            $tempRow['operate'] = $viewoperate;

        }
        
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
        $where .= "Where id like '%" . $search . "%' OR name like '%" . $search . "%' OR weight like '%" . $search . "%' OR price like '%" . $search . "%' OR discounted_price like '%" . $search . "%' AND seller_id = $id";
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
    if (isset($_GET['category_id']) && $_GET['category_id'] != '') {
        $category_id = $db->escapeString($_GET['category_id']);
        $where .= ' AND category_id =' . $category_id;
    }
    if (isset($_GET['status']) && $_GET['status'] != '') {
        $status = $db->escapeString($_GET['status']);
        $where .= ' AND status =' . $status;
    }

    if (isset($_GET['gender']) && $_GET['gender'] != '') {
        $gender = $db->escapeString($_GET['gender']);
        $where .= " AND gender = '$gender'";
    }
    $sql = "SELECT p.*,(SELECT name FROM category c WHERE c.id=p.category_id) as category_name FROM `products` p " . $where;
    $db->sql($sql);
    $res = $db->getResult();
    $num = $db->numRows($res);
    // foreach ($res as $row)
    //     $total = $row['total'];
    $sql = "SELECT p.*,(SELECT name FROM category c WHERE c.id=p.category_id) as category_name FROM `products` p " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    $db->sql($sql);
    $res = $db->getResult();

    $bulkData = array();
    $bulkData['total'] = $num;
    $rows = array();
    $tempRow = array();
    foreach ($res as $row) {
        $currency = "Rs.";
        $operate = ' <a href="edit-product.php?id=' . $row['id'] . '" title="Edit"><i class="fa fa-edit"></i></a>';
        //$operate .= '<a href="view-product.php?id=' . $row['id'] . '" class="label label-primary" title="View">View</a>';
    
        $discounted_price = $currency . " " . $row['discounted_price'];
        if($row['discounted_price'] == $row['price']){
            $discounted_price = "No Discount";
        } 

        
        $tempRow['id'] = $row['id'];
        $tempRow['seller_id'] = (!empty($row['seller_id'])) ? $row['seller_id'] : "";
        $tempRow['seller_name'] = (!empty($row['seller_name'])) ? $row['seller_name'] : "";
        $tempRow['name'] = $row['name'];
        $catid = $row['category_id'];
        $tempRow['category_name'] = $row['category_name'];
        
        $tempRow['price'] = $currency . " " . $row['price'];
        $tempRow['gst'] = $row['gst'];

        $tempRow['status'] = ($row['status'] == 1)? "<label class='text-success'>Active</label>": (($row['status'] == 0)? "<label class='text-danger'>Deactive</label>": "<label class='label label-warning'>Deactive</label>");
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


    // if (isset($_GET['category_id']) && $_GET['category_id'] != '') {
    //     $category_id = $db->escapeString($fn->xss_clean($_GET['category_id']));
    //     $where .= empty($where) ? " WHERE s.category_id = $category_id " : "AND s.category_id = $category_id ";
    // }

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
