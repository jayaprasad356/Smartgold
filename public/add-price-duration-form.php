<?php
if (isset($_POST['btnAdd'])) {
    $price = $db->escapeString($_POST['price']);
    $days = $db->escapeString($_POST['days']);
    
    $sql_query = "UPDATE settings SET price = '" . $price . "' , days = '" . $days . "' WHERE id = 1";
    $db->sql($sql_query);
    echo( "<section class='content-header'><span class='label label-success'> Price and Duration Updated</span></section>");
    
}
$sql = "SELECT * FROM settings";
$db->sql($sql);
$res = $db->getResult();
?>
<section class="content-header">
    <h1>Add Price/Duration <small><a href="home.php"><i class="fa fa-home"></i> Home</a></small></h1>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Price/Duration</h3>

                    </div><!-- /.box-header -->

                    <form method="post" id="add_form"  enctype="multipart/form-data">
                        <input type="hidden" id="add_seller" name="add_seller" required="" value="1" aria-required="true">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Enter Price</label>
                                        <input type="text" class="form-control" name="price" id="name" value="<?php echo $res[0]['price'] ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Enter days</label>
                                        <input type="text" class="form-control" name="days" id="name" value="<?php echo $res[0]['days'] ?>" required>
                                    </div>
                                </div>
                                
                            
                            
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" id="submit_btn" name="btnAdd">Update</button>
                            <input type="reset" class="btn-warning btn" value="Clear" />
                            <div id="result" style="display: none;"></div>
                        </div>
                    </form>

                </div><!-- /.box -->
            
                
            
        </div>
    </div>
</section>

<div class="separator"> </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>

<script type="text/javascript" src="css/js/ckeditor/ckeditor.js"></script>

