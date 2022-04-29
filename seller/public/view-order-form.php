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
$order_id = $_GET['id'];
$sql = "SELECT *,orders.id AS id,orders.status AS status,users.name AS customer_name,products.name AS product_name FROM orders,products,users WHERE orders.product_id = products.id AND orders.user_id = users.id AND orders.id = '" . $order_id . "'";
$db->sql($sql);
$res = $db->getResult();
if($res[0]['buy_method'] == 1){
    $method = "Pick Up at the Store";
}
else if($res[0]['buy_method'] == 2){
    $method = "Delivery at Home";
}
?>
<section class="content-header">
    <h1>View Order</h1>
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
                        <h3 class="box-title">Order Detail</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">ID</th>
                                <td><?php echo $res[0]['id'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Customer Name</th>
                                <td><?php echo $res[0]['customer_name'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Customer Email</th>
                                <td><?php echo $res[0]['email'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Customer Mobile</th>
                                <td><?php echo $res[0]['mobile'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Product Name</th>
                                <td><?php echo $res[0]['product_name']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Total Amount</th>
                                <td><?php echo $res[0]['total']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Delivery Charges</th>
                                <td><?php echo $res[0]['total']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Quantity</th>
                                <td><?php echo $res[0]['quantity']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Buy Method</th>
                                <td><?php echo $method ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Status</th>
                                <td><?php echo $res[0]['status']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Payment Status</th>
                                <td><?php echo $res[0]['payment_status']; ?></td>
                            </tr>

                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <?php
                        if($res [0]['status'] !='Completed'){?>
                            <a href="updateorders.php?id=<?php echo $res[0]['id'] ?>"><button class="btn btn-primary">Update</button></a> 
                        <?php
                        }
                        ?>
                    
                        
                    
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
