<?php

function redirect_to($location = NULL) {
    if ($location) {
        header("Location: {$location}");
        exit;
    }
}

function strip_zero_from_date($marked_string = "") {
    $no_zero = str_replace('*0', '', $marked_string);

    $cleaned_string = str_replace('*', '', $no_zero);
    return $cleaned_string;
}

function __autoload($class_name) {
    $class_name = strtolower($class_name);
    $path = LIB_PATH . DS . "{$class_name}.php";
    if (file_exists($path)) {
        require_once($path);
    } else {
        die("The file {$class_name}.php could not found");
    }
}

function include_layout_template($template = "") {
    //var_dump(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
    include(SITE_ROOT . DS . 'public' . DS . 'layouts' . DS . $template);
    //require_once '../../public/layouts/'.$template;
}

function output_message($message = "") {
    if (!empty($message)) {
        return "<p class=\"message\">{$message}</p>";
    } else {
        return "";
    }
}

function log_action($action, $message = "") {
    $logfile = SITE_ROOT . DS . 'logs' . DS . 'log.txt';
    $new = file_exists($logfile) ? false : true;
    if ($handle = fopen($logfile, 'a')) {
        $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
        $content = "{$timestamp} | {$action}: {$message} \n";
        fwrite($handle, $content);
        fclose($handle);
        if ($new) {
            chmod($logfile, 0755);
        } else {
            echo "Cound not open log gile for writing.";
        }
    }
}

function datetime_to_text($datetime = "") {
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

//include_once 'phpmailer/PHPMailerAutoload.php';

function sendMail($to, $subject = "Test subject", $body = "Test body") {
    date_default_timezone_set('Etc/UTC');

require 'includes/phpmailer/PHPMailerAutoload.php';
//Create a new PHPMailer instance
    $mail = new PHPMailer();
//Tell PHPMailer to use SMTP
    $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
    $mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';
//Set the hostname of the mail server
    $mail->Host = "smtp.gmail.com";
//Set the SMTP port number - likely to be 25, 465 or 587
    $mail->Port = 587;
//Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    $mail->SMTPSecure = "tls";

//Username to use for SMTP authentication
    $mail->Username = "wolfgang.ltd@gmail.com";
//Password to use for SMTP authentication
    $mail->Password = "wolf111000";
//Set who the message is to be sent from
    $mail->setFrom('wolfgang.ltd@gmail.com', 'Wolfgang');
//Set an alternative reply-to address
    $mail->addReplyTo('wolfgang.ltd@gmail.com', 'Wolfgang');
//Set who the message is to be sent to
    $mail->addAddress($to);
//Set the subject line
    $mail->Subject = $subject;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
    $mail->msgHTML($body);
//Replace the plain text body with one created manually
    $mail->AltBody = $body;
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
    if (!$mail->send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        return FALSE;
    } else {
        //echo "Message sent!";
        return TRUE;
    }
}

?>