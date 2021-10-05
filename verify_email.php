<?php
	require_once "common/config.php";

	function displayAlert($alert) { ?>
	    <script type = "text/javascript">
	        var alert_msg = "<?php echo $alert; ?>";
	        alert(alert_msg);
	        window.location.href = "login/login.php";
	    </script>
	<?php }

	$email = $_GET['email'];
	$code = $_GET['code'];

	$conn = new mysqli($servername, $username, $password, $dbname);
    $query = "SELECT verified_email FROM users WHERE email_id = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    if($row['verified_email'] == $code){
    	displayAlert("Email Successfully Verfied");
    	$query = "UPDATE users set verified_email = 1 where email_id = '$email'";
		mysqli_query($conn, $query);
    }
    else {
    	displayAlert("Email Verfication failed, please use the correct link");
    }
?>