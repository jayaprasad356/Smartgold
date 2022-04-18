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

$sql_query = "SELECT * FROM admin ";
$db->sql($sql_query);
$res = $db->getResult();
$password = $res[0]['password'];
?>
<section class="content-header">
    <h1>
        Edit Access<small><a href='admin-access.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Admin Acess</a></small></h1>

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
                        <h3 class="box-title">Edit Access</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="edit_form" method="post" action="public/db-operation.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" id="update_admin" name="update_admin" required="" value="1" aria-required="true">
                            <input type="hidden" id="update_id" name="update_id" required value="<?= $ID; ?>">
                            <input type="hidden" id="oldpassword" name="oldpassword" required value="<?= $password; ?>">
                    
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Name</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="name" id="name" value="<?= $res[0]['name']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Email</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="email" id="email" value="<?= $res[0]['email']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input id="changepass" type="button" class="btn btn-primary" onclick="changePassword()" value="Change Password">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" placeholder="Password" name="password" id="password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <div id="status" class="btn-group">
                                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="status" value="1" <?= ($res[0]['status'] == 1) ? 'checked' : ''; ?>> Active
                                            </label>
                                            <label class="btn btn-danger" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="status" value="0" <?= ($res[0]['status'] == 0) ? 'checked' : ''; ?>> Deactive
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <!-- </div> -->

                                <!-- </div> -->

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
    function changePassword() {
        document.getElementById("password").type = "password";

    }

    $('#edit_form').validate({
        rules: {
            name: "required",
            mobile: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
                },
                pincode: {
                required: true,
                number: true,
                minlength: 6,
                maxlength: 6
                },
            address: "required",
            valid: "required",
            description: "required",
            require_products_approval: "required",
            status: "required",
            cktext: {
                required: function() {
                    CKEDITOR.instances.cktext.updateElement();
                    
                }
            }
            
        }

    });
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
                }
            });
        }
    });
</script>
<?php $db->disconnect(); ?>