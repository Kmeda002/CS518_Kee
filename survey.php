<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Home Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>
	<form action="survey_action.php" method="post">
	  <p>Was the article true or false based on SciPEP’s recommendation?</p>
	  <input type="radio" id="q1a" name="q1" value="a">
	  <label for="q1a">True</label><br>
	  <input type="radio" id="q1b" name="q1" value="b">
	  <label for="q1b">False</label><br>
	  <input type="radio" id="q1c" name="q1" value="c">
	  <label for="q1c">I dont't know</label>

	  <br>  

	  <p>Did you have any prior beliefs/opinions about this topic?</p>
	  <input type="radio" id="q2a" name="q2" value="a">
	  <label for="q2a">Yes</label><br>
	  <input type="radio" id="q2b" name="q2" value="b">
	  <label for="q2b">No</label><br>

	  <br>

	  <p>Did your prior beliefs/opinions on this topic align with our recommendation?</p>
	  <input type="radio" id="q3a" name="q3" value="a">
	  <label for="q3a">Yes</label><br>
	  <input type="radio" id="q3b" name="q3" value="b">
	  <label for="q3b">No</label><br>
	  <input type="radio" id="q3c" name="q3" value="c">
	  <label for="q3c">Not applicable</label>
	  
	  <br>

	  <p>If you held prior beliefs/opinions that did not align with the system’s recommendation, did the system change your beliefs/opinions on this topic?</p>
	  <input type="radio" id="q4a" name="q4" value="a">
	  <label for="q4a">Yes</label><br>
	  <input type="radio" id="q4b" name="q4" value="b">
	  <label for="q4b">Somewhat</label><br>
	  <input type="radio" id="q4c" name="q4" value="c">
	  <label for="q4c">No</label><br>
	  <input type="radio" id="q4d" name="q4" value="d">
	  <label for="q4b">Not applicable</label>

	  <br>

	  <p>What is your willingness to adopt the system for checking article credibility?</p>
	  <input type="radio" id="q5a" name="q5" value="a">
	  <label for="q5a">Definitely</label><br>
	  <input type="radio" id="q5b" name="q5" value="b">
	  <label for="q5b">Probably</label><br>
	  <input type="radio" id="q5c" name="q5" value="c">
	  <label for="q5c">Probably not</label><br>
	  <input type="radio" id="q5d" name="q5" value="d">
	  <label for="q5b">Definitely not</label>

	  <br>
	  <br>
	  <input type="submit" value="Submit" name="Result">
	</form>

	<?php
		if (isset($_POST['Result'])) {
			$radioVal = $_POST["q1"];
			echo $radioVal;
			echo "<br>";
			echo "<br>";
			$radioVal = $_POST["q2"];
			echo $radioVal;
			echo "<br>";
			echo "<br>";
			$radioVal = $_POST["q3"];
			echo $radioVal;
			echo "<br>";
			echo "<br>";
			$radioVal = $_POST["q4"];
			echo $radioVal;
			echo "<br>";
			echo "<br>";
			$radioVal = $_POST["q5"];
			echo $radioVal;
			echo "<br>";
			echo "<br>";
		}
	?>
</body>
</html>
