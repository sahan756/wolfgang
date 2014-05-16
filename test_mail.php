<?php
require_once './includes/initialize.php';
require_once './includes/phpmailer/PHPMailerAutoload.php';
require_once './includes/phpmailer/class.phpmailer.php';
require_once './includes/phpmailer/class.smtp.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//date_default_timezone_set('Etc/UTC');
//
//require 'includes/phpmailer/PHPMailerAutoload.php';
//
////Create a new PHPMailer instance
//$mail = new PHPMailer();
////Tell PHPMailer to use SMTP
//$mail->isSMTP();
////Enable SMTP debugging
//// 0 = off (for production use)
//// 1 = client messages
//// 2 = client and server messages
//$mail->SMTPDebug = 2;
////Ask for HTML-friendly debug output
//$mail->Debugoutput = 'html';
////Set the hostname of the mail server
//$mail->Host = "smtp.gmail.com";
////Set the SMTP port number - likely to be 25, 465 or 587
//$mail->Port = 587;
////Whether to use SMTP authentication
//$mail->SMTPAuth = true;
//
//$mail->SMTPSecure = "tls";
//
////Username to use for SMTP authentication
//$mail->Username = "wolfgang.ltd@gmail.com";
////Password to use for SMTP authentication
//$mail->Password = "wolf111000";
////Set who the message is to be sent from
//$mail->setFrom('wolfgang.ltd@gmail.com', 'Wolfgang');
////Set an alternative reply-to address
//$mail->addReplyTo('wolfgang.ltd@gmail.com', 'Wolfgang');
////Set who the message is to be sent to
//$mail->addAddress('sahan756@yahoo.com', 'Sahan Madurasinghe');
////Set the subject line
//$mail->Subject = 'PHPMailer SMTP test';
////Read an HTML message body from an external file, convert referenced images to embedded,
////convert HTML into a basic plain-text alternative body
//$mail->msgHTML("Test message");
////Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
////Attach an image file
////$mail->addAttachment('images/phpmailer_mini.png');
//
////send the message, check for errors
//if (!$mail->send()) {
//    echo "Mailer Error: " . $mail->ErrorInfo;
//} else {
//    echo "Message sent!";
//}

$status = sendMail("sahan756@gmail.com", "This is a test message", "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
echo $status;
?>