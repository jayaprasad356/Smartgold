<?php
	// start session
	
	session_start();
	
	
	
?>
<?php include"header.php";?>
<html>
<head>
<title>Banners | Smart Gold - Dashboard</title>
</head>
</body>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <?php include('public/banners-table.php'); ?>
      </div><!-- /.content-wrapper -->
  </body>
</html>
<?php include"footer.php";?>