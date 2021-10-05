<?php 
	session_start();
	require_once "../common/config.php";
	require_once "../common/navbar.php";

    function displayAlert($alert) { ?>
        <script type = "text/javascript">
            var alert_msg = "<?php echo $alert; ?>";
            alert(alert_msg);
            window.location.href = "change_password.php";
        </script>
    <?php }

    function displaySuccessAlert($alert) { ?>
        <script type = "text/javascript">
            var alert_msg = "<?php echo $alert; ?>";
            alert(alert_msg);
            window.location.href = "../home.php";
        </script>
    <?php }

	if (strlen($_POST['currentpwd']) < 1 || strlen($_POST['newpwd']) < 1 || strlen($_POST['confirmpwd']) < 1){
	    displayAlert("Password field cannot be blank");
	}

	$email = $_SESSION["email"];
	$currentpwd = $_POST['currentpwd'];
	$newpwd = $_POST['newpwd'];
	$confirmpwd = $_POST['confirmpwd'];
	echo "Email - ",$email;
	$conn = new mysqli($servername, $username, $password, $dbname);
	$query = "SELECT password, admin_approved, user_type FROM users WHERE email_id = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    $verify = password_verify($currentpwd, $row['password']);
    if($verify){
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
    }
    else {
    	displayAlert("Incorrect Current Password Given, Please Try Again!!");
    }
?>