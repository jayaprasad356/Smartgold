
<?php session_start();

include_once('../includes/custom-functions.php');

$function = new custom_functions;

// set time for session timeout
$currentTime = time() + 25200;
$expired = 900;

if (!isset($_SESSION['seller_id']) && !isset($_SESSION['seller_name'])) {
    header("location:index.php");
} else {
    $ID = $_SESSION['seller_id'];
}

// if current time is more than session timeout back to login page
if ($currentTime > $_SESSION['timeout']) {
    session_destroy();
    header("location:index.php");
}
// destroy previous session timeout and create new one
unset($_SESSION['timeout']);
$_SESSION['timeout'] = $currentTime + $expired;



include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Smart Gold Dashboard</title>
</head>
<style>
    .white-bg{
    background:#ffffff !important;
    padding: 20px !important;
}
</style>
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
                <div class="col-lg-6">
                    <div class="white-bg p-5">
                        <h1 class="h6 text-uppercase font-weight-bold mb-4">Basic</h1>
                        <h2 class="h1 font-weight-bold">₹ 10,000<span class="text-small font-weight-normal ml-2">/ Month</span></h2>
                        <div class="custom-separator my-4 mx-auto bg-warning"></div>
                        <ul class="list-unstyled my-5 text-small text-left">
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 100 Products in Inventory </li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 10 Offers in a Month</li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 2 Admin Access</li>
                        </ul> <a href="#" class="btn btn-warning btn-block p-2 shadow rounded-pill">Subscribe</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="white-bg p-5">
                        <h1 class="h6 text-uppercase font-weight-bold mb-4">Basic</h1>
                        <h2 class="h1 font-weight-bold">₹ 1,00,000<span class="text-small font-weight-normal ml-2">/ Year</span></h2>
                        <div class="custom-separator my-4 mx-auto bg-warning"></div>
                        <ul class="list-unstyled my-5 text-small text-left">
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 100 Products in Inventory </li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 10 Offers in a Month</li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 2 Admin Access</li>
                        </ul> <a href="#" class="btn btn-warning btn-block p-2 shadow rounded-pill">Subscribe</a>
                    </div>
                </div>
            </div>
            
            
        </section>
        <section class="content">
            <div class="row">
                <div class="col-lg-6">
                    <div class="white-bg p-5">
                        <h1 class="h6 text-uppercase font-weight-bold mb-4">Deluxe</h1>
                        <h2 class="h1 font-weight-bold">₹ 50,000<span class="text-small font-weight-normal ml-2">/ Month</span></h2>
                        <div class="custom-separator my-4 mx-auto bg-warning"></div>
                        <ul class="list-unstyled my-5 text-small text-left">
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 500 Products in Inventory </li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 15 Offers in a Month</li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 5 Admin Access</li>
                        </ul> <a href="#" class="btn btn-warning btn-block p-2 shadow rounded-pill">Subscribe</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="white-bg p-5">
                        <h1 class="h6 text-uppercase font-weight-bold mb-4">Deluxe</h1>
                        <h2 class="h1 font-weight-bold">₹ 5,00,000<span class="text-small font-weight-normal ml-2">/ Year</span></h2>
                        <div class="custom-separator my-4 mx-auto bg-warning"></div>
                        <ul class="list-unstyled my-5 text-small text-left">
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 100 Products in Inventory </li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 10 Offers in a Month</li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 5 Admin Access</li>
                        </ul> <a href="#" class="btn btn-warning btn-block p-2 shadow rounded-pill">Subscribe</a>
                    </div>
                </div>
            </div>
            
            
        </section>
        <section class="content">
            <div class="row">
                <div class="col-lg-6">
                    <div class="white-bg p-5">
                        <h1 class="h6 text-uppercase font-weight-bold mb-4">Premium</h1>
                        <h2 class="h1 font-weight-bold">₹ 1,00,000<span class="text-small font-weight-normal ml-2">/ Month</span></h2>
                        <div class="custom-separator my-4 mx-auto bg-warning"></div>
                        <ul class="list-unstyled my-5 text-small text-left">
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> Unlimited Products in Inventory </li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> One Offers in a Day</li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 10 Admin Access</li>
                        </ul> <a href="#" class="btn btn-warning btn-block p-2 shadow rounded-pill">Subscribe</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="white-bg p-5">
                        <h1 class="h6 text-uppercase font-weight-bold mb-4">Premium</h1>
                        <h2 class="h1 font-weight-bold">₹ 10,00,000<span class="text-small font-weight-normal ml-2">/ Year</span></h2>
                        <div class="custom-separator my-4 mx-auto bg-warning"></div>
                        <ul class="list-unstyled my-5 text-small text-left">
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> Unlimited Products in Inventory </li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> One Offers in a Day</li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 10 Admin Access</li>
                        </ul> <a href="#" class="btn btn-warning btn-block p-2 shadow rounded-pill">Subscribe</a>
                    </div>
                </div>
            </div>
            
            
        </section>
        
    </div>

    <?php include "footer.php"; ?>
    
</body>
</html>