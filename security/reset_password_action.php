<?php 
	require_once "../common/config.php";

    function displayAlert($alert) { ?>
        <script type = "text/javascript">
            var alert_msg = "<?php echo $alert; ?>";
            alert(alert_msg);
            window.location.href = "reset_password.php";
        </script>
    <?php }

    function displaySuccessAlert($alert) { ?>
        <script type = "text/javascript">
            var alert_msg = "<?php echo $alert; ?>";
            alert(alert_msg);
            window.location.href = "../login/login.php";
        </script>
    <?php }

	if (strlen($_POST['newpwd']) < 1 || strlen($_POST['confirmpwd']) < 1){
	    displayAlert("Password field cannot be blank");
	}

	$email = $_POST["email"];
	$newpwd = $_POST['newpwd'];
	$confirmpwd = $_POST['confirmpwd'];

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($_POST["newpwd"] == $_POST["confirmpwd"]) {
	    echo "Both passwords match <br>";
	    $hash = password_hash($_POST["newpwd"], PASSWORD_DEFAULT);
	    echo "Generated hash: ".$hash . "<br>";
	    $query = "UPDATE users set password = '$hash' where email_id = '$email'";
		mysqli_query($conn, $query);
		displaySuccessAlert("Password Successfully updated");
    } else {
      	displayAlert("Passwords did not match, Please Try Again!!");
    }
?>