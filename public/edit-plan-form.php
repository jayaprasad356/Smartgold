<?php
include_once('includes/functions.php');
include_once('includes/custom-functions.php');
$fn = new custom_functions;
?>
<?php
// $ID = (isset($_GET['id'])) ? $db->escapeString($fn->xss_clean($_GET['id'])) : "";
if (isset($_GET['id'])) {
    $ID = $db->escapeString($_GET['id']);
} else {
    // $ID = "";
    return false;
    exit(0);
}

// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM plans WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();
?>
<section class="content-header">
    <h1>
        Edit Plan<small><a href='manage-plans.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Manage Plans</a></small></h1>

    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
</section>
<section class="content">
    <!-- Main row -->

    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <!-- <h3 class="box-title">Edit Offer Lock Status</h3> -->
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="edit_form" method="post" action="public/db-operation.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" id="update_plan" name="update_plan" required="" value="1" aria-required="true">
                            <input type="hidden" id="update_id" name="update_id" required value="<?= $ID; ?>">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="plan">Plan Name :</label><i class="text-danger asterik">*</i>
                                        <select name="plan" class="form-control" required>                                  
                                            <option value="">Select</option>
                                            <option value="Basic" <?php if ($res[0]['name'] == "Basic") {
                                                                                        echo "selected";
                                                                                    } ?>>Basic</option>
                                            <option value="Deluxe" <?php if ($res[0]['name'] == "Deluxe") {echo "selected";} ?>>Deluxe</option>
                                            <option value="Premium" <?php if ($res[0]['name'] == "Premium") {echo "selected";} ?>>Premium</option>                                       
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="validity">Validity :</label><i class="text-danger asterik">*</i>
                                        <select name="validity" class="form-control" required>                                  
                                            <option value="">Select</option>
                                            <option value="1" <?php if ($res[0]['validity'] == "1") {
                                                                                        echo "selected";
                                                                                    } ?>>Monthly</option>
                                            <option value="3" <?php if ($res[0]['validity'] == "3") {echo "selected";} ?>>Quarterly</option>
                                            <option value="12" <?php if ($res[0]['validity'] == "12") {echo "selected";} ?>>Yearly</option>                                       
                                        </select>
                                    </div>

                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="products">Products :</label><i class="text-danger asterik">*</i>
                                        <select name="products" class="form-control" required>                                  
                                            <option value="">Select</option>
                                            <option value="100" <?php if ($res[0]['products'] == "100") {
                                                                                        echo "selected";
                                                                                    } ?>>100</option>
                                            <option value="500" <?php if ($res[0]['products'] == "500") {echo "selected";} ?>>500</option>
                                            <option value="Unlimited" <?php if ($res[0]['products'] == "Unlimited") {echo "selected";} ?>>Unlimited</option>                                       
                                        </select>
                                    </div>

                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group packate_div">
                                        <label for="price">Price (₹):</label> <i class="text-danger asterik">*</i>
                                        <input type="number" step="any" min='0' class="form-control price" value="<?php echo $res[0]['price'] ?>" name="price" id="price" required />
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="offers">Offers :</label><i class="text-danger asterik">*</i>
                                        <select name="offers" class="form-control" required>                                  
                                            <option value="">Select</option>
                                            <option value="10" <?php if ($res[0]['offers'] == "10") {
                                                                                        echo "selected";
                                                                                    } ?>>10</option>
                                            <option value="15" <?php if ($res[0]['offers'] == "15") {echo "selected";} ?>>15</option>
                                            <option value="One a day" <?php if ($res[0]['offers'] == "One a day") {echo "selected";} ?>>One a day</option>                                       
                                        </select>
                                    </div>

                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group packate_div">
                                        <label for="access">Access</label> <i class="text-danger asterik">*</i>
                                        <input type="number" step="any" min='0' class="form-control price" value="<?php echo $res[0]['access'] ?>" name="access" id="access" required />
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" id="submit_btn">Update</button><br>
                                <div style="display:none;" id="result"></div>

                            </div>
                        </div><!-- /.box-body -->
                    </form>
                </div><!-- /.box -->
        </div>
    </div>

</section>

<div class="separator"> </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>


<script>
    $('#edit_form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        if ($("#edit_form").validate().form()) {
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
                    $('#submit_btn').html('Update');
                    alert("Plans Updated Successfully")
                    location.reload(true);
                }
            });
        }
    });
</script>

<?php $db->disconnect(); ?>