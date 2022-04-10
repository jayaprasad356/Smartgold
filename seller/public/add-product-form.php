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
$sql_query = "SELECT id, name FROM category";
$db->sql($sql_query);

$res = $db->getResult();
if (isset($_POST['tnAdd'])) {
    
    $seller_id = $ID;
    $name = $db->escapeString($_POST['name']);
    $status = $db->escapeString($_POST['status']);
    $stock = $db->escapeString($_POST['stock']);
    $price= $db->escapeString($_POST['price']);
    $gender= $db->escapeString($_POST['gender']);
    $weight= $db->escapeString($_POST['weight']);
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

    if ($image_error > 0) {
        $error['image'] = " <span class='label label-danger'>Not uploaded!</span>";
    } else {
        $result = $fn->validate_image($_FILES["image"]);
        if ($result) {
            $error['image'] = " <span class='label label-danger'>Image type must jpg, jpeg, gif, or png!</span>";
        }
    }
    $error['other_images'] = '';
    if ($_FILES["other_images"]["error"][0] == 0) {
        for ($i = 0; $i < count($_FILES["other_images"]["name"]); $i++) {
            $_FILES["other_images"]["type"][$i];
            if ($_FILES["other_images"]["error"][$i] > 0) {
                $error['other_images'] = " <span class='label label-danger'>Images not uploaded!</span>";
            } else {
                $result = $fn->validate_other_images($_FILES["other_images"]["tmp_name"][$i], $_FILES["other_images"]["type"][$i]);
                if ($result) {
                    $error['other_images'] = " <span class='label label-danger'>Image type must jpg, jpeg, gif, or png!</span>";
                }
            }
        }
    }
    if (!empty($name) && !empty($category_id) && !empty($weight) && !empty($gender)   && empty($error['image'])) {

        // create random image file name
        $string = '0123456789';
        $file = preg_replace("/\s+/", "_", $_FILES['image']['name']);

        $image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;

        // upload new image
        $upload = move_uploaded_file($_FILES['image']['tmp_name'], '../upload/images/' . $image);
        $other_images = '';
        if (isset($_FILES['other_images']) && ($_FILES['other_images']['size'][0] > 0)) {
            //Upload other images
            $file_data = array();
            $target_path = '../upload/other_images/';
            for ($i = 0; $i < count($_FILES["other_images"]["name"]); $i++) {

                $filename = $_FILES["other_images"]["name"][$i];
                $temp = explode('.', $filename);
                $filename = microtime(true) . '-' . rand(100, 999) . '.' . end($temp);
                $file_data[] = $target_path . '' . $filename;
                if (!move_uploaded_file($_FILES["other_images"]["tmp_name"][$i], $target_path . '' . $filename))
                    echo "{$_FILES['image']['name'][$i]} not uploaded<br/>";
            }
            $other_images = json_encode($file_data);
        }

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
            $error['add_menu'] = "<section class='content-header'>
                                                <span class='label label-success'>Product Added Successfully</span>
                                                <h4><small><a  href='products.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Products</a></small></h4>
                                                 </section>";
        } else {
            $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
        }
    }


}

?>
<style>
    .disable{
pointer-events:none;
}
</style>
<section class="content-header">
    <h1>Add Product</h1>
    <?php echo isset($error['add_menu']) ? $error['add_menu'] : ''; ?>
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
                    <h3 class="box-title">Add Product</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='add_product_form' action="public/db-operation.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="add_product" name="add_product" required="" value="1" aria-required="true">
                    <input type="hidden" id="seller_id" name="seller_id" required="" value="<?php echo $ID ?>" aria-required="true">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['name']) ? $error['name'] : ''; ?>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="category_id">Category :</label> <i class="text-danger asterik">*</i>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">--Select Category--</option>
                                    <?php foreach ($res as $row) { ?>
                                        
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php 
                                    } ?>
                                    
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group packate_div">
                                        <label for="qty">Stock:</label> <i class="text-danger asterik">*</i>
                                        <input type="number" step="any" min="0" class="form-control" name="stock" required="" />
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group packate_div">
                                        <label for="weight">Gross Weight (in grams)</label><i class="text-danger asterik">*</i>
                                        <input type="number" step="any" min='0' class="form-control" name="weight" id="weight" required />
                                    </div>
                            </div>


                        </div>
                        <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group packate_div">
                                        <label for="price">Price (₹):</label> <i class="text-danger asterik">*</i>
                                        <input type="number" step="any" min='0' class="form-control price" name="price" id="price" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group packate_div">
                                        <label for="discounted_price">Discount In (%):</label>
                                        <input type="number" step="any" min='0' class="form-control discounted_percentage" name="discounted_percentage"  id="discounted_percentage" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group packate_div">
                                        <label for="discounted_price">Discounted Price(₹):</label>
                                        <input type="number" step="any" min='0' class="form-control disable" name="discounted_price" value="" id="discounted_price" />
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                    <label for="gender">Gender :</label><i class="text-danger asterik">*</i>
                                    <select name="gender" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female" selected>Female</option>
                                    </select>
                                </div>

                        </div>

                       
                        

                        
                        <div class="form-group">
                            <label for="image">Main Image : <i class="text-danger asterik">*</i>&nbsp;&nbsp;&nbsp;*Please choose square image of larger than 350px*350px & smaller than 550px*550px.</label><?php echo isset($error['image']) ? $error['image'] : ''; ?>
                            <input type="file" name="image" accept="image/png,  image/jpeg" id="image" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description :</label>
                            <textarea name="description" id="description" class="form-control" rows="8"></textarea>
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
                        <div class="form-group">
                            <p class="text-danger">Disclaimer : *Weight and Price may vary subject to the stock available.</p>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <!-- <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Add" name="btnAdd" />&nbsp;
                        <input type="reset" class="btn-danger btn" value="Clear" id="btnClear" />
                       <div  id="res"></div>
                    </div> -->
                    <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="submit_btn" name="btnAdd">Add</button>
                            <input type="reset" class="btn-warning btn" value="Clear" />
                            <div id="result" style="display: none;"></div>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<div class="separator"> </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>

<script>
    $(document).on('input', '.discounted_percentage', function(){
        let dp = $('#discounted_percentage').val();
        let price = $('#price').val(); 
        if(price != '' && dp != ''){
            var sale;
            sale = calculateSale(price, dp);
            $('#discounted_price').val(sale);

        }
        else{
            $('#discounted_price').val('');

        }

    });
    $(document).on('input', '.price', function(){
        let dp = $('#discounted_percentage').val();
        let price = $('#price').val(); 
        if(price != '' && dp != ''){
            var sale;
            sale = calculateSale(price, dp);
            $('#discounted_price').val(sale);

        }
        else{
            $('#discounted_price').val('');

        }
    });
    const calculateSale = (listPrice, discount) => {
        listPrice = parseFloat(listPrice);
        discount  = parseFloat(discount);
        return (listPrice - ( listPrice * discount / 100 )).toFixed(2); // Sale price
    }
</script>

<script>
    $('#add_product_form').validate({
        rules: {
            name: "required",
            price: "required",
            quantity: "required"

        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>
<script>
        $('#add_product_form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        if ($("#add_product_form").validate().form()) {
            $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    beforeSend: function() {
                        $('#submit_btn').html('Please wait..');
                    },
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result) {
                        $('#result').html(result);
                        $('#result').show().delay(6000).fadeOut();
                        //alert("Product Added Successfully");
                        $('#submit_btn').html('Add');
                    
                        $('#add_product_form')[0].reset();
                        document.getElementById("resultvalid").innerHTML = '';
                    }
                });
            }


    });
</script>