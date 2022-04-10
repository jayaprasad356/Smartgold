
<?php session_start();

include_once('../includes/custom-functions.php');

$function = new custom_functions;

// set time for session timeout
$currentTime = time() + 25200;
$expired = 900;
$currentdate = new DateTime(date('Y-m-d'));
$currentdate = $currentdate->format('Y-m-d');
$expirydate = $_SESSION['expiry_date'];
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
    <title>Smart Gold Vendor</title>
</head>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
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
            <?php
             if($currentdate > $expirydate)
             {
            ?>
                <h1 class="text-danger">Your Plan is Expired,Upgrade Your Plan.</h1>
            <?php
             }
             else{?>
                <h1>Upgrade</h1>
                <?php

             }
             ?>
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
                        </ul>
                        <input type="submit" class="btn btn-warning btn-block p-2 shadow rounded-pill" value="Subscribe" name="submit" onclick="payAmount(10000,1,'basic-monthly')">
                        <!-- <button type="button"  id="Basic">Subscribe</button> 
                         -->
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
                        </ul>
                        <input type="submit" class="btn btn-warning btn-block p-2 shadow rounded-pill" value="Subscribe" name="submit" onclick="payAmount(100000,1,'basic-annually')">
                        
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
                        </ul>
                        <input type="submit" class="btn btn-warning btn-block p-2 shadow rounded-pill" value="Subscribe" name="submit" onclick="payAmount(50000,1,'deluxe-monthly')">
                        
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="white-bg p-5">
                        <h1 class="h6 text-uppercase font-weight-bold mb-4">Deluxe</h1>
                        <h2 class="h1 font-weight-bold">₹ 5,00,000<span class="text-small font-weight-normal ml-2">/ Year</span></h2>
                        <div class="custom-separator my-4 mx-auto bg-warning"></div>
                        <ul class="list-unstyled my-5 text-small text-left">
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 500 Products in Inventory </li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 15 Offers in a Month</li>
                            <li class="mb-3"> <i class="fa fa-check mr-2 text-primary"></i> 5 Admin Access</li>
                        </ul>
                        <input type="submit" class="btn btn-warning btn-block p-2 shadow rounded-pill" value="Subscribe" name="submit" onclick="payAmount(500000,1,'deluxe-annually')">
                       
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
                        </ul>
                        <input type="submit" class="btn btn-warning btn-block p-2 shadow rounded-pill" value="Subscribe" name="submit" onclick="payAmount(100000,1,'premium-monthly')">
                       
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
                        </ul>
                        <input type="submit" class="btn btn-warning btn-block p-2 shadow rounded-pill" value="Subscribe" name="submit" onclick="payAmount(1000000,1,'premium-annually')">
                       
                    </div>
                </div>
            </div>
            
            
        </section>
        
    </div>
    
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

    function payAmount(totalAmount,product_id,plan){

        var expiryDate = changeplan(plan);
        var options = {
        "key": "rzp_test_S50jCnHV2iBtsa",
        "amount": (1000*100), // 2000 paise = INR 20
        "name": "Smart Gold",
        "description": plan,
        "image": "../img/logo.png",
        "handler": function (response){
            $.ajax({
                url: 'payment-process.php',
                type: 'post',
                data: {
                    razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id,expiryDate : expiryDate,plan : plan,
                }, 
                success: function (msg) {
                    alert("Plan Upgraded Successfully");


                //    window.location.href = 'http://localhost/razorpay/success.php';
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Failed ");
                }
            });
        
        },

        "theme": {
            "color": "#528FF0"
        }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
        e.preventDefault();
       

            
    }



</script>
<script>
 function changeplan(value) {
    if(value == 'basic-monthly' || value == 'deluxe-monthly' || value == 'premium-monthly'){
        var date = new Date();
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }
        var today = date.addDays(30);
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        return today;
    }
    else if(value == 'basic-annually' || value == 'deluxe-annually' || value == 'premium-annually'){
        var date = new Date();
        Date.prototype.addDays = function(days) {
            var date = new Date(this.valueOf());
            date.setDate(date.getDate() + days);
            return date;
        }
        var today = date.addDays(364);
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        return today;

    }
    
    
    
     
 }
</script>

    <?php include "footer.php"; ?>
    
</body>
</html>