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
$offer_id = $_GET['id'];
$sql_query = "SELECT * FROM products WHERE id = '$offer_id'";
$db->sql($sql_query);
$res = $db->getResult();
if($res[0]['status'] == 0){
    $status = "Deactive";
}
else if($res[0]['status'] == 1){
    $status = "Active";
}
$catid = $res[0]['category_id'];
$sql_query = "SELECT * FROM category WHERE id = '$catid'";
$db->sql($sql_query);
$cat = $db->getResult();


?>
<section class="content-header">
    <h1>Product Detail</h1>
    <?php echo isset($error['add_menu']) ? $error['add_menu'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>

</section>
<section class="content">
<div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product Detail</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">ID</th>
                                <td><?php echo $res[0]['id'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Name</th>
                                <td><?php echo $res[0]['name'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Category</th>
                                <td><?php echo $cat[0]['name']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Description</th>
                                <td><?php echo $res[0]['description']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Price</th>
                                <td><?php echo $res[0]['price']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Discounted Price</th>
                                <td><?php echo $res[0]['discounted_price']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Stock</th>
                                <td><?php echo $res[0]['stock']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Gender</th>
                                <td><?php echo $res[0]['gender']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Weight</th>
                                <td><?php echo $res[0]['weight']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Status</th>
                                <td><?php echo $status; ?></td>
                            </tr>

                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="edit-product.php?id=<?php echo $res[0]['id'] ?>"><button class="btn btn-primary">Edit</button></a>
                    
                    </div>
                </div><!-- /.box -->
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