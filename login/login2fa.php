<?php
	require_once "../common/emailconfig.php";

	//To address and name
	//$mail->addAddress("recepient1@example.com", "Recepient Name");
	$mail->addAddress($_GET['email']); //Recipient name is optional

	//Send HTML or Plain Text email
	$mail->isHTML(true);

	$mail->Subject = "Snoopes 2FA";

	$digits = 4;
	$authcode = rand(pow(10, $digits-1), pow(10, $digits)-1);
	echo "2fa code is ",$authcode,"<br>";

	$mail->Body = "Snoopes 2FA Code - " . strval($authcode);
	//$mail->AltBody = "This is the plain text version of the email content";
	//echo "Sending email to ". $_GET['email'] . "<br>";

	try {
	    $mail->send();
	    echo "Message has been sent successfully<br>";
	} catch (Exception $e) {
	    echo "Mailer Error: " . $mail->ErrorInfo;
	}
			
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
	  <h2>Two Factor Authentication</h2>
	  <br>
	  <form class="form-horizontal">
	    <div class="form-group">
	      <label class="control-label col-sm-2" for="usercode">Enter your 2FA Code:</label>
	      <div class="col-sm-4">
	        <input type="text" class="form-control" id="usercode" placeholder="4-Digit Code" name="authcode" autocomplete="off">
	      </div>
	    </div>
	    <div class="form-group">        
	      <div class="col-sm-offset-2 col-sm-10">
	        <button onclick="myfunction()" type="button" class="btn btn-default">Submit</button>
	      </div>
	    </div>
	  </form>
	</div>
	<script>
		function myfunction() {
			var usercode = document.getElementById('usercode').value
			var authcode = "<?php echo $authcode; ?>";
			if (usercode == authcode) {
				alert("Code Successfully Verified!!");
				var email = "<?php echo $_GET['email']; ?>";
				<?php if (isset($_GET['user_type'])){ ?>
					var user_type = "<?php echo $_GET['user_type']; ?>";
					window.location.href = "../home.php?email=" + email + "&user_type=" + user_type;
				<?php } ?>
				<?php if(isset($_GET['reqtype'])){ ?>
					window.location.href = "../security/reset_password.php?email=" + email;
				<?php } ?>
			} else {
			 	alert("Code Not Verified!! Try Login again");
			 	window.location.href = "login.php";
			} 
		}
	</script>	
</body>
</html>

 