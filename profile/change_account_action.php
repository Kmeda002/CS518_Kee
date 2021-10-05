<?php 
	session_start();
	require_once "../common/config.php";
	require_once "../common/navbar.php";

    function displayAlert($alert) { ?>
        <script type = "text/javascript">
            var alert_msg = "<?php echo $alert; ?>";
            alert(alert_msg);
            window.location.href = "change_account.php";
        </script>
    <?php }

    function displaySuccessAlert($alert) { ?>
        <script type = "text/javascript">
            var alert_msg = "<?php echo $alert; ?>";
            alert(alert_msg);
            window.location.href = "../home.php";
        </script>
    <?php }

	if (strlen($_POST['fname']) < 1 || strlen($_POST['lname']) < 1){
	    displayAlert("First/Last Name cannot be blank, Please Try Again!!");
	}

	$email = $_SESSION["email"];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "UPDATE users set first_name = '$fname', last_name = '$lname' where email_id = '$email'";
	echo $sql;
	if ($conn->query($sql) === TRUE) {
      displaySuccessAlert("Account Details Updated");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>