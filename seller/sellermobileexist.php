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

if (empty($_POST['mobile'])) {
    echo "fail";
}
$mobile = $db->escapeString($_POST['mobile']);
$sql = "SELECT * FROM seller WHERE mobile = '" . $mobile . "'";
    $db->sql($sql);
    $res = $db->getResult();
    $num = $db->numRows($res);
    if ($num == 1) {
        echo "registered";

    }
    else {
        echo "success";


    }

?>