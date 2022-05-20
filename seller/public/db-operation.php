<?php
session_start();
include_once('../../includes/crud.php');
$db = new Database();
$db->connect();
$db->sql("SET NAMES 'utf8'");
include_once('../../includes/functions.php');
$function = new functions; 
include_once('../../includes/custom-functions.php');
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
    $pincode = (isset($_POST['pincode']) && $_POST['pincode'] != "") ? $db->escapeString($_POST['pincode']) : "";
    $city = (isset($_POST['city']) && $_POST['city'] != "") ? $db->escapeString($_POST['city']) : "";
    $state = (isset($_POST['state']) && $_POST['state'] != "") ? $db->escapeString($_POST['state']) : "";

    $account_number = (isset($_POST['account_number']) && $_POST['account_number'] != "") ? $db->escapeString($_POST['account_number']) : "";
    $bank_ifsc_code = (isset($_POST['ifsc_code']) && $_POST['ifsc_code'] != "") ? $db->escapeString($_POST['ifsc_code']) : "";
    $account_name = (isset($_POST['account_name']) && $_POST['account_name'] != "") ? $db->escapeString($_POST['account_name']) : "";
    $bank_name = (isset($_POST['bank_name']) && $_POST['bank_name'] != "") ? $db->escapeString($_POST['bank_name']) : "";
    $pan_number = $db->escapeString($_POST['pan_number']);
    $gst_number = $db->escapeString($_POST['gst_number']);
    
    $store_description = (isset($_POST['description']) && $_POST['description'] != "") ? $db->escapeString($_POST['description']) : "";
    
    $latitude = (isset($_POST['latitude']) && $_POST['latitude'] != "") ? $db->escapeString($_POST['latitude']) : "0";
    $longitude = (isset($_POST['longitude']) && $_POST['longitude'] != "") ? $db->escapeString($_POST['longitude']) : "0";
    $status = "2";
    
    
    
    
    
   
    
    $sql = "SELECT id FROM seller WHERE mobile='$mobile'";
    $db->sql($sql);
    $res = $db->getResult();
    $count = $db->numRows($res);
    if ($count > 0) {
        echo '<label class="alert alert-danger">Mobile Number Already Exists!</label>';
        return false;
    }
    $target_path = '../../upload/seller/';
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

    $sql = "INSERT INTO `seller`(`name`, `store_name`,`email`, `mobile`, `password`, `store_url`, `logo`, `store_description`, `street`, `pincode`,`city`, `state`, `account_number`, `bank_ifsc_code`, `account_name`, `bank_name`, `status`,`national_identity_card`,`address_proof`,`pan_number`,`gst_number`,`latitude`,`longitude`) VALUES ('$name','$store_name','$email', '$mobile', '$password','$store_url' ,'$filename', '$store_description', '$street','$pincode','$city','$state','$account_number','$bank_ifsc_code','$account_name','$bank_name','$status','$national_id_card','$address_proof','$pan_number','$gst_number','$latitude','$longitude')";
    if ($db->sql($sql)) {
        echo '<label class="alert alert-success">Seller Added Successfully!</label>';
    } else {
        echo '<label class="alert alert-danger">Some Error Occrred! please try again.</label>';
    }
}
if (isset($_POST['update_seller'])  && !empty($_POST['update_seller'])) {
    $id = $db->escapeString($_POST['update_id']);
    $name = $db->escapeString($_POST['name']);
    $store_name = $db->escapeString($_POST['store_name']);
    $mobile = $db->escapeString($_POST['mobile']);
    $email = $db->escapeString($_POST['email']);
    $pan_number = $db->escapeString($_POST['pan_number']);
    $store_description = (isset($_POST['description']) && $_POST['description'] != "") ? $db->escapeString($_POST['description']) : "";
    $store_url = (isset($_POST['store_url']) && $_POST['store_url'] != "") ? $db->escapeString($_POST['store_url']) : "";
    $street = (isset($_POST['street']) && $_POST['street'] != "") ? $db->escapeString($_POST['street']) : "";
    $city = (isset($_POST['city']) && $_POST['city'] != "") ? $db->escapeString($_POST['city']) : "";
    $state = (isset($_POST['state']) && $_POST['state'] != "") ? $db->escapeString($_POST['state']) : "";
    $account_number = (isset($_POST['account_number']) && $_POST['account_number'] != "") ? $db->escapeString($_POST['account_number']) : "";
    $bank_ifsc_code = (isset($_POST['ifsc_code']) && $_POST['ifsc_code'] != "") ? $db->escapeString($_POST['ifsc_code']) : "";
    $account_name = (isset($_POST['account_name']) && $_POST['account_name'] != "") ? $db->escapeString($_POST['account_name']) : "";
    $bank_name = (isset($_POST['bank_name']) && $_POST['bank_name'] != "") ? $db->escapeString($_POST['bank_name']) : "";
    // $latitude = (isset($_POST['latitude']) && $_POST['latitude'] != "") ? $db->escapeString($_POST['latitude']) : "0";
    // $longitude = (isset($_POST['longitude']) && $_POST['longitude'] != "") ? $db->escapeString($_POST['longitude']) : "0";
    $pincode = (isset($_POST['pincode']) && $_POST['pincode'] != "") ? $db->escapeString($_POST['pincode']) : "";
    

    $password = !empty($_POST['password']) ? $db->escapeString($_POST['password']) : '';
    $password = !empty($password) ? md5($password) : '';

    if ($_FILES['store_logo']['size'] != 0 && $_FILES['store_logo']['error'] == 0 && !empty($_FILES['store_logo'])) {
        //image isn't empty and update the image
        $old_logo = $db->escapeString($_POST['old_logo']);
        $extension = pathinfo($_FILES["store_logo"]["name"])['extension'];

        $result = $fn->validate_image($_FILES["store_logo"]);
        // if (!$result) {
        //     echo " <span class='label label-danger'>Logo image type must jpg, jpeg, gif, or png!</span>";
        //     return false;
        //     exit();
        // }
        $target_path = '../upload/seller/';
        $filename = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $filename;
        if (!move_uploaded_file($_FILES["store_logo"]["tmp_name"], $full_path)) {
            echo '<p class="alert alert-danger">Can not upload image.</p>';
            return false;
            exit();
        }
        if (!empty($old_logo)) {
            unlink($target_path . $old_logo);
        }
        $sql = "UPDATE seller SET `logo`='" . $filename . "' WHERE `id`=" . $id;
        $db->sql($sql);
    }
    if ($_FILES['national_id_card']['size'] != 0 && $_FILES['national_id_card']['error'] == 0 && !empty($_FILES['national_id_card'])) {
        //image isn't empty and update the image
        $old_national_identity_card = $db->escapeString($_POST['old_national_identity_card']);
        $extension = pathinfo($_FILES["national_id_card"]["name"])['extension'];

        // $result = $fn->validate_image($_FILES["national_id_card"]);
        // if (!$result) {
        //     echo " <span class='label label-danger'>National id card image type must jpg, jpeg, gif, or png!</span>";
        //     return false;
        //     exit();
        // }
        $target_path = '../upload/seller/';
        $national_id_card = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $national_id_card;
        if (!move_uploaded_file($_FILES["national_id_card"]["tmp_name"], $full_path)) {
            echo '<p class="alert alert-danger">Can not upload image.</p>';
            return false;
            exit();
        }
        if (!empty($old_national_identity_card)) {
            unlink($target_path . $old_national_identity_card);
        }
        $sql = "UPDATE seller SET `national_identity_card`='" . $national_id_card . "' WHERE `id`=" . $id;
        $db->sql($sql);
    }
    if ($_FILES['address_proof']['size'] != 0 && $_FILES['address_proof']['error'] == 0 && !empty($_FILES['address_proof'])) {
        //image isn't empty and update the image
        $old_address_proof = $db->escapeString($_POST['old_address_proof']);
        $extension = pathinfo($_FILES["address_proof"]["name"])['extension'];

        // $result = $fn->validate_image($_FILES["address_proof"]);
        // if (!$result) {
        //     echo " <span class='label label-danger'>Address Proof card image type must jpg, jpeg, gif, or png!</span>";
        //     return false;
        //     exit();
        // }
        $target_path = '../upload/seller/';
        $address_proof = microtime(true) . '.' . strtolower($extension);
        $full_path = $target_path . "" . $address_proof;
        if (!move_uploaded_file($_FILES["address_proof"]["tmp_name"], $full_path)) {
            echo '<p class="alert alert-danger">Can not upload image.</p>';
            return false;
            exit();
        }
        if (!empty($old_address_proof)) {
            unlink($target_path . $old_address_proof);
        }
        $sql = "UPDATE seller SET `address_proof`='" . $address_proof . "' WHERE `id`=" . $id;
        $db->sql($sql);
    }

    if (!empty($password)) {
        $sql = "UPDATE `seller` SET `name`='$name',`store_name`='$store_name',`email`='$email',`mobile`='$mobile',`password`='$password',`store_url`='$store_url',`store_description`='$store_description',`street`='$street',`pincode`='$pincode',`city`='$city',`state`='$state',`account_number`='$account_number',`bank_ifsc_code`='$bank_ifsc_code',`account_name`='$account_name',`bank_name`='$bank_name',`pan_number`='$pan_number' WHERE id=" . $id;
    } else {
        $sql = "UPDATE `seller` SET `name`='$name',`store_name`='$store_name',`email`='$email',`mobile`='$mobile',`store_url`='$store_url',`store_description`='$store_description',`street`='$street',`pincode`='$pincode',`city`='$city',`state`='$state',`account_number`='$account_number',`bank_ifsc_code`='$bank_ifsc_code',`account_name`='$account_name',`bank_name`='$bank_name',`pan_number`='$pan_number' WHERE id=" . $id;
    }
    if ($db->sql($sql)) {
        echo "<label class='alert alert-success'>Profile Updated Successfully.</label>";
    } else {
        echo "<label class='alert alert-danger'>Some Error Occurred! Please Try Again.</label>";
    }
}
if (isset($_POST['add_offer'])  && !empty($_POST['add_offer'])) {
    $ppg = (isset($_POST['pricegram']) && $_POST['pricegram'] != "") ? $db->escapeString($_POST['pricegram']) : "";
    $budget_id = $db->escapeString($_POST['budget_id']);
    $seller_id = $db->escapeString($_POST['seller_id']);
    $wastage = (isset($_POST['wastage']) && $_POST['wastage'] != "") ? $db->escapeString($_POST['wastage']) : "";
    $maxilock= $db->escapeString($_POST['maxilock']);
    $status = $db->escapeString($_POST['serve_for']);
    $valid = $db->escapeString($_POST['valid']);
    $description = $db->escapeString($_POST['description']);



    
    $error = array();


    if (empty($budget_id)) {
        echo " <span class='label label-danger'>Required!</span>";
    }
    if (empty($maxilock)) {
        echo  " <span class='label label-danger'>Required!</span>";
    }
    if (empty($status)) {
        echo " <span class='label label-danger'>Required!</span>";
    }
    if (empty($valid)) {
        echo " <span class='label label-danger'>Required!</span>";
    }
    if (empty($description)) {
        echo " <span class='label label-danger'>Required!</span>";
    }
    
    
    if (!empty($budget_id) && !empty($maxilock) && !empty($status) && !empty($valid) && !empty($description)) {

        

        // insert new data to product table
        $sql = "INSERT INTO offers (seller_id,budget_id,gram_price,wastage,max_locked,status,valid_date,description) VALUES('$seller_id','$budget_id','$ppg','$wastage','$maxilock','$status','$valid','$description')";
        $db->sql($sql);
        $product_result = $db->getResult();

        if (!empty($product_result)) {
            $product_result = 0;
        } else {
            $product_result = 1;
        }
        
        if ($product_result == 1 ) {
            echo '<label class="alert alert-success">Offer Added Successfully!</label>';
            return false;
        } else {
            echo " <span class='label label-danger'>Failed</span>";
            return false;
        }
    }
   
}
if (isset($_POST['add_product'])  && !empty($_POST['add_product'])) {
    $seller_id = $db->escapeString($_POST['seller_id']);
    $name = $db->escapeString($_POST['name']);
    $status = $db->escapeString($_POST['status']);
    $stock = $db->escapeString($_POST['stock']);
    $price= $db->escapeString($_POST['price']);
    $gender= $db->escapeString($_POST['gender']);
    $weight = (isset($_POST['weight']) && $_POST['weight'] != "") ? $db->escapeString($_POST['weight']) : 0;
    $discounted_price = (isset($_POST['discounted_price']) && $_POST['discounted_price'] != "") ? $db->escapeString($_POST['discounted_price']) : "";
    $category_id = $db->escapeString($_POST['category_id']);
    // get image info
    $image = $db->escapeString($_FILES['image']['name']);
    $image_error = $db->escapeString($_FILES['image']['error']);
    $image_type = $db->escapeString($_FILES['image']['type']);

    $description = $db->escapeString($_POST['description']);
    if($discounted_price == '0' || $discounted_price == ''){
        $discounted_price = $price;
    }

    $is_approved = 1;

    $error = array();

    if (empty($name)) {
        echo " <span class='label label-danger'>Required!</span>";
    }
    if (empty($category_id)) {
        echo " <span class='label label-danger'>Required!</span>";
    }
    if ($image_error > 0) {
        echo " <span class='label label-danger'>Not uploaded!</span>";
    }
    if (!empty($name) && !empty($category_id) && !empty($gender)   && empty($error['image'])) {

        // create random image file name
        $string = '0123456789';
        $file = preg_replace("/\s+/", "_", $_FILES['image']['name']);
        $extension = pathinfo($_FILES["image"]["name"])['extension'];

        $image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;

        // upload new image
        $upload = move_uploaded_file($_FILES['image']['tmp_name'], '../../upload/images/' . $image);

        $upload_image = 'upload/images/' . $image;

        // insert new data to product table
        $sql = "INSERT INTO products (name,seller_id,category_id,image,description,is_approved,status,price,discounted_price,stock,weight,gender) VALUES('$name','$seller_id','$category_id','$upload_image','$description','$is_approved','$status',$price,$discounted_price,$stock,$weight,'$gender')";
        $db->sql($sql);
        $product_result = $db->getResult();

        if (!empty($product_result)) {
            $product_result = 0;
        } else {
            $product_result = 1;
        }

        
        
        if ($product_result == 1 ) {
            echo '<label class="alert alert-success">Product Added Successfully!</label>';
        } else {
            echo " <span class='label label-danger'>Failed</span>";
        }
    }

}
?>