<?php
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

$latitude = $db->escapeString($_POST['latitude']);
$longitude = $db->escapeString($_POST['longitude']);
$budget_range_id = $db->escapeString($_POST['budget_range_id']);
$sql = "SELECT * FROM offers,seller,budget WHERE offers.seller_id = seller.id AND offers.budget_id = budget.id AND offers.budget_id = $budget_range_id";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);
if ($num >= 1) {
    $response['success'] = true;
    $response['message'] = "Offers Retrieved Successfully";
    


    foreach ($res as $row) 
    {
        $tempRow['nick_name'] = 'Reputed Shop';
        $tempRow['id'] = $row['id'];
        $tempRow['seller_id'] = $row['seller_id'];
        $tempRow['budget'] = $row['budget'];
        $tempRow['gram_price'] = $row['gram_price'];
        $tempRow['wastage'] = $row['wastage'];
        $tempRow['max_locked'] = $row['max_locked'];
        $tempRow['status'] = $row['status'];
        $tempRow['valid_date'] = $row['valid_date'];

        $distance = round((((acos(sin(($latitude*pi()/180)) * sin(($row['latitude']*pi()/180))+cos(($latitude*pi()/180)) * cos(($row['latitude']*pi()/180)) * cos((($longitude- $row['longitude'])*pi()/180))))*180/pi())*60*1.1515*1.609344), 2);
        $tempRow['distance'] = $distance;

        $rows[] = $tempRow;

    }
    

    // usort($rows, function($a, $b) { //Sort the array using a user defined function
    //     return $a->distance > $b->distance ? -1 : 1; //Compare the scores
    // }); 
    function sortByDistance($a, $b) {
        return $a['distance'] > $b['distance'];
    }
    usort($rows, 'sortByDistance');
                                                                                                                                                                                                           
    
    
    $response['data'] = $rows;
    print_r(json_encode($response));

}
else{
    $response['success'] = false;
    $response['message'] = "Not Found";
    $response['data'] = $res;
    print_r(json_encode($response));

}

?>