<?php session_start();

include_once('includes/custom-functions.php');

$function = new custom_functions;




include "header.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Smart Gold Dashboard</title>
</head>
<body>

    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Home</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="home.php"> <i class="fa fa-home"></i> Home</a>
                </li>
            </ol>

        </section>
        <section class="content">
            <div class="row">
                
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?= $function->users_rows_count('users'); ?></h3>
                            
                            <p>Customers</p>
                        </div>
                        <div class="icon"><i class="fa fa-users"></i></div>
                        <a href="customers.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3><?= $function->users_rows_count('seller'); ?></h3>
                            
                            <p>Sellers</p>
                        </div>
                        <div class="icon"><i class="fa fa-users"></i></div>
                        <a href="sellers.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            
        </section>
        
    </div>

    <?php include "footer.php"; ?>
    
</body>
</html>