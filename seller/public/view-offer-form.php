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
$sql_query = "SELECT * FROM offers WHERE id = '$offer_id'";
$db->sql($sql_query);
$res = $db->getResult();
if($res[0]['status'] == 0){
    $status = "Deactive";
}
else if($res[0]['status'] == 1){
    $status = "Active";
}
if($res[0]['budget_id'] == 1){
    $budget = "upto 1 lakh";
}
else if($res[0]['budget_id'] == 2){
    $budget = "1 lakh to 5 lakhs";
}
else if($res[0]['budget_id'] == 3){
    $budget = "5 lakhs to 10 lakhs";
}
else if($res[0]['budget_id'] == 4){
    $budget = "above 10 lakhs";
}

?>
<section class="content-header">
    <h1>Offer Detail</h1>
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
                        <h3 class="box-title">Offer Detail</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">ID</th>
                                <td><?php echo $res[0]['id']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Budget</th>
                                <td><?php echo $budget ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Discount Per Gram(₹)</th>
                                <td><?php echo $res[0]['gram_price']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Discount On Wastage(%)</th>
                                <td><?php echo $res[0]['wastage']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Maximum Locked Items</th>
                                <td><?php echo $res[0]['max_locked']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Fine Print Description</th>
                                <td><?php echo $res[0]['description']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Valid Date</th>
                                <td><?php echo $res[0]['valid_date']; ?></td>
                            </tr>
                            <tr>
                                <th style="width: 10px">Status</th>
                                <td><?php echo $status; ?></td>
                            </tr>

                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <a href="edit-offer.php?id=<?php echo $res[0]['id'] ?>"><button class="btn btn-primary">Edit</button></a>
                    
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
