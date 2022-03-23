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

$sql_query = "SELECT * FROM seller WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();
?>
<section class="content-header">
    <h1>
        Edit Seller<small><a href='sellers.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Sellers</a></small></h1>

    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
</section>
<style>
    #map {
    height: 350px;
  }
  /* html, body {
    width:550px;
    height:550px;
  } */

  .pac-card {
    
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    background-color: #fff;
    font-family: Roboto;
  }

  #pac-container {
    padding-bottom: 2px;
    margin-right: 12px;
  }

  .pac-controls {
    display: inline-block;
    padding: 5px 11px;
  }

  .pac-controls label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
  }

  #pac-input {
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin: 12px;

    text-overflow: ellipsis;
    width: 400px;
    border: #e0e0e0 1px solid;
  }

  #pac-input:focus {
    outline: none;
  }

  #label {
    color: #fff;
    background-color: #4d90fe;
    font-size: 25px;
    font-weight: 500;
    padding: 6px 12px;
  }

  #location-error {
    display: inline-block;
    padding: 6px;
    background: #e4a7a7;
    border: #d49c9c 1px solid;
    font-size: 1.3em;
    color: #333;
    display:none;
    margin: 12px;
  }
  
    
</style>
<section class="content">
    <!-- Main row -->

    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Seller</h3>
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
                            <div class="pac-card" id="pac-card">
                            <div>
                            <div id="label">
                                Location search
                            </div>       
                            </div>
                            <div id="pac-container">
                            <input id="pac-input" type="text"
                                placeholder="Enter a location"><div id="location-error"></div>
                            </div>
                            </div>

                            </div>
                            <div class="row">
                            <div id="map"></div>
                            <div id="infowindow-content">
                                <img src="" width="16" height="16" id="place-icon">
                                <span id="place-name"  class="title"></span><br>
                                <span id="place-address"></span>
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
                                        <label for="">Latitude</label><i class="text-danger asterik">*</i>
                                        <input type="number" class="form-control" name="latitude" id="latitude" value="<?= $res[0]['latitude']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Longitude</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="longitude" id="longitude" value="<?= $res[0]['longitude']; ?>" required>
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
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="valid" id="valid" value="<?= $res[0]['valid']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <select name="plan" id="plan" onchange="changeplan()" class="form-control">
                                            <option value="0">Select Plan</option>
                                            <option <?=$res[0]['plan'] == 'free-trial' ? ' selected="selected"' : '';?> value="free-trial">Free Trial</option>
                                            <option <?=$res[0]['plan'] == 'basic-monthly' ? ' selected="selected"' : '';?>  value="basic-monthly">Basic Monthly</option>
                                            <option <?=$res[0]['plan'] == 'deluxe-monthly' ? ' selected="selected"' : '';?> value="deluxe-monthly">Deluxe Monthly</option>
                                            <option <?=$res[0]['plan'] == 'premium-monthly' ? ' selected="selected"' : '';?> value="premium-monthly">Premium Monthly</option>
                                            <option <?=$res[0]['plan'] == 'basic-annually' ? ' selected="selected"' : '';?> value="basic-annually">Basic Annually</option>
                                            <option <?=$res[0]['plan'] == 'deluxe-annually' ? ' selected="selected"' : '';?> value="deluxe-annually">Deluxe Annually</option>
                                            <option <?=$res[0]['plan'] == 'premium-annually' ? ' selected="selected"' : '';?> value="premium-annually">Premium Annually</option>
                                       </select>
                                    </div>
                                </div>
                           </div>
                           <div class="row">
                               <div class="form-group col-md-4">
                                    <p class="text-danger" id="resultvalid"></p>

                               </div>
                               
                           </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <div id="status" class="btn-group">
                                            <label class="btn btn-default" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="status" value="0" <?= ($res[0]['status'] == 0) ? 'checked' : ''; ?>> Deactive
                                            </label>
                                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="status" value="1" <?= ($res[0]['status'] == 1) ? 'checked' : ''; ?>> Approved
                                            </label>
                                            <label class="btn btn-danger" data-toggle-class="btn-danger" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="status" value="2" <?= ($res[0]['status'] == 2) ? 'checked' : ''; ?>> Not-Approved
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
                    $('#cat_ids').select2({
                        placeholder: "type in category name to search"
                    });
                    $('#submit_btn').html('Update');
                    location.reload(true);
                }
            });
        }
    });
</script>
<script>
    function changeplan() {
    var value = document.getElementById("plan").value;
    console.log(value);
    if(value == 'free-trial'){
        
        var date = new Date();
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }
        var today = date.addDays(30);
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("valid").value = today;
        document.getElementById("resultvalid").innerHTML = 'Plan Valid Upto - '+today;
    }
    else if(value == 'basic-monthly' || value == 'deluxe-monthly' || value == 'premium-monthly'){
        var date = new Date();
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }
        var today = date.addDays(30);
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        console.log(today)
        document.getElementById("valid").value = today;
        document.getElementById("resultvalid").innerHTML = 'Plan Valid Upto - '+today;
    

    }
    else if(value == 'basic-annually' || value == 'deluxe-annually' || value == 'premium-annually'){
        var date = new Date();
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }
        var today = date.addDays(365);
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("valid").value = today;
        document.getElementById("resultvalid").innerHTML = 'Plan Valid Upto - '+today;
    

    }


    


    }
    
</script>
<script>
    function initMap() {
    	var centerCoordinates = new google.maps.LatLng(37.6, -95.665);
        var map = new google.maps.Map(document.getElementById('map'), {
        center: centerCoordinates,
        zoom: 4
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var infowindowContent = document.getElementById('infowindow-content');
        
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);
        var infowindow = new google.maps.InfoWindow();
        infowindow.setContent(infowindowContent);
        
        var marker = new google.maps.Marker({
          map: map
        });

        autocomplete.addListener('place_changed', function() {
 	        document.getElementById("location-error").style.display = 'none';
            infowindow.close();
            marker.setVisible(false);
        		var place = autocomplete.getPlace();
        		if (!place.geometry) {
        		  	document.getElementById("location-error").style.display = 'inline-block';
        		  	document.getElementById("location-error").innerHTML = "Cannot Locate '" + input.value + "' on map";
        		    return;
        		}
        		
        		map.fitBounds(place.geometry.viewport);
        		marker.setPosition(place.geometry.location);
        		marker.setVisible(true);
        		    
        		infowindowContent.children['place-icon'].src = place.icon;
        		infowindowContent.children['place-name'].textContent = place.name;
        		infowindowContent.children['place-address'].textContent = input.value;
                document.getElementById("latitude").value = place.geometry.location.lat();
                document.getElementById("longitude").value = place.geometry.location.lng();
                //document.getElementById("street").value = place.formatted_address;
            //console.log(place.formatted_address);
            //console.log("lat - "+place.geometry.location.lat() +"lng - " +place.geometry.location.lng());
        		
        		infowindow.open(map, marker);
            
        });
    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXRUNEuXhkWGxiOtrvTSMc91H6L9PM-_M&libraries=places&callback=initMap"
        async defer></script>

    <script type="text/javascript">
    function changePassword() {
        document.getElementById("password").type = "password";
        document.getElementById("confirm_password").type = "password";

    }

    </script>
<?php $db->disconnect(); ?>