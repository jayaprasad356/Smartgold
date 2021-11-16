<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

?>
<?php
if (isset($_POST['btnAdd'])) {
    
   

    // get image info
    $menu_image = $db->escapeString($_FILES['banner_image']['name']);
    $image_error = $db->escapeString($_FILES['banner_image']['error']);
    $image_type = $db->escapeString($_FILES['banner_image']['type']);

    // create array variable to handle error
    $error = array();

    if (empty($banner_name)) {
        $error['banner_name'] = " <span class='label label-danger'>Required!</span>";
    }
    

    // common image file extensions
    $allowedExts = array("gif", "jpeg", "jpg", "png");

    // get image file extension
    error_reporting(E_ERROR | E_PARSE);
    $extension = end(explode(".", $_FILES["banner_image"]["name"]));

    if ($image_error > 0) {
        $error['banner_image'] = " <span class='label label-danger'>Not Uploaded!!</span>";
    } else {
        $result = $fn->validate_image($_FILES["banner_image"]);
        if ($result) {
            $error['banner_image'] = " <span class='label label-danger'>Image type must jpg, jpeg, gif, or png!</span>";
        }
        // $mimetype = mime_content_type($_FILES["banner_image"]["tmp_name"]);
        // if (!in_array($mimetype, array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'))) {
        // 	$error['banner_image'] = " <span class='label label-danger'>Image type must jpg, jpeg, gif, or png!</span>";
        // }
    }

    if (empty($error['banner_image'])) {

        // create random image file name
        $string = '0123456789';
        $file = preg_replace("/\s+/", "_", $_FILES['banner_image']['name']);
        $menu_image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;

        // upload new image
        $upload = move_uploaded_file($_FILES['banner_image']['tmp_name'], 'upload/images/' . $menu_image);

        // insert new data to menu table
        $upload_image = 'upload/images/' . $menu_image;
        
        $sql_query = "INSERT INTO banners (imgUrl)VALUES('$upload_image')";
        $db->sql($sql_query);
        $result = $db->getResult();
        if (!empty($result)) {
            $result = 0;
        } else {
            $result = 1;
        }

        if ($result == 1) {
            $error['add_category'] = " <section class='content-header'><span class='label label-success'>Banner Added Successfully</span></section>";
        } else {
            $error['add_category'] = " <span class='label label-danger'>Failed add category</span>";
        }
    }
   
}
?>
<section class="content-header">
    <h1>Add Banners<small><a href='banners.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to banners</a></small></h1>

    <?php echo isset($error['add_category']) ? $error['add_category'] : ''; ?>
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
                    <h3 class="box-title">Add Banner</h3>

                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data">
                    <div class="box-body">
                       
                        <div class="form-group">
                            <label for="exampleInputFile">Image&nbsp;&nbsp;&nbsp;*Please choose square image of larger than 350px*350px & smaller than 550px*550px.</label><?php echo isset($error['banner_image']) ? $error['banner_image'] : ''; ?>
                            <input type="file" name="banner_image" id="banner_image" required />
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" name="btnAdd">Add</button>
                        <input type="reset" class="btn-warning btn" value="Clear" />

                    </div>

                </form>

            </div><!-- /.box -->
            
        </div>
    </div>
</section>

<div class="separator"> </div>

<?php $db->disconnect(); ?>