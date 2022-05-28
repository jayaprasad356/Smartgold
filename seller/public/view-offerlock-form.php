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
$offer_lock_id = $_GET['id'];


$sql_query = "SELECT *,users.name,users.mobile,offer_lock.status FROM offer_lock,users WHERE offer_lock.id = '$offer_lock_id' AND offer_lock.user_id = users.id";
$db->sql($sql_query);

$res = $db->getResult();
$sql_query = "SELECT id, title FROM offer_lock_status";
$db->sql($sql_query);
$reslock = $db->getResult();
?>
<section class="content-header">
    <h1>
    View Offer Lock<small><a href='offers.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Offers List</a></small></h1>

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
                    <h3 class="box-title">View Offer Lock</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='add_product_form' method="post" enctype="multipart/form-data">
                    
                    <div class="box-body">
                        <div class="form-group">
                                <label for="exampleInputEmail1">Customer Name</label><?php echo isset($error['name']) ? $error['name'] : ''; ?>
                                <p><?php echo $res[0]['name'] ?></p>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Customer Mobile Number</label><?php echo isset($error['mobile']) ? $error['mobile'] : ''; ?>
                                <p><?php echo $res[0]['mobile'] ?></p>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Offer Lock Date</label><?php echo isset($error['lock_date']) ? $error['lock_date'] : ''; ?>
                                <p><?php echo $res[0]['lock_date'] ?></p>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="status">Offer Lock Status :</label> <i class="text-danger asterik">*</i>
                                <p><?php echo $res[0]['status'] ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <input type="text" class="form-control" name="product_name" id="product_name" value="<?= $res[0]['seller_product_name']; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="form-group">
                                    <label for="">Product Price</label>
                                    <input type="text" class="form-control" name="product_price" id="product_price" value="<?= $res[0]['seller_product_price']; ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description :</label>
                            <textarea name="description" id="description" class="form-control" rows="8" disabled><?= $res[0]['seller_description']; ?></textarea>
                        </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<div class="separator"> </div>
<script>
    if ($("#success").text() == "Offer Lock updated Successfully")
    {
        setTimeout(showpanel, 1000);
        
    }
    function showpanel() {     
        window.location.replace("offers.php");
 }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>

