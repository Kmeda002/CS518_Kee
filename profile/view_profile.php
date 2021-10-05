<?php 
	session_start();
	require_once "../common/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Account Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php require_once "../common/navbar.php"; ?>
  
<div class="container">
  <h2>Account Details</h2>
  <br>
  <?php $email = $_SESSION["email"]; ?>
  <?php
	$conn = new mysqli($servername, $username, $password, $dbname);
	$query = "SELECT * FROM users WHERE email_id = '$email'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
  ?>
  <h4>Email:  <span> <?php echo $email; ?> </span> </h4>
  <h4>First Name: <span> <?php echo $row['first_name']; ?> </span> </h4>
  <h4>Last Name:  <span>  <?php echo $row['last_name']; ?> </span> </h4>

</div>

</body>
</html>