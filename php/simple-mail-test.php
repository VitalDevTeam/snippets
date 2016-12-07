<?php
/**
 * Simple PHP mail test using PHPMailer
 * https://github.com/PHPMailer/PHPMailer
 */
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

// Get local time and set timestamp
date_default_timezone_set('America/New_York');
$timestamp = time();
$time      = date("Y-m-d H:i:s", $timestamp);

require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->SMTPDebug = 3;
$mail->Debugoutput = 'html';

$mail->isSMTP();
$mail->Host = 'smtp.hostname.com';
$mail->SMTPAuth = true;
$mail->Username = 'example@hostname.com';
$mail->Password = 'password';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('example@example.com', 'Form Tester');
$mail->addAddress('example2@example.com');
// $mail->addReplyTo('example@example.com', 'Form Tester');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');		// Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');	// Optional name
$mail->isHTML(true);									// Set email format to HTML

$mail->Subject = "PHP email test [$time]";
$mail->Body    = "This is a test email. This message was successfully sent at $time.";
// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {

	echo 'Message could not be sent.';
	echo 'Mailer Error: ' . $mail->ErrorInfo;

} else {

	echo "Mail successfully sent at " . $time;

}