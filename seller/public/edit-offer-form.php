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
$offer_id = $_GET['id'];
if (isset($_POST['btnUpdate'])) {
    $ppg = (isset($_POST['gram_price']) && $_POST['gram_price'] != "") ? $db->escapeString($_POST['gram_price']) : "";
    $budget_id = $db->escapeString($_POST['budget_id']);
    $wastage = (isset($_POST['wastage']) && $_POST['wastage'] != "") ? $db->escapeString($_POST['wastage']) : "";
    $maxilock= $db->escapeString($_POST['maxilock']);
    $status = $db->escapeString($_POST['status']);
    $valid = $db->escapeString($_POST['valid']);
    $description = $db->escapeString($_POST['description']);
    $error = array();
    $sql_query = "UPDATE offers SET gram_price = '$ppg', budget_id = '$budget_id', wastage = '$wastage', max_locked = '$maxilock', status = '$status', valid_date = '$valid', description = '$description' WHERE id = $offer_id";
    $db->sql($sql_query);
    $error['update_data'] = "<span class='label label-success'>Offer Updated Successfully</span>";
}
$sql_query = "SELECT * FROM offers WHERE id = '$offer_id'";
$db->sql($sql_query);
$res = $db->getResult();
$sql_query = "SELECT id, budget FROM budget";
$db->sql($sql_query);

$resbudget = $db->getResult();
?>
<section class="content-header">
    <h1>Edit Offer</h1>
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
                    <h3 class="box-title">Edit Offer</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='add_product_form' method="post" enctype="multipart/form-data">
                    
                    <div class="box-body">
                        <div class="form-group">
                            <label for="budget_id">Budget :</label> <i class="text-danger asterik">*</i><?php echo isset($error['budget_id']) ? $error['budget_id'] : ''; ?>
                            <select name="budget_id" id="budget_id" class="form-control" required>
                                <option value="">--Select Budget--</option>
                                <?php foreach ($resbudget as $row) { ?>
                                    <option value="<?php echo $row['id']; ?>"<?php if ($row['id']== $res[0]['budget_id']) {echo "selected";} ?>><?php echo $row['budget']; ?></option>
                                <?php 
                                } ?>
                                
                            </select>
                            <br />
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Discount Per Gram(₹):</label>
                                <input type="number" class="form-control" id="gram_price" name="gram_price" value="<?php echo $res[0]['gram_price'] ?>">
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Discount On Wastage(%):</label>
                                <input type="number" class="form-control" id="wastage" name="wastage" value="<?php echo $res[0]['wastage'] ?>">
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Maximum Locked Items</label> <i class="text-danger asterik">*</i><?php echo isset($error['maxilock']) ? $error['maxilock'] : ''; ?>
                                <input type="number" class="form-control" name="maxilock" value="<?php echo $res[0]['max_locked'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Fine Print Description :</label> <i class="text-danger asterik">*</i><?php echo isset($error['description']) ? $error['description'] : ''; ?>
                            <textarea name="description" id="description" class="form-control" rows="8"><?php echo $res[0]['description'] ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="status">Status :</label><i class="text-danger asterik">*</i>
                                <select name="status" class="form-control" required>
                                    <option value="1"<?php if ($res[0]['status'] == "1") {
                                                                                    echo "selected";
                                                                                } ?>>Active</option>
                                    <option value="0"<?php if ($res[0]['status'] == "0") {
                                                                                    echo "selected";
                                                                                } ?>>Deactive</option>
                                </select>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Valid Date</label> <i class="text-danger asterik">*</i><?php echo isset($error['valid']) ? $error['valid'] : ''; ?>
                                    <input type="date" class="form-control" id="valid" name="valid" value="<?php echo $res[0]['valid_date'] ?>" required>
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

