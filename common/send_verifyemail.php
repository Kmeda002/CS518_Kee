<?php 
	require_once "emailconfig.php";
	require_once "config.php";

	$digits = 4;
    $verfcode = rand(pow(10, $digits-1), pow(10, $digits)-1);
    $email = $_GET['email'];
	$mail->addAddress($email);

    //Send HTML or Plain Text email
    $mail->isHTML(true);

    $mail->Subject = "Snoopes Verf Email";

    //$mail->Body = "localhost/verify_email?email=" . $email . "&code=" . strval($verfcode);
    $mail->Body = "<a href='localhost/verify_email?email=$email&code=$verfcode'>Click Here to Verify your Email</a>";
    //$mail->AltBody = "This is the plain text version of the email content";
    echo "Sending email to ". $email . "<br>";

    try {
        $mail->send();
        echo "Message has been sent successfully<br>";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }

    $conn = new mysqli($servername, $username, $password, $dbname);
    $query = "UPDATE users set verified_email = $verfcode where email_id = '$email'";
	mysqli_query($conn, $query);
?>