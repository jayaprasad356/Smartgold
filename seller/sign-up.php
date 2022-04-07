<?php 
session_start();
ob_start();
include_once('../includes/crud.php');
$db = new Database;
$db->connect();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/ico" href="../img/logo.png">
    <title>Smart Gold Vendor</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
</head>
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
<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="col-md-4 col-md-offset-4 " style="margin-top:5px;">
        <!-- general form elements -->
        <div class='row'>
            <div class="col-md-12 text-center">
                <img src="../img/logo.png" height="100">
                <h3>Seller Registration form</h3>
            </div>
            <div class="box box-primary col-md-12">
                <!-- form start -->
                <form method="post" action="public/db-operation.php" id="add_seller_form" enctype="multipart/form-data">
                    <input type="hidden" id="add_seller" name="add_seller" required="" value="1" aria-required="true">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="">Name</label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label><i class="text-danger asterik">*</i>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="">Mobile</label><i class="text-danger asterik">*</i><p name="mobilecheckout" id="mobilecheckout" class="text-danger"></p>
                            <input type="number" class="form-control" name="mobile" id="mobile" required>
                        </div>
                        <div class="form-group">
                            <p id="mverifytext" style="display:none" class="text-success"></p>
                        </div>
                        <div class="form-group">
                            <input id="senOtpbtn" type="button" class="btn btn-primary" onclick="sendOtp()" value="Send Otp">
                        </div>
                        <div class="form-group">
                            <div id="recaptcha-container"></div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" placeholder="Verification Code" name="vcode" id="vcode" required> 
                            
                        </div>
                        <div class="form-group">
                            <div class="gone">
                                <input id="verifybtn" type="hidden" class="btn btn-primary" onclick="verifyOtp()" value="Verify">

                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="">Password</label><i class="text-danger asterik">*</i>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label><i class="text-danger asterik">*</i>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                        <div class="form-group">
                            <label for="">Store Name</label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" name="store_name" id="store_name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Store Description :</label><i class="text-danger asterik">*</i>
                            <textarea name="description" id="description" class="form-control" rows="8"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Store URL</label>
                            <input type="url" pattern="https://.*" class="form-control" name="store_url" id="store_url">
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
   
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="street" id="street">
                        </div>
                        <div class="form-group">
                            <label for="">Enter City</label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" id='city' name="city" required>
                        </div>
                        <div class="form-group">
                            <label for="">State</label><i class="text-danger asterik">*</i>
                            
                            <select name="state" id="state" class="form-control">
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
                        <div class="form-group">
                            <label for="">Pincode</label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" id='pincode' name="pincode" required>
                        </div>
                        <div class="form-group">
                            <label for="">PAN Number</label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" name="pan_number" required>
                        </div>
                        <div class="form-group">
                            <label for="">Latitude</label><i class="text-danger asterik">*</i>
                            <input type="number" class="form-control" name="latitude" id="latitude" required>
                        </div>
                        <div class="form-group">
                            <label for="">Longitude</label><i class="text-danger asterik">*</i>
                            <input type="text" class="form-control" name="longitude" id="longitude" required>
                        </div>
                        <div class="form-group">
                            <label for="">National Identity Card</label><i class="text-danger asterik">*</i>
                            <input type="file" class="form-control" name="national_id_card" required>
                        </div>
                        <div class="form-group">
                            <label for="">Address Proof</label><i class="text-danger asterik">*</i>
                            <input type="file" class="form-control" name="address_proof" id="address_proof" required><br>
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo</label><i class="text-danger asterik">*</i>
                            <input type="file" name="store_logo" id="store_logo" required /><br>
                        </div>
                        <!-- <div class="row">
                            <div class="form-group col-md-12">
                                <input type="checkbox" id="agreed" name="agreed" value="1" required> By clicking Sign Up, you agree to our <a href='../seller-play-store-terms-conditions.php' target='_blank' >Terms & Conditions</a> and that you have read our <a href='../seller-play-store-privacy-policy.php' target='_blank' >Privacy & Policy</a>.
                            </div>
                        </div> -->
                        <div class="box-footer">
                            <button type="submit" id="submit_btn" name="btnSignUp" class="btn btn-info">Sign Up</button>
                            <input type="reset" class="btn-warning btn" value="Clear" />
                            <a href="index.php" class="btn pull-right">Back to Login Page?</a>
                        </div>
                        <div class="form-group">
                            <div id="result" style="display: none;"></div>
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</body>

</html>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script>
        $('#add_seller_form').validate({
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
            address: "required",
            description: "required",
            require_products_approval: "required",
            status: "required",
            latitude: "required",
            longitude: "required",
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
    
</script>
<script>
    $('#add_seller_form').on('submit', function(e) {
        e.preventDefault();
        if(document.getElementById("mverifytext").innerHTML == "Mobile Number Verified"){
            if(document.getElementById("mobilecheckout").innerHTML == ""){
                document.getElementById("mobile").disabled = false;
                var formData = new FormData(this);
                if ($("#add_seller_form").validate().form()) {
                    
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
                            $('#submit_btn').html('Submit');
                            $('#add_seller_form')[0].reset();
                            document.getElementById( 'mverifytext' ).style.display = 'none';
                            document.getElementById("mverifytext").innerHTML = ""
                            document.getElementById("senOtpbtn").type = "button";
                            
                            //window.location = "../seller/index.php";


                        }
                    });
                }else{
                    document.getElementById("mobile").disabled = true;

                }

            }
            else{
                alert("Mobile Number Already Registered !")


            }


        }
        else{
            alert("Please Verify Your Mobile Number !")
        }
        
    });
</script>
<script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
  <script type="text/javascript">
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyAFCnGf6H7TjrwAhAhr_Zg6umPpoZBjhjg",
    authDomain: "smartgold-a0c76.firebaseapp.com",
    projectId: "smartgold-a0c76",
    storageBucket: "smartgold-a0c76.appspot.com",
    messagingSenderId: "900414686957",
    appId: "1:900414686957:web:92e9e0509aada7454feee4",
    measurementId: "G-HBNFGSCR8G"
  };
  firebase.initializeApp(config);
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('input[name=mobile]').change(function() {
            console.log($('#mobile').val());
            var myVar = $('#mobile').val();
            
            $.ajax({
            url: "sellermobileexist.php",
            type: "POST",
            data:{"mobile":myVar}
            }).done(function(data) {
                console.log(data);
                if(data == "success"){
                    $("#mobilecheckout").html("");
                }else{
                    $("#mobilecheckout").html("Mobile Number Already Registered");
                }
            
            }).fail(function(data){
                console.log("Try again");
            });
            
        });
});
</script>
<script type="text/javascript">
function sendOtp() {
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    firebase.auth().signInWithPhoneNumber("+91"+document.getElementById("mobile").value, window.recaptchaVerifier) 
    .then(function(confirmationResult) {
        window.confirmationResult = confirmationResult;
        document.getElementById("vcode").type = "number";
        document.getElementById("verifybtn").type = "button";
        console.log(confirmationResult);
    });

}
function verifyOtp() {

    window.confirmationResult.confirm(document.getElementById("vcode").value)
    .then(function(result) {

        document.getElementById("vcode").type = "hidden";
        document.getElementById("verifybtn").type = "hidden";
        document.getElementById("recaptcha-container").style.display = "none";
        document.getElementById("mverifytext").innerHTML = "Mobile Number Verified";
        document.getElementById("mverifytext").style = "";
        document.getElementById("senOtpbtn").type = "hidden";
        document.getElementById("mobile").disabled = true;
      console.log(result);
    }).catch(function(error) {
      console.log(error);
    });

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
                getlocatedata(place.geometry.location.lat(),place.geometry.location.lng())
        		
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