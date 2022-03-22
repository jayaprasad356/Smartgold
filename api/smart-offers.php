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

if (empty($_POST['latitude'])) {
    $response['success'] = false;
    $response['message'] = "latitude is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['longitude'])) {
    $response['success'] = false;
    $response['message'] = "longitude is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['budget_range_id'])) {
    $response['success'] = false;
    $response['message'] = "budget range is Empty";
    print_r(json_encode($response));
    return false;
}
if (empty($_POST['range_to'])) {
    $response['success'] = false;
    $response['message'] = "range is Empty";
    print_r(json_encode($response));
    return false;
}

$latitude = $db->escapeString($_POST['latitude']);
$longitude = $db->escapeString($_POST['longitude']);
$budget_range_id = $db->escapeString($_POST['budget_range_id']);
$range_to = $db->escapeString($_POST['range_to']);
$currentdate = new DateTime(date('Y-m-d'));
$cdate = $currentdate->format('Y-m-d');
$sql = "SELECT *,offers.description AS description FROM offers,seller,budget WHERE offers.seller_id = seller.id AND offers.budget_id = budget.id AND offers.budget_id = $budget_range_id AND offers.valid_date >= '$cdate' AND seller.valid >= '$cdate' AND offers.status = 1";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    
    $dataexist = false;
    foreach ($res as $row) 
    {
        $distance = round((((acos(sin(($latitude*pi()/180)) * sin(($row['latitude']*pi()/180))+cos(($latitude*pi()/180)) * cos(($row['latitude']*pi()/180)) * cos((($longitude- $row['longitude'])*pi()/180))))*180/pi())*60*1.1515*1.609344), 2);
        if($distance <= $range_to){
            $tempRow['nick_name'] = 'Reputed Shop';
            $tempRow['id'] = $row['id'];
            $tempRow['seller_id'] = $row['seller_id'];
            $tempRow['budget'] = $row['budget'];
            $tempRow['gram_price'] = $row['gram_price'];
            $tempRow['wastage'] = $row['wastage'];
            $tempRow['max_locked'] = $row['max_locked'];
            $tempRow['status'] = $row['status'];
            $tempRow['valid_date'] = $row['valid_date'];
            $tempRow['offer_details'] = $row['description'];
            
            $tempRow['distance'] = $distance;
            $rows[] = $tempRow;
            $dataexist = true;

        }


    }
    

    // usort($rows, function($a, $b) { //Sort the array using a user defined function
    //     return $a->distance > $b->distance ? -1 : 1; //Compare the scores
    // }); 
    function sortByDistance($a, $b) {
        return $a['distance'] > $b['distance'];
    }
    if($dataexist){
        usort($rows, 'sortByDistance');
        $response['success'] = true;
        $response['message'] = "Offers Retrieved Successfully";
        $response['data'] = $rows;
        print_r(json_encode($response));

    }
    else{
        $response['success'] = false;
        $response['message'] = "Not Found";
        $response['data'] = null;
        print_r(json_encode($response));

    }
    
                                                                                                                                                                                                           
    
    
    

}
else{
    $response['success'] = false;
    $response['message'] = "Not Found";
    $response['data'] = $res;
    print_r(json_encode($response));

}

?>