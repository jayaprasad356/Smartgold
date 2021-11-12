<?php
	// start session
	ob_start();
	
	session_start();
	
	
	
?>

<?php include"header.php";?>
<html>
<head>
<title>Add Category | Smart Gold- Dashboard <?=$settings['isAuth']?> </title>
</head>
</body>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		<?php
			include('public/add-category-form.php'); 
		?>
      </div><!-- /.content-wrapper -->
  </body>
</html>
<?php include"footer.php";?>
    	