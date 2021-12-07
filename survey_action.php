<?php
	session_start();
	require_once "common/config.php";
	if (isset($_POST['Result'])) {
		$radioVal1 = $_POST["q1"];
		$radioVal2 = $_POST["q2"];
		$radioVal3 = $_POST["q3"];
		$radioVal4 = $_POST["q4"];
		$radioVal5 = $_POST["q5"];
		$final_answers = $radioVal1.$radioVal2.$radioVal3.$radioVal4.$radioVal5;
		echo $radioVal1.$radioVal2.$radioVal3.$radioVal4.$radioVal5."<br>";
		echo $_POST["artid"]."<br>";
		echo $_SESSION["email"];
		$artid = $_POST["artid"];
		$emailid = $_SESSION["email"];
	}

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO survey_questions (email_id, art_id, answers) VALUES ('$emailid', '$artid', '$final_answers')";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header("location: compare2.php?artid=$artid");
?>