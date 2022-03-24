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
$currentdate = new DateTime(date('Y-m-d'));
$cdate = $currentdate->format('Y-m-d');
if (empty($_POST['latitude']) || empty($_POST['longitude']) || empty($_POST['range_to'])) {

    $sql = "SELECT * FROM seller WHERE valid >= '$cdate' AND status = 1";
    $db->sql($sql);
    $res = $db->getResult();
    $num = $db->numRows($res);
    if ($num >= 1) {
        foreach ($res as $row) {
            $temp['id'] = $row['id'];
            $temp['name'] = $row['name'];
            $temp['store_name'] = $row['store_name'];
            $temp['logo'] = DOMAIN_URL . $row['logo'];
            $temp1[] = $temp;

        }
        
        $response['success'] = true;
        $response['message'] = "Sellers Retrived Successfully";
        $response['data'] = $temp1;
        print_r(json_encode($response));

    }
    else{
        $response['success'] = false;
        $response['message'] = "Sellers Not Found";
        $response['data'] = $res;
        print_r(json_encode($response));

    }
    return false;

}
if (!empty($_POST['latitude']) && !empty($_POST['longitude']) && !empty($_POST['range_to'])){
    $latitude = $db->escapeString($_POST['latitude']);
    $longitude = $db->escapeString($_POST['longitude']);
    $range_to = $db->escapeString($_POST['range_to']);
    $sql = "SELECT * FROM seller WHERE valid >= '$cdate' AND status = 1";
    $db->sql($sql);
    $res = $db->getResult();
    $num = $db->numRows($res);
    if ($num >= 1) {
        $dataexist = false;
        foreach ($res as $row) {
            $distance = round((((acos(sin(($latitude*pi()/180)) * sin(($row['latitude']*pi()/180))+cos(($latitude*pi()/180)) * cos(($row['latitude']*pi()/180)) * cos((($longitude- $row['longitude'])*pi()/180))))*180/pi())*60*1.1515*1.609344), 2);
            if($distance <= $range_to){
                $temp['id'] = $row['id'];
                $temp['name'] = $row['name'];
                $temp['store_name'] = $row['store_name'];
                $temp['logo'] = DOMAIN_URL .'upload/seller/'. $row['logo'];
                $temp['distance'] = $distance;
                $temp1[] = $temp;
                $dataexist = true;
                

            }

        }
        function sortByDistance($a, $b) {
            return $a['distance'] > $b['distance'];
        }
        if($dataexist){
            usort($temp1, 'sortByDistance');
            $response['success'] = true;
            $response['message'] = "Sellers Retrived Successfully";
            $response['data'] = $temp1;
            print_r(json_encode($response));
    
        }
        else{
            $response['success'] = false;
            $response['message'] = "Sellers Not Found";
            $response['data'] = null;
            print_r(json_encode($response));
    
        }
    

    }
    else{
        $response['success'] = false;
        $response['message'] = "Sellers Not Found";
        $response['data'] = $res;
        print_r(json_encode($response));

    }
    return false;



}




?>