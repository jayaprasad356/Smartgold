<section class="content-header">
    <h1>Add Seller <small><a href='sellers.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Sellers</a></small></h1>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Seller</h3>

                    </div><!-- /.box-header -->

                    <form method="post" id="add_form" action="public/db-operation.php" enctype="multipart/form-data">
                        <input type="hidden" id="add_seller" name="add_seller" required="" value="1" aria-required="true">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Mobile</label>
                                        <input type="number" class="form-control" name="mobile" id="mobile" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Store URL</label>
                                        <input type="text" class="form-control" name="store_url" id="store_url">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Store Name</label>
                                        <input type="text" class="form-control" name="store_name" id="store_name" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="logo">Logo</label>
                                        <input type="file" name="store_logo" id="store_logo" required /><br>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Street</label>
                                        <input type="text" class="form-control" name="street" id="street">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Pincode</label>
                                        <input type="text" class="form-control" id='pincode' name="pincode" required>
                                    </div>
                                    
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Enter City</label>
                                        <input type="text" class="form-control" id='city' name="city" required>
                                    </div>
                                    
                                </div>
                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">State</label>
                                        <input type="text" class="form-control" name="state" id="state">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Account Number</label>
                                        <input type="number" class="form-control" name="account_number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Bank's IFSC Code</label>
                                        <input type="text" class="form-control" name="ifsc_code">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Bank Account Name</label>
                                        <input type="text" class="form-control" name="account_name">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">National Identity Card</label>
                                        <input type="file" class="form-control" name="national_id_card" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Address Proof</label>
                                        <input type="file" class="form-control" name="address_proof" id="address_proof" required><br>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">PAN Number</label>
                                        <input type="text" class="form-control" name="pan_number" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Latitude</label>
                                        <input type="number" class="form-control" name="latitude" id="latitude">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Longitude</label>
                                        <input type="text" class="form-control" name="longitude" id="longitude">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <div class="form-group">
                                        <label for="description">Store Description :</label>
                                        <textarea name="description" id="description" class="form-control" rows="8"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                
                                
                                <div class="form-group col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <div id="status" class="btn-group">
                                            <label class="btn btn-default" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="status" value="0"> Deactive
                                            </label>
                                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="status" value="1"> Approved
                                            </label>
                                            <label class="btn btn-danger" data-toggle-class="btn-danger" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="status" value="2"> Not-Approved
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- </div> -->

                                <!-- </div> -->

                            </div>
                            
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="submit_btn" name="btnAdd">Add</button>
                            <input type="reset" class="btn-warning btn" value="Clear" />
                            <div id="result" style="display: none;"></div>
                        </div>
                    </form>

                </div><!-- /.box -->
            
                
            
        </div>
    </div>
</section>

<div class="separator"> </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>

<script type="text/javascript" src="css/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('description');
</script>
<script>
    $('#add_form').validate({
        rules: {
            name: "required",
            mobile: "required",
            password: "required",
            address: "required",
            description: "required",
            require_products_approval: "required",
            status: "required",
            confirm_password: {
                required: true,
                equalTo: "#password"
            },
            cktext: {
                required: function() {
                    CKEDITOR.instances.cktext.updateElement();
                }
            }
        }

    });
    $('#cat_ids').select2({
        width: 'element',
        placeholder: 'type in category name to search',

    });
    $('#add_form').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        if ($("#add_form").validate().form()) {
            if (confirm('Are you sure?Want to Add Seller')) {
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
                    
                        $('#add_form')[0].reset();
                    }
                });
            }
        }
    });
</script>