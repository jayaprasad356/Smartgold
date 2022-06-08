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
$sql_query = "SELECT id, name FROM category";
$db->sql($sql_query);
$sql_query = "SELECT * FROM today_gold";
$db->sql($sql_query);

$res = $db->getResult();

?>
<section class="content-header">
    <h1>Add Product</h1>
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
                    <h3 class="box-title">Add Product</h3>
                </div>
                <div class="box-header">
                    <?php echo isset($error['cancelable']) ? '<span class="label label-danger">Till status is required.</span>' : ''; ?>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form id='add_product_form' action="public/db-operation.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="add_product" name="add_product" required="" value="1" aria-required="true">
                    <input type="hidden" id="seller_id" name="seller_id" required="" value="<?php echo $ID ?>" aria-required="true">
                    <input type="hidden" id="todayprice" name="todayprice" required="" value="<?php echo $res[0]['price'] ?>" aria-required="true">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label> <i class="text-danger asterik">*</i><?php echo isset($error['name']) ? $error['name'] : ''; ?>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="category_id">Category :</label> <i class="text-danger asterik">*</i>
                                <select name="category_id" id="category_id" onchange="changeCategory()" class="form-control" required>
                                    <option value="">--Select Category--</option>
                                    <?php foreach ($res as $row) { ?>
                                        
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php 
                                    } ?>     
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4">
                                    <div class="form-group packate_div">
                                        <label for="qty">Stock:</label> <i class="text-danger asterik">*</i>
                                        <input type="number" step="any" min="0" class="form-control" name="stock" required="" />
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group packate_div">
                                        <label for="weight">Gross Weight (in grams)</label><i class="text-danger asterik">*</i>
                                        <input type="number" step="any" min='0' class="form-control weight" name="weight" id="weight" required />
                                    </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                    <div class="form-group packate_div">
                                        <label for="weight"> Stone Detail Price</label><i class="text-danger asterik">*</i>
                                        <input type="number" step="any" min='0' class="form-control detail_price" name="detail_price" id="detail_price" required />
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group packate_div">
                                        <label for="weight"> Making Charges (%)</label><i class="text-danger asterik">*</i>
                                        <input type="number" step="any" min='0' class="form-control mcharges" name="making_charges" id="making_charges" required />
                                    </div>
                            </div>

                        </div>

                        <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group packate_div">
                                        <label for="discounted_price">Discount In (%):</label>
                                        <input type="number" step="any" min='0' class="form-control discounted_percentage" name="discounted_percentage"  id="discounted_percentage" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group packate_div">
                                        <label for="gst">GST(%):</label> <i class="text-danger asterik">*</i>
                                        <input type="number" step="any" min='0' value="3" class="form-control gst" name="gst" id="gst" required />
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-danger">Today Gold Price : ₹<b><?php echo $res[0]['price'] ?></b>/gram</p>
                            </div>
                            
                        </div>
                        <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group packate_div">
                                        <label for="price">Total Price (₹):</label>
                                        <input type="number" step="any"  min='0' class="form-control price" name="price" id="price" readonly required />
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group packate_div">
                                        <label for="discounted_price">Discounted Price(₹):</label>
                                        <input type="number" step="any" min='0' class="form-control discounted_price" name="discounted_price" value="" id="discounted_price" readonly />
                                    </div>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-md-6">
                                    <label for="gender">Gender :</label><i class="text-danger asterik">*</i>
                                    <select  name="gender" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female" selected>Female</option>
                                        <option value="Kids" >Kids</option>
                                        <option value="Unisex" >Unisex</option>
                                    </select>
                                </div>

                        </div>
                        <div class="form-group">
                            <label for="image">Main Image : <i class="text-danger asterik">*</i>&nbsp;&nbsp;&nbsp;*Please choose square image of larger than 350px*350px & smaller than 550px*550px.</label><?php echo isset($error['image']) ? $error['image'] : ''; ?>
                            <input type="file" onchange="readURL(this);" name="image" accept="image/png,  image/jpeg" id="image" required>
                        </div>
                        <div class="form-group">
                            <img id="blah" src="#" alt="product image" />

                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description :</label>
                            <textarea name="description" id="description" class="form-control" rows="8"></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <div class="col-md-6">
                                    <label for="status">Product Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <p class="text-danger">Disclaimer : *Weight and Price may vary subject to the stock available.</p>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <!-- <div class="box-footer">
                        <input type="submit" class="btn-primary btn" value="Add" name="btnAdd" />&nbsp;
                        <input type="reset" class="btn-danger btn" value="Clear" id="btnClear" />
                       <div  id="res"></div>
                    </div> -->
                    <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="submit_btn" name="btnAdd">Add</button>
                            <input type="reset" class="btn-warning btn" value="Clear" />
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
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
<script>
    function setTotal(){
        let weight = $('#weight').val();
        let todayprice = $('#todayprice').val(); 
        let making_charges = $('#making_charges').val(); 
        let gst = $('#gst').val(); 
        let discountedpercent = $('#discounted_percentage').val(); 
        let detail_price = $('#detail_price').val(); 
        if(discountedpercent == ''){
            discountedpercent = 0;
        }
        if(weight != '' && todayprice != '' && making_charges != '' && gst != '' && detail_price != ''){
            let weightprice,makeprice,gstprice,totalprice,grandtotal,discountedprice,finaltotal,billingtotal,actualtotal,actualgstprice;
            weightprice = (parseFloat(weight) * parseFloat(todayprice)).toFixed(2);
            makeprice = parseFloat(making_charges)/100 * parseFloat(weightprice);
            totalprice = parseFloat(weightprice) + parseFloat(makeprice);
            grandtotal = parseFloat(totalprice) + parseFloat(detail_price);
            discountedprice = parseFloat(discountedpercent)/100 * parseFloat(grandtotal);
            finaltotal = parseFloat(grandtotal) - parseFloat(discountedprice);
            gstprice = parseFloat(gst)/100 * parseFloat(finaltotal);
            billingtotal = parseFloat(finaltotal) + parseFloat(gstprice);
            actualgstprice = parseFloat(gst)/100 * parseFloat(grandtotal);
            actualtotal = parseFloat(grandtotal) + parseFloat(actualgstprice);

            $('#price').val(actualtotal);
            $('#discounted_price').val(billingtotal);

        }
        else{
            $('#price').val('');
            $('#discounted_price').val('');

        }

    }
</script>

<script>
    $(document).on('input', '.weight', function(){
        setTotal();


    });
    $(document).on('input', '.detail_price', function(){
        setTotal();


    });
    $(document).on('input', '.mcharges', function(){
        setTotal();


    });
    $(document).on('input', '.discounted_percentage', function(){
        setTotal();


    });
    $(document).on('input', '.gst', function(){
        setTotal();


    });
    // $(document).on('input', '.mcharges', function(){
    //     let mcharges = $('#mcharges').val();
    //     let todayprice = $('#todayprice').val();
    //     let weight = $('#weight').val();
    //     let todayprice = $('#todayprice').val();  

    //     if(weight != '' && todayprice != '' && mcharges != '' && price != ''){
    //         var totalprice;
    //         totalprice = (parseFloat(weight) * parseFloat(todayprice)).toFixed(2);
    //         $('#price').val(totalprice);

    //     }
    //     else{
    //         $('#price').val('');

    //     }

    // });
    // $(document).on('input', '.discounted_percentage', function(){
    //     let dp = $('#discounted_percentage').val();
    //     let price = $('#price').val(); 
    //     let gst = $('#gst').val(); 

    //     if(price != '' && dp != ''&& gst != ''){
    //         var sale,gstval,discount;
    //         sale = calculateSale(price, dp);
    //         gstval = gst / 100 * sale;
    //         discount = parseFloat(sale) + parseFloat(gstval);
    //         $('#discounted_price').val(discount);

    //     }
    //     else{
    //         $('#discounted_price').val('');

    //     }

    // });
    // $(document).on('input', '.price', function(){
    //     let dp = $('#discounted_percentage').val();
    //     let price = $('#price').val(); 
    //     let gst = $('#gst').val(); 

    //     if(price != '' && dp != ''&& gst != ''){
    //         var sale,gstval,discount;
    //         sale = calculateSale(price, dp);
    //         gstval = gst / 100 * sale;
    //         discount = parseFloat(sale) + parseFloat(gstval);
    //         $('#discounted_price').val(discount);

    //     }
    //     else{
    //         $('#discounted_price').val('');

    //     }
    // });
    // $(document).on('input', '.gst', function(){
    //     let dp = $('#discounted_percentage').val();
    //     let price = $('#price').val(); 
    //     let gst = $('#gst').val(); 

    //     if(price != '' && dp != ''&& gst != ''){
    //         var sale,gstval,discount;
    //         sale = calculateSale(price, dp);
    //         gstval = gst / 100 * sale;
    //         discount = parseFloat(sale) + parseFloat(gstval);
    //         $('#discounted_price').val(discount);

    //     }
    //     else{
    //         $('#discounted_price').val('');

    //     }
    // });
    // const calculateSale = (listPrice, discount) => {
    //     listPrice = parseFloat(listPrice);
    //     discount  = parseFloat(discount);
    //     return (listPrice - ( listPrice * discount / 100 )).toFixed(2); // Sale price
    // }
</script>

<script>
    $('#add_product_form').validate({
        rules: {
            name: "required",
            price: "required",
            quantity: "required"

        }
    });
    $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
    });
</script>
<script>
        $('#add_product_form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        if ($("#add_product_form").validate().form()) {
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
                       
                        $('#submit_btn').html('Add');
                    
                        $('#add_product_form')[0].reset();
                        $('#result').show();

                          // place this within dom ready function
                        function showpanel() {     
                            

                            window.location.replace("add-product.php");
                        }

                        setTimeout(showpanel, 3000)
                    }
                });
            }


    });
</script>
<script>
    function changeCategory() {
        var category_id = document.getElementById("category_id").value;
        if(category_id == 12){
            document.getElementById("weight").value = 0;
            document.getElementById("weight").disabled = true;

        }

    }
</script>