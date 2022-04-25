<?php
if (isset($_POST['btnLogin'])) {
	

    $email = $db->escapeString($_POST['email']);
    $password = $db->escapeString($_POST['password']);

    $currentTime = time() + 25200;
    $expired = 3600;

    $error = array();

    if (empty($email)) {
        $error['failed'] = " <span class='label label-danger'>email should be filled!</span>";
    }

    if (empty($password)) {
        $error['failed'] = " <span class='label label-danger'>Password should be filled!</span>";
    }

    if (!empty($email) && !empty($password)) {
		$password = md5($password);
		$sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
		$db->sql($sql);
		$res = $db->getResult();
		$num = $db->numRows($res);
		if ($num == 1) {
			if($res[0]['status'] == 1){
				$_SESSION['timeout'] = $currentTime + $expired;
				$_SESSION['name'] = $res[0]['name'];
				$_SESSION['email'] = $res[0]['email'];
				$_SESSION['role'] = $res[0]['role'];
				header("location: home.php");

			}else{
				$error['failed'] = "<span class='btn btn-danger'>Your Account is Deactivated</span>";

			}


		}else {
            $error['failed'] = "<span class='btn btn-danger'>Invalid Credentials</span>";
        }
        

        
    }
}
?>
<div class="col-md-4 col-md-offset-4 " style="margin-top:150px;">
	<!-- general form elements -->
	<div class='row'>
		<div class="col-md-12 text-center">
			<img src="./img/logo.png" height="110">
			<h3>Smart Gold Dashboard</h3>
		</div>
		<div class="box box-info col-md-12">
			<div class="box-header with-border">
				<h3 class="box-title">Administrator Login</h3>
				<center><?php echo isset($error['failed']) ? $error['failed'] : ''; ?></center>
			</div><!-- /.box-header -->
			<!-- form start -->
			<form method="post" enctype="multipart/form-data">
				<div class="box-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Email :</label>
						<input type="email" name="email" class="form-control" value="" required>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Password :</label>
						<input type="password" class="form-control" name="password" value="" required>
					</div>
					<div class="box-footer">
						<!-- <a href="home.php" class="btn btn-info pull-left">
							Login
						
						</a> -->
						<button type="submit" name="btnLogin" class="btn btn-info pull-left">Login</button>
						<!-- 
						<a href="forgot-password.php" class="pull-right">Forgot Password?</a> -->
					</div>
				</div>
			</form>
		</div><!-- /.box -->
	</div>
</div>
