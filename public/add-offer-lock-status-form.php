<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

?>
<?php
if (isset($_POST['btnAdd'])) {
    $title = $db->escapeString($_POST['title']);
   


    // create array variable to handle error
    $error = array();

    if (empty($title)) {
        $error['title'] = " <span class='label label-danger'>Required!</span>";
    }


    if (!empty($title)) {
        $sql_query = "INSERT INTO offer_lock_status (title,status)VALUES('$title',1)";
        $db->sql($sql_query);
        $result = $db->getResult();
        if (!empty($result)) {
            $result = 0;
        } else {
            $result = 1;
        }
        if ($result == 1) {
            $error['add_offer_lock_status'] = " <section class='content-header'><span class='label label-success'>Offer Lock Status Added Successfully</span></section>";
        } else {
            $error['add_offer_lock_status'] = " <span class='label label-danger'>Failed</span>";
        }
    }

}
?>
<section class="content-header">
    <h1>Add Offer Lock Status <small><a href='offer-lock-status.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Offer Lock Status</a></small></h1>

    <?php echo isset($error['add_offer_lock_status']) ? $error['add_offer_lock_status'] : ''; ?>
    <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i> Home</a></li>
    </ol>
    <hr />
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Offer Lock Status</h3>

                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Offer Lock Status</label><i class="text-danger asterik">*</i><?php echo isset($error['title']) ? $error['title'] : ''; ?>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btnAdd">Add</button>
                        <!-- <input type="reset" class="btn-warning btn" value="Clear" /> -->

                    </div>

                </form>

            </div><!-- /.box -->
            
        </div>
    </div>
</section>

<div class="separator"> </div>

<?php $db->disconnect(); ?>