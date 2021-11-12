<?php
session_start();
include('../includes/crud.php');
$db = new Database();
$db->connect();
$db->sql("SET NAMES 'utf8'");
include_once('../includes/functions.php');
$function = new functions;
include_once('../includes/custom-functions.php');
$fn = new custom_functions;

if (isset($_POST['add_seller']) && $_POST['add_seller'] == 1) {
    
    
    $name = $db->escapeString($_POST['name']);
    $email = $db->escapeString($_POST['email']);
    $mobile = $db->escapeString($_POST['mobile']);
    $store_url = (isset($_POST['store_url']) && $_POST['store_url'] != "") ? $db->escapeString($_POST['store_url']) : "";
    $password = $db->escapeString($_POST['password']);
    $password = md5($password);
    $store_name = $db->escapeString($_POST['store_name']);
    $street = (isset($_POST['street']) && $_POST['street'] != "") ? $db->escapeString($_POST['street']) : "";
    $pincode = $db->escapeString($_POST['pincode']);
    $city = $db->escapeString($_POST['city']);
    $state = (isset($_POST['state']) && $_POST['state'] != "") ? $db->escapeString($_POST['state']) : "";

    $account_number = (isset($_POST['account_number']) && $_POST['account_number'] != "") ? $db->escapeString($_POST['account_number']) : "";
    $bank_ifsc_code = (isset($_POST['ifsc_code']) && $_POST['ifsc_code'] != "") ? $db->escapeString($_POST['ifsc_code']) : "";
    $account_name = (isset($_POST['account_name']) && $_POST['account_name'] != "") ? $db->escapeString($_POST['account_name']) : "";
    $bank_name = (isset($_POST['bank_name']) && $_POST['bank_name'] != "") ? $db->escapeString($_POST['bank_name']) : "";
    $pan_number = $db->escapeString($_POST['pan_number']);
    
    $store_description = (isset($_POST['description']) && $_POST['description'] != "") ? $db->escapeString($_POST['description']) : "";
    
    $latitude = (isset($_POST['latitude']) && $_POST['latitude'] != "") ? $db->escapeString($_POST['latitude']) : "0";
    $longitude = (isset($_POST['longitude']) && $_POST['longitude'] != "") ? $db->escapeString($_POST['longitude']) : "0";
    $status = (isset($_POST['status']) && $_POST['status'] != "") ? $db->escapeString($_POST['status']) : "2";
    
    
    
    
    
   
    
    $sql = "SELECT id FROM seller WHERE mobile='$mobile'";
    $db->sql($sql);
    $res = $db->getResult();
    $count = $db->numRows($res);
    if ($count > 0) {
        echo '<label class="alert alert-danger">Mobile Number Already Exists!</label>';
        return false;
    }
    $target_path = '../upload/seller/';
    if (!is_dir($target_path)) {
        mkdir($target_path, 0777, true);
    }
    if ($_FILES['store_logo']['error'] == 0 && $_FILES['store_logo']['size'] > 0) {

        $extension = pathinfo($_FILES["store_logo"]["name"])['extension'];

        // $mimetype = mime_content_type($_FILES["store_logo"]["tmp_name"]);
        // if (!in_array($mimetype, array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'))) {
        //     echo " <span class='label label-danger'>Logo image type must jpg, jpeg, gif, or png!</span>";
        //     return false;
        //     exit();
        // }
        $result = $fn->validate_image($_FILES["store_logo"]);
        if ($result) {
            echo " <span class='label label-danger'>Logo image type must jpg, jpeg, gif, or png!</span>";
            return false;
            exit();
        }
        $filename = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $filename;
        if (!move_uploaded_file($_FILES["store_logo"]["tmp_name"], $full_path)) {
            echo "<p class='alert alert-danger'>Invalid directory to load image!</p>";
            return false;
        }
    }
    // address_proof national_id_card
    if ($_FILES['national_id_card']['error'] == 0 && $_FILES['national_id_card']['size'] > 0) {

        $extension = pathinfo($_FILES["national_id_card"]["name"])['extension'];

        // $mimetype = mime_content_type($_FILES["national_id_card"]["tmp_name"]);
        // if (!in_array($mimetype, array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'))) {
        //     echo " <span class='label label-danger'>National id card image type must jpg, jpeg, gif, or png!</span>";
        //     return false;
        //     exit();
        // }
        $result = $fn->validate_image($_FILES["national_id_card"]);
        if ($result) {
            echo " <span class='label label-danger'>National id card image type must jpg, jpeg, gif, or png!</span>";
            return false;
            exit();
        }
        $national_id_card = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $national_id_card;
        if (!move_uploaded_file($_FILES["national_id_card"]["tmp_name"], $full_path)) {
            echo "<p class='alert alert-danger'>Invalid directory to load image!</p>";
            return false;
        }
    }
    if ($_FILES['address_proof']['error'] == 0 && $_FILES['address_proof']['size'] > 0) {

        $extension = pathinfo($_FILES["address_proof"]["name"])['extension'];

        // $mimetype = mime_content_type($_FILES["address_proof"]["tmp_name"]);
        // if (!in_array($mimetype, array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'))) {
        //     echo " <span class='label label-danger'>Logo image type must jpg, jpeg, gif, or png!</span>";
        //     return false;
        //     exit();
        // }
        $result = $fn->validate_image($_FILES["address_proof"]);
        if ($result) {
            echo " <span class='label label-danger'>Address Proof card image type must jpg, jpeg, gif, or png!</span>";
            return false;
            exit();
        }
        $address_proof = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $address_proof;
        if (!move_uploaded_file($_FILES["address_proof"]["tmp_name"], $full_path)) {
            echo "<p class='alert alert-danger'>Invalid directory to load image!</p>";
            return false;
        }
    }

    $sql = "INSERT INTO `seller`(`name`, `store_name`,`email`, `mobile`, `password`, `store_url`, `logo`, `store_description`, `street`, `pincode`,`city`, `state`, `account_number`, `bank_ifsc_code`, `account_name`, `bank_name`, `status`,`national_identity_card`,`address_proof`,`pan_number`,`latitude`,`longitude`) VALUES ('$name','$store_name','$email', '$mobile', '$password','$store_url' ,'$filename', '$store_description', '$street','$pincode','$city','$state','$account_number','$bank_ifsc_code','$account_name','$bank_name','$status','$national_id_card','$address_proof','$pan_number','$latitude','$longitude')";
    if ($db->sql($sql)) {
        echo '<label class="alert alert-success">Seller Added Successfully!</label>';
    } else {
        echo '<label class="alert alert-danger">Some Error Occrred! please try again.</label>';
    }
}
?>