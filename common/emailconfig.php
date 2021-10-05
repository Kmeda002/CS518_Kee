<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

	require_once "../vendor/autoload.php";

	//PHPMailer Object
	$mail = new PHPMailer(true); //Argument true in constructor enables exceptions
	$mail->IsSMTP();

	//$mail->SMTPDebug = SMTP::DEBUG_SERVER;

	$mail->SMTPAuth   = true;
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	$mail->Port       = 465;
	$mail->Host       = "smtp.gmail.com";
	$mail->Username   = "ravitejamajeti@gmail.com";
	$mail->Password   = "hckweqbbiblfjeno";

	//From email address and name
	$mail->From = "kmeda002@odu.edu";
	$mail->FromName = "Snopes Admin";
?>