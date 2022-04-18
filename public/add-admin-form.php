<?php
include_once('includes/functions.php');
$function = new functions;
include_once('includes/custom-functions.php');
$fn = new custom_functions;

?>
<?php
if (isset($_POST['btnAdd'])) {
    $name = $db->escapeString($_POST['name']);
    $email = $db->escapeString($_POST['email']);
    $password = $db->escapeString($_POST['password']);
    $role = $db->escapeString($_POST['role']);
    $error = array();
    $password = md5($password);


    if(!empty($name) && !empty($email) && !empty($password) && !empty($role) ) {


        $sql = "SELECT * FROM admin WHERE email = '$email'";
		$db->sql($sql);
		$res = $db->getResult();
		$num = $db->numRows($res);
        if($num >= 1){
            $error['add_admin'] = " <span class='label label-danger'>Email Already Exist</span>";
        }
        else{
            $sql_query = "INSERT INTO admin (name,email,password,role,status)VALUES('$name', '$email','$password','$role',1)";
            $db->sql($sql_query);
            $result = $db->getResult();
            if (!empty($result)) {
                $result = 0;
            } else {
                $result = 1;
            }
            if ($result == 1) {
                $error['add_admin'] = " <section class='content-header'><span class='label label-success'>Admin Added Successfully</span></section>";
            } else {
                $error['add_admin'] = " <span class='label label-danger'>Failed</span>";
            }

        }


    

    }
}
?>
<section class="content-header">
    <h1>Add Admin <small><a href='admin-access.php'> <i class='fa fa-angle-double-left'></i>&nbsp;&nbsp;&nbsp;Back to Admin</a></small></h1>

    <?php echo isset($error['add_admin']) ? $error['add_admin'] : ''; ?>
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
                    <h3 class="box-title">Add Admin</h3>

                </div><!-- /.box-header -->
                <!-- form start -->
                <form method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label><i class="text-danger asterik">*</i><?php echo isset($error['name']) ? $error['name'] : ''; ?>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label><i class="text-danger asterik">*</i><?php echo isset($error['email']) ? $error['email'] : ''; ?>
                            <input type="text" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label><i class="text-danger asterik">*</i><?php echo isset($error['password']) ? $error['password'] : ''; ?>
                            <input type="text" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                                    <div class="form-group">
                                        <label class="control-label">Role</label>
                                        <div id="role" class="btn-group">
                                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="role" value="Admin" checked> Admin
                                            </label>
                                            <label class="btn btn-danger" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="role" value="Super Admin" > Super Admin
                                            </label>

                                        </div>
                                    </div>
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