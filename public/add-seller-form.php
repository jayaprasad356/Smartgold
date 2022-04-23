<section class="content-header">
    <h1>Add Seller <small><a href='sellers.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Sellers</a></small></h1>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
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
                                        <label for="">Name</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Email</label><i class="text-danger asterik">*</i>
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Mobile</label><i class="text-danger asterik">*</i><small name="mobilecheckout" id="mobilecheckout" class="text-danger"></small>
                                        <input type="number" class="form-control mobilecheck" name="mobile" id="mobile" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Store URL</label>
                                        <input type="url" pattern="https://.*" class="form-control" name="store_url" id="store_url">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Password</label><i class="text-danger asterik">*</i>
                                        <input type="password" class="form-control" name="password" id="password" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Confirm Password</label><i class="text-danger asterik">*</i>
                                        <input type="password" class="form-control" name="confirm_password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Store Name</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="store_name" id="store_name" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="logo">Logo</label><i class="text-danger asterik">*</i>
                                        <input type="file" name="store_logo" accept="image/png,  image/jpeg" id="store_logo" required /><br>
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
                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input type="text" class="form-control" name="street" id="street">
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Pincode</label><i class="text-danger asterik">*</i>
                                        <input type="number" class="form-control" id='pincode' name="pincode"  required>
                                    </div>
                                    
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">City</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" id='city' name="city" required>
                                    </div>
                                    
                                </div>
                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">State</label><i class="text-danger asterik">*</i>
                                        
                                        <select name="state" id="state" class="form-control">
                                            <option value="">Select State</option>
                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option value="Assam">Assam</option>
                                            <option value="Bihar">Bihar</option>
                                            <option value="Chandigarh">Chandigarh</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                            <option value="Daman and Diu">Daman and Diu</option>
                                            <option value="Delhi">Delhi</option>
                                            <option value="Lakshadweep">Lakshadweep</option>
                                            <option value="Puducherry">Puducherry</option>
                                            <option value="Goa">Goa</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Haryana">Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                            <option value="Jharkhand">Jharkhand</option>
                                            <option value="Karnataka">Karnataka</option>
                                            <option value="Kerala">Kerala</option>
                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Manipur">Manipur</option>
                                            <option value="Meghalaya">Meghalaya</option>
                                            <option value="Mizoram">Mizoram</option>
                                            <option value="Nagaland">Nagaland</option>
                                            <option value="Odisha">Odisha</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Sikkim">Sikkim</option>
                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                            <option value="Telangana">Telangana</option>
                                            <option value="Tripura">Tripura</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option value="Uttarakhand">Uttarakhand</option>
                                            <option value="West Bengal">West Bengal</option>
                                        </select>

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
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">PAN Number</label><i class="text-danger asterik">*</i><p id="pan_valid" class="text-danger"></p>
                                        <input type="text" class="form-control pan_number" name="pan_number" id="pan_number" required>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">GST Number</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="gst_number" required>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">National Identity Card</label><i class="text-danger asterik">*</i>
                                        <input type="file" class="form-control" accept="image/png,  image/jpeg" name="national_id_card" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Address Proof</label><i class="text-danger asterik">*</i>
                                        <input type="file" class="form-control" accept="image/png,  image/jpeg" name="address_proof" id="address_proof" required><br>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Latitude</label><i class="text-danger asterik">*</i>
                                        <input type="number" class="form-control" name="latitude" id="latitude" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Longitude</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="longitude" id="longitude" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <div class="form-group">
                                        <label for="description">Store Description :</label><i class="text-danger asterik">*</i>
                                        <textarea name="description" id="description" class="form-control" rows="8"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="valid" id="valid">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <select name="plan" id="plan" onchange="changeplan()" class="form-control">
                                            <option value="">Select Plan</option>
                                            <option value="free-trial">Free Trial</option>
                                            <option value="basic-monthly">Basic Monthly</option>
                                            <option value="deluxe-monthly">Deluxe Monthly</option>
                                            <option value="premium-monthly">Premium Monthly</option>
                                            <option value="basic-quarterly">Basic Quarterly</option>
                                            <option value="deluxe-quarterly">Deluxe Quarterly</option>
                                            <option value="premium-quarterly">Premium Quarterly</option>
                                            <option value="basic-annually">Basic Annually</option>
                                            <option value="deluxe-annually">Deluxe Annually</option>
                                            <option value="premium-annually">Premium Annually</option>
                                       </select>
                                       <a href="#" data-toggle='modal' data-target='#howItWorksModal' title='How it works'><u>Click to View Plan Details</u></a>
                                       
                                        
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
    <div class="modal fade" id='howItWorksModal'  role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Smart Gold Plan List</h4>
                    <hr>
                    <ul>
                        <li>
                            <b>Free Trial</b>
                            <big>30 Days</big>
                            
                        </li>
                        <?php
                            $sql = "SELECT * FROM plans";
                            $db->sql($sql);
                            $res = $db->getResult();
                            foreach ($res as $row) {
                                if($row['validity'] == '1'){
                                    $months = 'Month';

                                }
                                else {
                                    $months = 'Months';

                                }
                        ?>
                        <li>
                            <b><?= $row['name'].'-'.$row['validity'].' '.$months ?></b>
                            <big>₹ <?= $row['price'] ?></big>
                            <p><?= $row['products'] ?> Products in Inventory <br><?= $row['offers'] ?> Offers in a Month <br><?= $row['access'] ?> Admin Access</p>
                        </li>
                        <?php
                            }

                        ?>
                        
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="separator"> </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>

<script type="text/javascript" src="css/js/ckeditor/ckeditor.js"></script>
<script>
    $('#add_form').validate({
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
            password: "required",
            valid: "required",
            address: "required",
            description: "required",
            state: "required",
            plan: "required",
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

    $('#add_form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        if(document.getElementById("mobilecheckout").innerHTML == ''){
            if ($("#add_form").validate().form()) {
                if(document.getElementById("pan_valid").innerHTML == ""){
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
                            document.getElementById("resultvalid").innerHTML = '';
                        }
                    });

                }
                else{
                    alert("Pan Number Invalid");
                }

            }

        }
        
        else{
            alert("Mobile Number Already Registered");

        }
    });
</script>
<script>
    $(document).on('input', '.pan_number', function(){
        var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/; 
    
        let pan_number = $('#pan_number').val();
      
        if (pan_number.length == 10 ) { 
            if( pan_number.match(regExp) ){ 
                $('#pan_valid').html('');
                    }
            else {
                $('#pan_valid').html('Not a valid PAN number');
         
            } 
        } 
        else { 
            $('#pan_valid').html('Please enter 10 digits for a valid PAN number');
            
        } 
    });
</script>
<script type="text/javascript">
    $(document).on('input', '.mobilecheck', function(){
        var myVar = $('#mobile').val();
        if(myVar != ''){
            $.ajax({
            url: "sellermobileexist.php",
            type: "POST",
            data:{"mobile":myVar}
            }).done(function(data) {
                console.log(data);
                if(data == "success"){
                    $("#mobilecheckout").html("");
                }else{
                    console.log(data);
                    $("#mobilecheckout").html("Mobile Number Already Registered");
                }
            
            }).fail(function(request){
                console.log(request.responseText);
                if(request.responseText == "success"){
                    $("#mobilecheckout").html("");
                }else{
                    
                    $("#mobilecheckout").html("Mobile Number Already Registered");
                }
            });

        }

    });
</script>
<script type="text/javascript">

var geocoder = new google.maps.Geocoder();
var address = "new york";

geocoder.geocode( { 'address': address}, function(results, status) {

  if (status == google.maps.GeocoderStatus.OK) {
    var latitude = results[0].geometry.location.lat();
    var longitude = results[0].geometry.location.lng();
    alert(latitude);
  } 
}); 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.0/moment.min.js"></script>
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
        var longDateStr = moment(today, 'Y-M-D').format('DD,MMMM');
        document.getElementById("resultvalid").innerHTML = 'Plan Valid Upto : '+longDateStr+","+yyyy;
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
        var longDateStr = moment(today, 'Y-M-D').format('DD,MMMM');
        document.getElementById("resultvalid").innerHTML = 'Plan Valid Upto : '+longDateStr+","+yyyy;

    }
    else if(value == 'basic-quarterly' || value == 'deluxe-quarterly' || value == 'premium-quarterly'){
        var date = new Date();
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }
        var today = date.addDays(90);
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        console.log(today)
        document.getElementById("valid").value = today;
        var longDateStr = moment(today, 'Y-M-D').format('DD,MMMM');
        document.getElementById("resultvalid").innerHTML = 'Plan Valid Upto : '+longDateStr+","+yyyy;

    }
    else if(value == 'basic-annually' || value == 'deluxe-annually' || value == 'premium-annually'){
        var date = new Date();
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }
        var today = date.addDays(364);
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("valid").value = today;
        var longDateStr = moment(today, 'Y-M-D').format('DD,MMMM');
        document.getElementById("resultvalid").innerHTML = 'Plan Valid Upto : '+longDateStr+","+yyyy;
    

    }else {
        document.getElementById("resultvalid").innerHTML = '';

    }


    


    }
    
</script>
<script>
    function initMap() {
    	var centerCoordinates = new google.maps.LatLng(20.5937, 78.9629);
        var map = new google.maps.Map(document.getElementById('map'), {
        center: centerCoordinates,
        zoom: 5
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
                
                
                document.getElementById("latitude").value = place.geometry.location.lat();
                document.getElementById("longitude").value = place.geometry.location.lng();
                
                getlocatedata(place.geometry.location.lat(),place.geometry.location.lng())
                //document.getElementById("pincode").value = place.address[address.length - 1].long_name
                
                
        		
        		infowindow.open(map, marker);
            
        });
    }
    </script>
    <script>
        function getlocatedata(lat,lng) {
            var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + lng + "&key=AIzaSyDXRUNEuXhkWGxiOtrvTSMc91H6L9PM-_M";
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                success: function (msg) {
                    var results = msg.results;
                    var address = results[0].address_components;
                    var zipcode = address[address.length - 1].long_name;
                    var state = address[address.length - 3].long_name;
                    var city = address[address.length - 5].long_name;

                    var add= results[0].formatted_address ;
                    var addvalue=add.split(",");
                    var count=addvalue.length;
                    //var state=addvalue[count-2];
                    //var city=addvalue[count-3];
                    //var zip = results[0].address_components[8].long_name;
                    document.getElementById("street").value = add;

                    document.getElementById("pincode").value = zipcode;
                    document.getElementById("city").value = city;
                    document.getElementById("state").value = state;
                },
                error: function (req, status, error) {
                    //alert('Sorry, an error occurred.');
                    console.log(req.responseText);
                }
            });
            

        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXRUNEuXhkWGxiOtrvTSMc91H6L9PM-_M&libraries=places&callback=initMap"
        async defer></script>