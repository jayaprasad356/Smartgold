<?php

date_default_timezone_set('Asia/Kolkata');

// session_start();

$user_id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$db->sql($sql);
$res = $db->getResult();

?>
<section class="content-header">
    <h1>View Customer</h1>
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
                        <h3 class="box-title">Customer Detail</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">ID</th>
                                <td><?php echo $res[0]['id'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px"> Name</th>
                                <td><?php echo $res[0]['name'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px"> Email Id</th>
                                <td><?php echo $res[0]['email'] ?></td>
                            </tr>
                            <tr>
                                <th style="width: 200px"> Mobile Number</th>
                                <td><?php echo $res[0]['mobile'] ?></td>
                            </tr>
                            <?php
                            $sql = "SELECT * FROM address WHERE user_id = '$user_id'";
                            $db->sql($sql);
                            $resad = $db->getResult();
                            $index = 1;
                            foreach ($resad as $row) {
                            ?>
                            <tr>
                                <th style="width: 200px">Address  <?php echo $index ?></th>
                                <td><?php echo $row['name'].$row['address'].$row['landmark'].$row['area'].$row['city'].$row['pincode']; ?></td>
                            </tr>
                            <?php
                            $index++;
                            }
                            ?>
                            

                            <th style="color:red">Orders List</th>
                            <?php
                            $sql = "SELECT *,orders.id AS id FROM orders,products WHERE orders.user_id = '$user_id' AND orders.product_id = products.id";
                            $db->sql($sql);
                            $resad = $db->getResult();
                            $index = 1;
                            foreach ($resad as $row) {
                            ?>
                            <tr>
                                <th style="width: 200px">Order Id  <?php echo $index ?></th>
                                <td><?php echo 'Product Id - ' . $row['product_id'] .', Product Name - ' . $row['name']. ', Quantity - ' . $row['quantity']. ', Buy Method - ' . $row['buy_method'].', Status - ' . $row['status']. ', Delivery Charges - ' . $row['delivery_charges'].', Payment Status - ' . $row['payment_status']. ', Total - ' . $row['total'] ?></td>
                            </tr>
                            <?php
                            $index++;
                            }
                            ?>

                           <th style="color:blue">Offers List</th>
                            <?php
                            $sql = "SELECT *,offer_lock.id AS id FROM offers,offer_lock WHERE offer_lock.user_id = '$user_id' AND offers.id = offer_lock.offer_id";
                            $db->sql($sql);
                            $resad = $db->getResult();
                            $index = 1;
                            foreach ($resad as $row) {
                            ?>
                            <tr>
                               
                                <th style="width: 200px">Offers  <?php echo $index ?></th>
                                <td><?php echo 'Seller Id - ' . $row['seller_id'] .', Budget Id - ' . $row['budget_id']. ', Gram Price- ' . $row['gram_price']. ', Wastage - ' . $row['wastage'].', Max Locked - ' . $row['max_locked']. ', Status - ' . $row['status'].', Paid Amount - ' . $row['paid_amt'].', User Id -'.$row['user_id']?></td>
                            </tr>
                            <?php
                            $index++;
                            }
                            ?>

                        

                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">

                    
                        
                    
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
