<?php
include_once('../includes/functions.php');
date_default_timezone_set('Asia/Kolkata');
$function = new functions;
include_once('../includes/custom-functions.php');
$fn = new custom_functions;
// session_start();
if (!isset($_SESSION['seller_id']) && !isset($_SESSION['seller_name'])) {
    header("location:index.php");
} else {
    $ID = $_SESSION['seller_id'];
}
$product_id = $_GET['id'];

if (isset($_POST['btnUpdate'])) {
    $seller_id = $ID;
    $name = $db->escapeString($_POST['name']);
    $status = $db->escapeString($_POST['status']);
    $stock = $db->escapeString($_POST['stock']);
    $price= $db->escapeString($_POST['price']);
    $discounted_price = $db->escapeString($_POST['discounted_price']);
    $category_id = $db->escapeString($_POST['category_id']);
    $gender= $db->escapeString($_POST['gender']);
    $weight= $db->escapeString($_POST['weight']);
    
    // get image info
    $image = $db->escapeString($_FILES['image']['name']);
    $image_error = $db->escapeString($_FILES['image']['error']);
    $image_type = $db->escapeString($_FILES['image']['type']);

    $description = $db->escapeString($_POST['description']);

    $is_approved = (isset($_POST['is_approved']) && $_POST['is_approved'] != '') ? $db->escapeString($_POST['is_approved']) : 1;

    $error = array();

    if (empty($name)) {
        $error['name'] = " <span class='label label-danger'>Required!</span>";
    }

    

    if (empty($category_id)) {
        $error['category_id'] = " <span class='label label-danger'>Required!</span>";
    }

    if (empty($description)) {
        $error['description'] = " <span class='label label-danger'>Required!</span>";
    }

    // common image file extensions
    $allowedExts = array("gif", "jpeg", "jpg", "png");

    // get image file extension
    error_reporting(E_ERROR | E_PARSE);
    $extension = end(explode(".", $_FILES["image"]["name"]));
    // if (!empty($image)) {
    //     // $mimetype = mime_content_type($_FILES["image"]["tmp_name"]);
    //     // if (!in_array($mimetype, array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'))) {
    //     //     $error['image'] = " <span class='label label-danger'>Image type must jpg, jpeg, gif, or png!</span>";
    //     // }
    //     $result = $fn->validate_image($_FILES["image"]);
    //     if (!$result) {
    //         $error['image'] = " <span class='label label-danger'>Image type must jpg, jpeg, gif, or png!</span>";
    //     }
    // }


    if (!empty($name) && !empty($category_id)   && empty($error['image'])) {

        
        if (!empty($image)){
            // create random image file name
            $string = '0123456789';
            $file = preg_replace("/\s+/", "_", $_FILES['image']['name']);

            $image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;

            // upload new image
            $upload = move_uploaded_file($_FILES['image']['tmp_name'], '../upload/images/' . $image);
            $upload_image = 'upload/images/' . $image;
            $sql_query = "UPDATE products SET name = '$name' ,seller_id= '$seller_id',category_id= '$category_id',image = '$upload_image',description = '$description' ,is_approved = '$is_approved' ,status = '$status' , price = '$price', discounted_price = '$discounted_price', stock = '$stock', gender = '$gender', weight = '$weight' WHERE id = $product_id";
            

        }
        else{
            $sql_query = "UPDATE products SET name = '$name' ,seller_id= '$seller_id',category_id= '$category_id',description = '$description' ,is_approved = '$is_approved' ,status = '$status' , price = '$price', discounted_price = '$discounted_price', stock = '$stock', gender = '$gender', weight = '$weight' WHERE id = $product_id";
            

        }
        $db->sql($sql_query);
        $error['update_data'] = "<span class='label label-success'>Product updated Successfully</span>";
        
        

        
    }

    

}
$sql_query = "SELECT * FROM products WHERE id = '" . $product_id . "'";
$db->sql($sql_query);

$res = $db->getResult();
$sql_query = "SELECT id, name FROM category";
$db->sql($sql_query);

$rescat = $db->getResult();
?>
<section class="content-header">
    <h1>Edit Product</h1>
    <small><?php echo isset($error['update_data']) ? $error['update_data'] : ''; ?></small>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>

</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Product</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='add_product_form' method="post" enctype="multipart/form-data">
                    
                    <div class="box-body">
                        <div class="form-group">
                                <label for="exampleInputEmail1">Product Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['name']) ? $error['name'] : ''; ?>
                                <input type="text" class="form-control" name="name" value="<?php echo $res[0]['name'] ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="serve_for">Status :</label>
                                <select name="serve_for" class="form-control" required>
                                    <option value="Available" <?php if ($res[0]['status'] == "Available") {echo "selected";} ?>>Available</option>
                                    <option value="Sold Out" <?php if ($res[0]['status'] == "Sold Out") {
                                                                                    echo "selected";
                                                                                } ?>>Sold Out</option>
                                    <option value="Not Available" <?php if ($res[0]['status'] == "Not Available") {
                                                                                    echo "selected";
                                                                                } ?>>Not Available</option>
                                </select>

                            </div>
                            <div class="col-md-6">
                                    <div class="form-group packate_div">
                                        <label for="qty">Stock:</label> <i class="text-danger asterik">*</i>
                                        <input type="number" step="any" min="0" class="form-control" name="stock" required="" value="<?php echo $res[0]['stock'] ?>" />
                                    </div>
                            </div>

                        </div>
                    
                        
                        
                        
                        
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group packate_div">
                                        <label for="price">Price (₹):</label> <i class="text-danger asterik">*</i><input type="number" step="any" min='0' class="form-control" name="price" id="price" value="<?php echo $res[0]['price'] ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group packate_div">
                                        <label for="discounted_price">Discounted Price(₹):</label>
                                        <input type="number" step="any" min='0' class="form-control" name="discounted_price" value="<?php echo $res[0]['discounted_price'] ?>" id="discounted_price" />
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                    <label for="gender">Gender :</label><i class="text-danger asterik">*</i>
                                    <select name="gender" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Male" <?php if ($res[0]['gender'] == "Male") {
                                                                                    echo "selected";
                                                                                } ?>>Male</option>
                                        <option value="Female" <?php if ($res[0]['gender'] == "Female") {
                                                                                    echo "selected";
                                                                                } ?>>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group packate_div">
                                        <label for="weight">Weight :</label><i class="text-danger asterik">*</i>
                                        <input type="number" step="any" min='0' class="form-control" name="weight" required value="<?php echo $res[0]['weight'] ?>" id="weight" />
                                    </div>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category :</label> <i class="text-danger asterik">*</i>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">--Select Category--</option>
                                <?php foreach ($rescat as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>" <?= ($row['id'] == $res[0]['category_id']) ? "selected" : ""; ?>><?php echo $row['name']; ?></option>
                                    
                                        
                                <?php 
                                } ?>
                                
                            </select>
                            <br />
                        </div>
                       
                        

                        
                        <div class="form-group">
                            <label for="image">Main Image : <i class="text-danger asterik">*</i>&nbsp;&nbsp;&nbsp;*Please choose square image of larger than 350px*350px & smaller than 550px*550px.</label><?php echo isset($error['image']) ? $error['image'] : ''; ?>
                            <input type="file" name="image" id="image">
                            <img src="<?php echo DOMAIN_URL.$res[0]['image']; ?>" width="210" height="160" />
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description :</label>
                            <textarea name="description" id="description" class="form-control" rows="8"><?php echo $res[0]['description']; ?></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="col-md-6">
                                    <label for="status">Product Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Update" name="btnUpdate" />&nbsp;
                        <!-- <input type="reset" class="btn-danger btn" value="Clear" id="btnClear" /> -->
                        <!--<div  id="res"></div>-->
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<div class="separator"> </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>

