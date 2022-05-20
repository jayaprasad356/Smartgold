<?php
include_once('../includes/functions.php');
include_once('../includes/custom-functions.php');
$fn = new custom_functions;
?>
<?php
// $ID = (isset($_GET['id'])) ? $db->escapeString($fn->xss_clean($_GET['id'])) : "";
$ID = $_SESSION['seller_id'];
// create array variable to store previous data
$data = array();

$sql_query = "SELECT * FROM seller WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();
?>
<section class="content">
    <!-- Main row -->

    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="text-primary box-title">Your Current Plan is <?= $res[0]['plan']; ?> - Expired at <?= $res[0]['valid']; ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="edit_form" method="post" action="public/db-operation.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" id="update_seller" name="update_seller" required="" value="1" aria-required="true">
                            <input type="hidden" id="update_id" name="update_id" required value="<?= $ID; ?>">
                            <input type="hidden" id="hide_description" name="hide_description">
                            <input type="hidden" id="old_logo" name="old_logo" required value="<?= $res[0]['logo']; ?>">
                            <input type="hidden" id="old_national_identity_card" name="old_national_identity_card" required value="<?= $res[0]['national_identity_card']; ?>">
                            <input type="hidden" id="old_address_proof" name="old_address_proof" required value="<?= $res[0]['address_proof']; ?>">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Name</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="name" id="name" value="<?= $res[0]['name']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Email</label><i class="text-danger asterik">*</i>
                                        <input type="email" class="form-control" name="email" id="email" value="<?= $res[0]['email']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Mobile</label><i class="text-danger asterik">*</i>
                                        <input type="number" class="form-control" name="mobile" id="mobile" value="<?= $res[0]['mobile']; ?>" required readonly>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Store URL</label>
                                        <input type="text" class="form-control" name="store_url" id="store_url" value="<?= (!empty($res[0]['store_url'])) ? $res[0]['store_url'] : ""; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-none">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Old Password :</label><small>( Leave it blank for no change )</small>
                                        <input type="password" class="form-control" name="old_password" id="old_password" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input id="changepass" type="button" class="btn btn-primary" onclick="changePassword()" value="Change Password">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <input type="hidden" class="form-control" name="password" placeholder="Password" id="password">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="hidden" class="form-control" name="confirm_password" placeholder="Confirm Password" id="confirm_password">
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Logo</label><i class="text-danger asterik">*</i>
                                        
                                        <input type="file" name="store_logo" id="store_logo">
                                        <p class="help-block"><img src="<?php echo DOMAIN_URL . 'upload/seller/' . $res[0]['logo']; ?>" style="max-width:100%" /></p>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">National Identity Card</label><i class="text-danger asterik">*</i>
                                        <input type="file" name="national_id_card" id="national_id_card">
                                        <a href="<?php echo DOMAIN_URL . 'upload/seller/' . $res[0]['national_identity_card']; ?>" target="_blank" class="help-bloc"> View Document</a>
                                        
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Address Proof</label><i class="text-danger asterik">*</i>
                                        <input type="file" name="address_proof" id="address_proof">
                                        <a href="<?php echo DOMAIN_URL . 'upload/seller/' . $res[0]['address_proof']; ?>" target="_blank" class="help-bloc"> View Document</a>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Store Name</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="store_name" id="store_name" value="<?= $res[0]['store_name']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Street</label>
                                        <input type="text" class="form-control" name="street" id="street" value="<?= (!empty($res[0]['street'])) ? $res[0]['street'] : ""; ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Pincode</label><i class="text-danger asterik">*</i>
                                        <input type="number" class="form-control" name="pincode" id="pincode" value="<?= $res[0]['pincode']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">City</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" id='city' name="city" value="<?= $res[0]['city']; ?>" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                            <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">State</label><i class="text-danger asterik">*</i>
                                        
                                        <select name="state" id="state" class="form-control">
                                            <option <?=$res[0]['state'] == 'Andhra Pradesh' ? ' selected="selected"' : '';?> value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option <?=$res[0]['state'] == 'Andaman and Nicobar Islands' ? ' selected="selected"' : '';?> value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                            <option <?=$res[0]['state'] == 'Arunachal Pradesh' ? ' selected="selected"' : '';?> value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option <?=$res[0]['state'] == 'Assam' ? ' selected="selected"' : '';?> value="Assam">Assam</option>
                                            <option <?=$res[0]['state'] == 'Bihar' ? ' selected="selected"' : '';?> value="Bihar">Bihar</option>
                                            <option <?=$res[0]['state'] == 'Chandigarh' ? ' selected="selected"' : '';?> value="Chandigarh">Chandigarh</option>
                                            <option <?=$res[0]['state'] == 'Chhattisgarh' ? ' selected="selected"' : '';?> value="Chhattisgarh">Chhattisgarh</option>
                                            <option <?=$res[0]['state'] == 'Dadar and Nagar Haveli' ? ' selected="selected"' : '';?> value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                            <option <?=$res[0]['state'] == 'Daman and Diu' ? ' selected="selected"' : '';?> value="Daman and Diu">Daman and Diu</option>
                                            <option <?=$res[0]['state'] == 'Delhi' ? ' selected="selected"' : '';?> value="Delhi">Delhi</option>
                                            <option <?=$res[0]['state'] == 'Lakshadweep' ? ' selected="selected"' : '';?> value="Lakshadweep">Lakshadweep</option>
                                            <option <?=$res[0]['state'] == 'Puducherry' ? ' selected="selected"' : '';?> value="Puducherry">Puducherry</option>
                                            <option <?=$res[0]['state'] == 'Goa' ? ' selected="selected"' : '';?> value="Goa">Goa</option>
                                            <option <?=$res[0]['state'] == 'Gujarat' ? ' selected="selected"' : '';?> value="Gujarat">Gujarat</option>
                                            <option <?=$res[0]['state'] == 'Haryana' ? ' selected="selected"' : '';?> value="Haryana">Haryana</option>
                                            <option <?=$res[0]['state'] == 'Himachal Pradesh' ? ' selected="selected"' : '';?> value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option <?=$res[0]['state'] == 'Jammu and Kashmir' ? ' selected="selected"' : '';?> value="Jammu and Kashmir">Jammu and Kashmir</option>
                                            <option <?=$res[0]['state'] == 'Jharkhand' ? ' selected="selected"' : '';?> value="Jharkhand">Jharkhand</option>
                                            <option <?=$res[0]['state'] == 'Karnataka' ? ' selected="selected"' : '';?> value="Karnataka">Karnataka</option>
                                            <option <?=$res[0]['state'] == 'Kerala' ? ' selected="selected"' : '';?> value="Kerala">Kerala</option>
                                            <option <?=$res[0]['state'] == 'Madhya Pradesh' ? ' selected="selected"' : '';?> value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option <?=$res[0]['state'] == 'Maharashtra' ? ' selected="selected"' : '';?> value="Maharashtra">Maharashtra</option>
                                            <option <?=$res[0]['state'] == 'Manipur' ? ' selected="selected"' : '';?> value="Manipur">Manipur</option>
                                            <option <?=$res[0]['state'] == 'Meghalaya' ? ' selected="selected"' : '';?> value="Meghalaya">Meghalaya</option>
                                            <option <?=$res[0]['state'] == 'Mizoram' ? ' selected="selected"' : '';?> value="Mizoram">Mizoram</option>
                                            <option <?=$res[0]['state'] == 'Nagaland' ? ' selected="selected"' : '';?> value="Nagaland">Nagaland</option>
                                            <option <?=$res[0]['state'] == 'Odisha' ? ' selected="selected"' : '';?> value="Odisha">Odisha</option>
                                            <option <?=$res[0]['state'] == 'Punjab' ? ' selected="selected"' : '';?> value="Punjab">Punjab</option>
                                            <option <?=$res[0]['state'] == 'Rajasthan' ? ' selected="selected"' : '';?> value="Rajasthan">Rajasthan</option>
                                            <option <?=$res[0]['state'] == 'Sikkim' ? ' selected="selected"' : '';?> value="Sikkim">Sikkim</option>
                                            <option <?=$res[0]['state'] == 'Tamil Nadu' ? ' selected="selected"' : '';?> value="Tamil Nadu">Tamil Nadu</option>
                                            <option <?=$res[0]['state'] == 'Telangana' ? ' selected="selected"' : '';?> value="Telangana">Telangana</option>
                                            <option <?=$res[0]['state'] == 'Tripura' ? ' selected="selected"' : '';?> value="Tripura">Tripura</option>
                                            <option <?=$res[0]['state'] == 'Uttar Pradesh' ? ' selected="selected"' : '';?> value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option <?=$res[0]['state'] == 'Uttarakhand' ? ' selected="selected"' : '';?> value="Uttarakhand">Uttarakhand</option>
                                            <option <?=$res[0]['state'] == 'West Bengal' ? ' selected="selected"' : '';?> value="West Bengal">West Bengal</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">PAN Number</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="pan_number" value="<?= $res[0]['pan_number']; ?>" required>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Bank Account Name</label>
                                        <input type="text" class="form-control" name="account_name" id="account_name" value="<?= (!empty($res[0]['account_name'])) ? $res[0]['account_name'] : ""; ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Account Number</label>
                                        <input type="number" class="form-control" name="account_number" id="account_number" value="<?= (!empty($res[0]['account_number'])) ? $res[0]['account_number'] : ""; ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Bank's IFSC Code</label>
                                        <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" value="<?= (!empty($res[0]['bank_ifsc_code'])) ? $res[0]['bank_ifsc_code'] : "";  ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name" id="bank_name" value="<?= (!empty($res[0]['bank_name'])) ? $res[0]['bank_name'] : "";  ?>">
                                    </div>
                                </div>
                            </div>

                         <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Latitude</label>
                                        <input type="number" class="form-control" name="latitude" id="latitude" value="<?= $res[0]['latitude']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Longitude</label>
                                        <input type="text" class="form-control" name="longitude" id="longitude" value="<?= $res[0]['longitude']; ?>" disabled>
                                    </div>
                                </div>
                            </div> 


                            <div class="row">
                                <div class="form-group col-md-8">
                                    <div class="form-group">
                                        <label for="description">Store Description :</label>
                                        <textarea name="description" id="description" class="form-control" rows="10"><?php echo $res[0]['store_description']; ?></textarea>
                                        
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
    <div class="modal fade" id='howItWorksModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">How seller commission will get credited?</h4>
                    <hr>
                    <ol>
                        <li>
                            Cron job must be set (For once in a day) on your server for seller commission to be work.
                        </li>
                        <li>
                            Cron job will run every mid night at 12:00 AM.
                        </li>
                        <li>
                            Formula for seller commision is <b>Sub total (Excluding delivery charge) / 100 * seller commission percentage</b>
                        </li>
                        <li>
                            For example sub total is 1378 and seller commission is 20% then 1378 / 100 X 20 = 275.6 so 1378 - 275.6 = 1102.4 will get credited into seller's wallet</b>
                        </li>
                        <li>
                            If Order status is delivered then only seller will get commisison.
                        </li>
                        <li>
                            Ex - 1. Order placed on 11-Aug-21 and product return days are set to 0 so 11-Aug + 0 days = 11-Aug seller commission will get credited on 12-Aug-21 at 12:00 AM (Mid night)
                        </li>
                        <li>
                            Ex - 2. Order placed on 11-Aug-21 and product return days are set to 7 so 11-Aug + 7 days = 18-Aug seller commission will get credited on 19-Aug-21 at 12:00 AM (Mid night)
                        </li>
                        <li>
                            If seller commission doesn't works make sure cron job is set properly and it is working. If you don't know how to set cron job for once in a day please take help of server support or do search for it.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="separator"> </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>


<script>
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
                confirm_password: {
                required: true,
                equalTo: "#password"
                },
                address: "required",
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
                    $('#cat_ids').select2({
                        placeholder: "type in category name to search"
                    });
                    //alert("Profile Updated Successfully");
                    //$('#submit_btn').html('Update');
                    
                    function showpanel() {     
                            

                        location.reload(true);
                    }

                    setTimeout(showpanel, 3000)
                }
            });
        }
    });
</script>
<script type="text/javascript">
    function changePassword() {
        document.getElementById("password").type = "password";
        document.getElementById("confirm_password").type = "password";

    }

    </script>
<?php $db->disconnect(); ?>