<?php 
session_start();
    // set time for session timeout
    $currentTime = time() + 25200;
    $expired = 1800;

    // if current time is more than session timeout back to login page
    if ($currentTime > $_SESSION['timeout']) {
        session_destroy();
        header("location:index.php");
    }
    // destroy previous session timeout and create new one
    unset($_SESSION['timeout']);
    $_SESSION['timeout'] = $currentTime + $expired;
include "header.php"; ?>
<html>
<head>
<title>Locking Amount / Validity | Smart Gold - Dashboard</title>
<style>
    .asterik {
    font-size: 20px;
    line-height: 0px;
    vertical-align: middle;
}
</style>
</head>
</body>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <?php include('public/add-price-duration-form.php'); ?>
      </div><!-- /.content-wrapper -->
  </body>
</html>
<?php include"footer.php";?>