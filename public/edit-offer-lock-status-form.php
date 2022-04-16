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

$sql_query = "SELECT * FROM offer_lock_status WHERE id =" . $ID;
$db->sql($sql_query);
$res = $db->getResult();
?>
<section class="content-header">
    <h1>
        Edit Offer Lock Status<small><a href='offer-lock-status.php'><i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Offer Lock Status</a></small></h1>

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
                        <h3 class="box-title">Edit Offer Lock Status</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="edit_form" method="post" action="public/db-operation.php" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" id="update_offer_lock_status" name="update_offer_lock_status" required="" value="1" aria-required="true">
                            <input type="hidden" id="update_id" name="update_id" required value="<?= $ID; ?>">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Title</label><i class="text-danger asterik">*</i>
                                        <input type="text" class="form-control" name="title" id="name" value="<?= $res[0]['title']; ?>" required>
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
                    alert("Offer Lock Status Updated Successfully")
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
        var today = date.addDays(364);
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
        		    
        		infowindowContent.children['place-icon'].src = place.icon;
        		infowindowContent.children['place-name'].textContent = place.name;
        		infowindowContent.children['place-address'].textContent = input.value;
                document.getElementById("latitude").value = place.geometry.location.lat();
                document.getElementById("longitude").value = place.geometry.location.lng();
                document.getElementById("street").value = place.formatted_address;
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