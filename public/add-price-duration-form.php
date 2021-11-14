<?php
if (isset($_POST['btnAdd'])) {
    $price = $db->escapeString($_POST['price']);
    $days = $db->escapeString($_POST['days']);
    $sql_query = "INSERT INTO settings (price,days)VALUES('$price',$days)";
    $db->sql($sql_query);
    echo('Price and Duration Added');
}
?>
<section class="content-header">
    <h1>Add Price/Duration <small><a href='smart gold settings.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Settings</a></small></h1>
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
                                        <input type="text" class="form-control" name="price" id="name" required>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label for="">Enter days</label>
                                        <input type="text" class="form-control" name="days" id="name" required>
                                    </div>
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
</section>

<div class="separator"> </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>

<script type="text/javascript" src="css/js/ckeditor/ckeditor.js"></script>

