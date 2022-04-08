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

if (isset($_POST['btnUpdate'])) {
    $seller_id = $ID;
    $status = $db->escapeString($_POST['status']);
   
    $error = array();
    $sql_query = "UPDATE offer_lock SET status = '$status' WHERE id = $offer_lock_id";

    $db->sql($sql_query);
    $error['update_data'] = "<span class='label label-success'>Offer Lock updated Successfully</span>";
}
$sql_query = "SELECT users.name,users.mobile,offer_lock.status FROM offer_lock,users WHERE offer_lock.id = '$offer_lock_id'";
$db->sql($sql_query);

$res = $db->getResult();
$sql_query = "SELECT id, name FROM category";
$db->sql($sql_query);

$rescat = $db->getResult();
?>
<section class="content-header">
    <h1>Edit Offer Lock</h1>
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
                    <h3 class="box-title">Edit Offer Lock</h3>
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

                        <div class="row">
                            <div class="col-md-6">
                                <label for="status">Offer Lock Status :</label>
                                <select name="status" class="form-control" required>
                                    <option value="Locked" <?php if ($res[0]['status'] == "Locked") {
                                                                                    echo "selected";
                                                                                } ?>>Locked</option>
                                    <option value="Cancelled" <?php if ($res[0]['status'] == "Cancelled") {
                                                                                    echo "selected";
                                                                                } ?>>Cancelled</option>
                                    <option value="Completed" <?php if ($res[0]['status'] == "Completed") {
                                                                                    echo "selected";
                                                                                } ?>>Completed</option>                                          
                                </select>

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

