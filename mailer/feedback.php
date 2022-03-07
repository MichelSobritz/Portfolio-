<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
require 'POP3.php';
require 'form_setting.php';

if (isset($_POST)) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	$messages  = "<h3>New message from the site " . $fromName . "</h3> \r\n";
	$messages .= "<ul>";
	$messages .= "<li><strong>Name: </strong>" . $name . "</li>";
	$messages .= "<li><strong>Email: </strong>" . $email . "</li>";
	$messages .= "<li><strong>Message: </strong>" . $message . "</li>";
	$messages .= "</ul> \r\n";


	try {
		$mail = new PHPMailer;
		$mail->SMTPDebug = 2;
		$mail->isSMTP(true);
		$mail->Host       = "smtp.gmail.com";
		$mail->SMTPAuth   = true;
		$mail->Username   = 'michelsobritz70@gmail.com';
		$mail->Password   = 'Mimimimi70';
		$mail->SMTPSecure = 'ssl';
		$mail->Port       = 465;

		$mail->From = $from;
		$mail->FromName = $fromName;
		$mail->addAddress($to, 'Admin');

		$mail->isHTML(true);
		$mail->CharSet = $charset;

		$mail->Subject = $subj;
		$mail->Body    = $messages;

		if (!$mail->send()) {
			print json_encode(array('status' => 0));
		} else {
			print json_encode(array('status' => 1));
		}
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
}
