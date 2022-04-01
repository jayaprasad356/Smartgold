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
$sql_query = "SELECT id, budget FROM budget";
$db->sql($sql_query);

$res = $db->getResult();

?>
<section class="content-header">
    <h1>Add Offer</h1>
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
                    <h3 class="box-title">Add Offer</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id="add_offer_form" method="post" action="public/db-operation.php" enctype="multipart/form-data">
                    <input type="hidden" id="add_offer" name="add_offer" required="" value="1" aria-required="true">
                    <input type="hidden" id="seller_id" name="seller_id" required="" value="<?php echo $ID ?>" aria-required="true">
                
                    
                    <div class="box-body">
                    <div class="form-group">
                            <label for="budget_id">Budget :</label> <i class="text-danger asterik">*</i><?php echo isset($error['budget_id']) ? $error['budget_id'] : ''; ?>
                            <select name="budget_id" id="budget_id" class="form-control" required>
                                <option value="">--Select Budget--</option>
                                <?php foreach ($res as $row) { ?>
                                    
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['budget']; ?></option>
                                <?php 
                                } ?>
                                
                            </select>
                            <br />
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Discount Per Gram(₹):</label>
                                <input type="number" class="form-control" id="pricegram" name="pricegram">
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Discount On Wastage(%)</label>
                                <input type="number" class="form-control" id="wastage" name="wastage">
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Maximum Locked Items</label> <i class="text-danger asterik">*</i><?php echo isset($error['maxilock']) ? $error['maxilock'] : ''; ?>
                                <input type="number" class="form-control" name="maxilock" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Fine Print Description :</label> <i class="text-danger asterik">*</i><?php echo isset($error['description']) ? $error['description'] : ''; ?>
                            <textarea name="description" id="description" class="form-control" rows="8"></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <label for="serve_for">Status :</label>
                                <select name="serve_for" class="form-control" required>
                                    <option value="1">Available</option>
                                    <option value="0">Not Available</option>
                                </select>

                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Valid Date</label> <i class="text-danger asterik">*</i><?php echo isset($error['valid']) ? $error['valid'] : ''; ?>
                                <input type="date" class="form-control" id="valid" name="valid" required>
                        </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="submit_btn" name="btnAdd">Add</button>
                        <input type="reset" class="btn-danger btn" value="Clear" id="btnClear" />
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
    $('#add_offer_form').validate({
        rules: {
            budget_id: "required",
            

        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
    
</script>

<script>
    $('#add_offer_form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        if ($("#add_offer_form").validate().form()) {
            if(document.getElementById("wastage").value != '' || document.getElementById("pricegram").value != ''){
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
                        $('#submit_btn').html('Add');
                    
                        $('#add_offer_form')[0].reset();
                        
                    }
                });

            }else{
                alert("Enter Atleast Wastage or Discount Per gram")
            }
        

            
            

        }
    
    });
</script>
<script>
    document.getElementById('valid').valueAsDate = new Date();

</script>
