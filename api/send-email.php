<?php
header('Access-Control-Allow-Origin: *');
include_once '../includes/functions.php';
include_once '../library/class.phpmailer.php';
$functions1 = new functions();


function send_smtp_mail($to, $subject, $item_data1, $order_data)
{
    $smtp_from_mail = 'noreply@smartgold.blazeaisolutions.com';
    $smtp_reply_to = 'noreply@smartgold.blazeaisolutions.com';
    $smtp_email_password = 'SmartGold123!';
    $smtp_host = 'smtp.hostinger.com';
    $smtp_port = '587';
    $smtp_content_type = '';
    $smtp_encryption_type = 'ssl';
    $app_name = 'SmartGold';
    $message = 'Test SMTP MAIL';
    $mail1 = new PHPMailer(); // create a new object
    $mail1->IsSMTP(); // enable SMTP
    $mail1->SMTPAuth = true; // authentication enabled
    $mail1->SMTPSecure = $smtp_encryption_type; // secure transfer enabled REQUIRED for Gmail
    $mail1->Host = $smtp_host;
    $mail1->Port = $smtp_port; // or 587
    if ($smtp_content_type == '') {
        $mail1->IsHTML(false);
    } else {
        $mail1->IsHTML(true);
    }
    $mail1->Username = $smtp_from_mail;
    $mail1->Password = $smtp_email_password;
    $mail1->SetFrom($smtp_from_mail);
    $mail1->Subject = $subject;
    $mail1->Body = $message;
    $mail1->AddAddress($to, $app_name);
    $mail1->addReplyTo($smtp_reply_to, $app_name);
    if ($mail1->send()) {
        return true;
    } else {
        return false;
    }
}
