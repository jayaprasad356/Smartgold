<?php
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