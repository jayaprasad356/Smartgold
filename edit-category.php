<?php
ob_start();
// start session

session_start();



?>

<?php include "header.php"; ?>
<html>

<head>
    <title>Smart Gold Admin</title>
    <style>
        .asterik {
            font-size: 20px;
            line-height: 0px;
            vertical-align: middle;
        }

        .mce-notification.mce-in {
            display: none !important;
        }
    </style>
</head>
</body>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php include('public/edit-category-form.php'); ?>
</div><!-- /.content-wrapper -->
</body>

</html>
<?php include "footer.php"; ?>