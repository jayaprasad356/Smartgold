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
$order_id = $_GET['id'];

if (isset($_POST['btnUpdate'])) {
    
    $seller_id = $ID;
    $status = $db->escapeString($_POST['status']);
    $payment_status = $db->escapeString($_POST['payment_status']);
    
    $sql = "UPDATE orders SET `status` = '$status',`payment_status` = '$payment_status' WHERE id = '" . $order_id . "'";
    $db->sql($sql);
    $product_result = $db->getResult();

    if (!empty($product_result)) {
        $product_result = 0;
    } else {
        $product_result = 1;
    }
    if ($product_result == 1 ) {
        $error['add_menu'] = "<section class='content-header'>
                                            <span class='label label-success'>Updated Successfully</span>
                                            <h4><small><a  href='orders.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Orders</a></small></h4>
                                             </section>";
    } else {
        $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
    }

    

}
$sql_query = "SELECT status,payment_status FROM orders WHERE id = '" . $order_id . "'";
$db->sql($sql_query);

$res = $db->getResult();

?>
<section class="content-header">
    <h1>Update Orders</h1>
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
                    <h3 class="box-title">Update Orders</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='add_product_form' method="post" enctype="multipart/form-data">
                
                    
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group" >
                                <label for="exampleInputEmail1">Status</label> <i class="text-danger asterik">*</i><?php echo isset($error['status']) ? $error['status'] : ''; ?>
                                <select name="status" class="form-control" required>
                                <option value="Received" <?php if ($res[0]['status'] == "Received") {echo "selected";} ?>>Received</option>
                                <option value="Cancelled" <?php if ($res[0]['status'] == "Cancelled") {echo "selected";} ?>>Cancelled</option>         
                                <option value="Completed" <?php if ($res[0]['status'] == "Completed") {echo "selected";} ?>>Completed</option>                                                                            
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Payment Status</label> <i class="text-danger asterik">*</i><?php echo isset($error['status']) ? $error['status'] : ''; ?>
                            <select name="payment_status" class="form-control" required>
                                <option value="UnPaid" <?php if ($res[0]['payment_status'] == "UnPaid") {
                                                                                echo "selected";
                                                                            } ?>>UnPaid</option>
                                <option value="Paid" <?php if ($res[0]['payment_status'] == "Paid") {
                                                                                echo "selected";
                                                                            } ?>>Paid</option>                                       
                            </select>
                        </div>

                    </div>
                    
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Update" name="btnUpdate" />
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
