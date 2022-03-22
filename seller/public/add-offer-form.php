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
if (isset($_POST['btnAdd'])) {
    
    $seller_id = $ID;
    $ppg = $db->escapeString($_POST['pricegram']);
    $budget_id = $db->escapeString($_POST['budget_id']);
    $wastage = $db->escapeString($_POST['wastage']);
    $maxilock= $db->escapeString($_POST['maxilock']);
    $status = $db->escapeString($_POST['serve_for']);
    $valid = $db->escapeString($_POST['valid']);
    $description = $db->escapeString($_POST['description']);

    
    $error = array();

    if (empty($ppg)) {
        $error['ppg'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($budget_id)) {
        $error['budget_id'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($wastage)) {
        $error['wastage'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($maxilock)) {
        $error['maxilock'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($status)) {
        $error['status'] = " <span class='label label-danger'>Required!</span>";
    }
    if (empty($valid)) {
        $error['valid'] = " <span class='label label-danger'>Required!</span>";
    }
    
    
    if (!empty($ppg) && !empty($budget_id)   && !empty($wastage) && !empty($maxilock) && !empty($status) && !empty($valid)) {

        

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
            $error['add_menu'] = "<section class='content-header'>
                                                <span class='label label-success'>Offer Added Successfully</span>
                                                <h4><small><a  href='products.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Products</a></small></h4>
                                                 </section>";
        } else {
            $error['add_menu'] = " <span class='label label-danger'>Failed</span>";
        }
    }


}

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
                <form id='add_product_form' method="post" enctype="multipart/form-data">
                
                    
                    <div class="box-body">
                    <div class="form-group">
                            <label for="budget_id">Budget :</label> <i class="text-danger asterik">*</i>
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
                                <label for="exampleInputEmail1">Price Per Gram(₹):</label> <i class="text-danger asterik">*</i><?php echo isset($error['ppg']) ? $error['ppg'] : ''; ?>
                                <input type="text" class="form-control" name="pricegram" required>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Wastage</label> <i class="text-danger asterik">*</i><?php echo isset($error['wastage']) ? $error['wastage'] : ''; ?>
                                <input type="text" class="form-control" name="wastage" required>
                        </div>
                        <div class="form-group">
                                <label for="exampleInputEmail1">Maximum Locked</label> <i class="text-danger asterik">*</i><?php echo isset($error['maxilock']) ? $error['maxilock'] : ''; ?>
                                <input type="text" class="form-control" name="maxilock" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description :</label> <i class="text-danger asterik">*</i><?php echo isset($error['description']) ? $error['description'] : ''; ?>
                            <textarea name="description" id="description" class="form-control" rows="8"></textarea>
                            <script type="text/javascript" src="css/js/ckeditor/ckeditor.js"></script>
                            <script type="text/javascript">
                                CKEDITOR.replace('description');
                            </script>
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
                                <label for="exampleInputEmail1">Valid Upto</label> <i class="text-danger asterik">*</i><?php echo isset($error['valid']) ? $error['valid'] : ''; ?>
                                <input type="date" class="form-control" name="valid" required>
                        </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Add" name="btnAdd" />&nbsp;
                        <input type="reset" class="btn-danger btn" value="Clear" id="btnClear" />
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
<script>
    $('#seller_id').on('change', function(e) {
        var seller_id = $('#seller_id').val();
        $.ajax({
            type: 'POST',
            url: "public/db-operation.php",
            data: 'get_categories_by_seller=1&seller_id=' + seller_id,
            beforeSend: function() {
                $('#category_id').html('<option>Please wait..</option>');
            },
            success: function(result) {
                $('#category_id').html(result);
            }
        });
    });

    var changeCheckbox = document.querySelector('#return_status_button');
    var init = new Switchery(changeCheckbox);
    changeCheckbox.onchange = function() {
        if ($(this).is(':checked')) {
            $('#return_status').val(1);
            $('#return_day').show();
        } else {
            $('#return_status').val(0);
            $('#return_day').hide();
            $('#return_day').val('');
        }
    };
    // $('.pincodes').hide();
    $('#pincode_ids_exc').prop('disabled', true);

    $('#product_pincodes').on('change', function() {
        var val = $('#product_pincodes').val();
        if (val == "included" || val == "excluded") {
            $('#pincode_ids_exc').prop('disabled', false);
        } else {
            $('#pincode_ids_exc').prop('disabled', true);
        }
    });
    $('#pincode_ids_exc').select2({
        width: 'element',
        placeholder: 'type in category name to search',

    });
</script>

<script>
    var changeCheckbox = document.querySelector('#cancelable_button');
    var init = new Switchery(changeCheckbox);
    changeCheckbox.onchange = function() {
        if ($(this).is(':checked')) {
            $('#cancelable_status').val(1);
            $('#till-status').show();

        } else {
            $('#cancelable_status').val(0);
            $('#till-status').hide();
            $('#till_status').val('');
        }
    };
</script>
<script>
    $('#pincode_ids_inc').select2({
        width: 'element',
        placeholder: 'type in category name to search',

    });

    if ($('#packate').prop('checked')) {
        $('#packate_div').show();
        $('#packate_server_hide').hide();
        $('.loose_div').children(":input").prop('disabled', true);
        $('#loose_stock_div').children(":input").prop('disabled', true);
    }

    $.validator.addMethod('lessThanEqual', function(value, element, param) {
        return this.optional(element) || parseInt(value) < parseInt($(param).val());
    }, "Discounted Price should be lesser than Price");
</script>

<script>
    var num = 2;
    $('#add_packate_variation').on('click', function() {
        html = '<div class="row"><div class="col-md-2"><div class="form-group"><label for="measurement">No. of Books</label> <i class="text-danger asterik">*</i>' +
            '<input type="number" class="form-control" name="packate_measurement[]" required="" step="any" min="0"></div></div>' +
            '<div class="col-md-1"><div class="form-group">' +
            '<label for="measurement_unit">Unit</label><select class="form-control" name="packate_measurement_unit_id[]">' +
            '<?php
                foreach ($res_unit as $row) {
                    echo "<option value=" . $row['id'] . ">" . $row['short_code'] . "</option>";
                }
                ?>' +
            '</select></div></div>' +
            '<div class="col-md-2"><div class="form-group"><label for="price">Price(<?= $settings['currency'] ?>):</label> <i class="text-danger asterik">*</i>' +
            '<input type="number" step="any" min="0" class="form-control" name="packate_price[]" required=""></div></div>' +
            '<div class="col-md-2"><div class="form-group"><label for="discounted_price">Discounted Price(<?= $settings['currency'] ?>):</label>' +
            '<input type="number" step="any" min="0" class="form-control" name="packate_discounted_price[]" /></div></div>' +
            '<div class="col-md-1"><div class="form-group"><label for="stock">Stock:</label> <i class="text-danger asterik">*</i>' +
            '<input type="number" step="any" min="0" class="form-control" name="packate_stock[]" /></div></div>' +
            '<div class="col-md-1"><div class="form-group"><label for="unit">Unit:</label>' +
            '<select class="form-control" name="packate_stock_unit_id[]">' +
            '<?php
                foreach ($res_unit as  $row) {
                    echo "<option value=" . $row['id'] . ">" . $row['short_code'] . "</option>";
                }
                ?>' +
            '</select>' +
            '</div></div>' +
            '<div class="col-md-2"><div class="form-group packate_div"><label for="qty">Status:</label><select name="packate_serve_for[]" class="form-control" required><option value="Available">Available</option><option value="Sold Out">Sold Out</option></select></div></div>' +
            '<div class="col-md-1" style="display: grid;"><label>Remove</label><a class="remove_variation text-danger" title="Remove variation of product" style="cursor: pointer;"><i class="fa fa-times fa-2x"></i></a></div>' +
            '</div>';

        $('#variations').append(html);
        $('#add_product_form').validate();
    });

    $('#add_loose_variation').on('click', function() {
        html = '<div class="row"><div class="col-md-4"><div class="form-group"><label for="measurement">No. of Books</label> <i class="text-danger asterik">*</i>' +
            '<input type="number" step="any" min="0" class="form-control" name="loose_measurement[]" required=""></div></div>' +
            '<div class="col-md-2"><div class="form-group loose_div">' +
            '<label for="unit">Unit:</label><select class="form-control" name="loose_measurement_unit_id[]">' +
            '<?php
                foreach ($res_unit as  $row) {
                    echo "<option value=" . $row['id'] . ">" . $row['short_code'] . "</option>";
                }
                ?>' +
            '</select></div></div>' +
            '<div class="col-md-3"><div class="form-group"><label for="price">Price  (<?= $settings['currency'] ?>):</label> <i class="text-danger asterik">*</i>' +
            '<input type="number" step="any" min="0" class="form-control" name="loose_price[]" required=""></div></div>' +
            '<div class="col-md-2"><div class="form-group"><label for="discounted_price">Discounted Price(<?= $settings['currency'] ?>):</label>' +
            '<input type="number" step="any"  min="0" class="form-control" name="loose_discounted_price[]" /></div></div>' +
            '<div class="col-md-1" style="display: grid;"><label>Remove</label><a class="remove_variation text-danger" title="Remove variation of product" style="cursor: pointer;"><i class="fa fa-times fa-2x"></i></a></div>' +
            '</div>';
        $('#variations').append(html);
    });
</script>
<script>
    $('#add_product_form').validate({

        ignore: [],
        debug: false,
        rules: {
            name: "required",
            measurement: "required",
            price: "required",
            quantity: "required",
            image: "required",
            category_id: "required",
            stock: "required",
            discounted_price: {
                lessThanEqual: "#price"
            },
            description: {
                required: function(textarea) {
                    CKEDITOR.instances[textarea.id].updateElement();
                    var editorcontent = textarea.value.replace(/<[^>]*>/gi, '');
                    return editorcontent.length === 0;
                }
            },
            pincode_ids_inc: {
                empty: {
                    depends: function(element) {
                        return $("#pincode_ids_exc").is(":blank");
                    }
                }
            }

        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>
<script>
    $(document).on('click', '.remove_variation', function() {
        $(this).closest('.row').remove();
    });


    $(document).on('change', '#category_id', function() {
        $.ajax({
            url: "public/db-operation.php",
            data: "category_id=" + $('#category_id').val() + "&change_category=1",
            method: "POST",
            success: function(data) {
                $('#subcategory_id').html("<option value=''>---Select Subcategory---</option>" + data);
            }
        });
    });

    $(document).on('change', '#packate', function() {
        $('#variations').html("");
        $('#packate_div').show();
        $('#packate_server_hide').hide();
        $('.packate_div').children(":input").prop('disabled', false);
        $('#loose_div').hide();
        $('.loose_div').children(":input").prop('disabled', true);
        $('#loose_stock_div').hide();
        $('#loose_stock_unit_id').hide();
        $('#loose_stock_div').children(":input").prop('disabled', true);

    });
    $(document).on('change', '#loose', function() {
        $('#variations').html("");
        $('#loose_div').show();
        $('.loose_div').children(":input").prop('disabled', false);
        $('#loose_stock_div').show();
        $('#loose_stock_div').children(":input").prop('disabled', false);
        $('#packate_server_hide').show();
        $('#packate_div').hide();
        $('.packate_div').children(":input").prop('disabled', true);

    });

    // function validate_amount(value) {
    //     if (parseInt(value) < 0) {
    //         alert('You Can not enter amount less than zero.');
    //     }
    // }
</script>