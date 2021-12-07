<?php 
  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);
  session_start();
  use Elasticsearch\ClientBuilder;
  require 'vendor/autoload.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Home Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="icon" href="https://localhost/favicon.png">
  		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>
 <?php
  require_once "common/nav2.php"; 
  require_once "common/config.php";
 ?>
 <div class="container">
 	<div class="modal-body row border border-3 rounded-3">
	  	<div class="col-md-6 border-end border-3" style="padding-top: 40px;">
	    <?php
		  if($_GET) {
			  $hosts = [
			    'host' => 'localhost',
			    'port' => '9200'
			  ]; 
			  $client = Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();

			  $params = [
			    'index' => 'snopesprod',
			    'id'    => $_GET['artid']
			  ];

			  $results = $client->get($params);
			  echo "<h2>",$results['_source']['title'],"</h2>";
			  echo "<hr/>";
			  echo "<p>Published Date: ",$results['_source']['date'],"</p>";
			  echo "<hr/>";
			  echo $results['_source']['body'],"<br>";
		}
		?>
	  	</div>
	  	<div class="col-md-6">
	        <ul class="nav nav-tabs" id="myTab" role="tablist">
		        <li class="nav-item" role="presentation">
		          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Dashboard</button>
		        </li>
		        <li class="nav-item" role="presentation">
		          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Snopes</button>
		        </li>
		        <li class="nav-item" role="presentation">
		          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Survey</button>
		        </li>
	      </ul>
	      <div class="tab-content" id="myTabContent">
	        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
	        	<br>
	        	<h5>Relavant Papers</h5>
	        	<?php
		            $conn = new mysqli($servername, $username, $password, $dbname);
		            $query = "SELECT * FROM papers WHERE fake_artid = " . $_GET['artid'];
		            //echo $query;
		            $result = mysqli_query($conn, $query);
		            $count = 1;
		            while($row = mysqli_fetch_array($result)) {
		        ?>
	        	<p>
				  <div class="card card-body" data-bs-toggle="collapse" href="#abc<?php echo $count; ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
				  	<?php echo $row['title'];?>
				  </div>
				</p>
				<div class="collapse" id="abc<?php echo $count; ?>">
				  <div class="card card-body border-primary mb-3">
				    <span> <span style="color:red;">Authors : </span> <?php echo $row["authors"];?></span>
				    <span> <span style="color:red;">Venue : </span> <?php echo $row["venue"];?>, <span style="color:red;">Year : </span> <?php echo $row["year"];?>, <span style="color:red;">Citations : </span> <?php echo $row["citations"];?> </span>
				    <span> <span style="color:red;">Abstract : </span> <?php echo $row["abstract"];?></span>
				  </div>
				</div>
				<?php $count = $count + 1; } ?>
	        </div>
	        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	        	<?php
				  if($_GET) {
					  $params = [
					    'index' => 'snopesprodcompare',
					    'id'    => $_GET['artid']
					  ];
					  $results = $client->get($params);
					  echo "<h2>",$results['_source']['title'],"</h2>";
					  echo "<hr/>";
					  echo "<p>Published Date: ",$results['_source']['date']," <br>Author: ",$results['_source']['author'],"</p>";
					  echo "<hr/>";
					  echo "<h4>Claim</h4>";
					  echo "<p>",$results['_source']['claim'],"</p>";
					  echo "<hr/>";
					  echo "<h4>Rating</h4>";
					  ?> 
					  <div class="row"> 
					  	<div class="col-sm-2"> <img width="100" height="100" src="https://www.snopes.com/tachyon/2018/03/rating-false.png" alt="False"></div>
					  	<div class="col-sm-2"><h5 style="padding-top: 30px;">False</h5> </div>
					  </div>

					  <?php
					  echo "<hr/>";
					  echo "<h4>Origin</h4>";
					  echo $results['_source']['body'],"<br>";
				}
				?>
	        </div>
	        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
	        	<?php 

		        	$query = "SELECT answers FROM survey_questions WHERE email_id = '" . $_SESSION["email"] . "' and art_id = " . $_GET['artid'];
		        	$result = mysqli_query($conn, $query);
		        	#echo "Result count - ",mysql_num_rows($result);
		        	if(mysqli_num_rows($result) > 0) {
		        		$row = mysqli_fetch_array($result);
		        	    $answers = str_split($row['answers']);
		        	}
		        	else {
		        		$answers = [0,0,0,0,0];
		        	}
	        	?>
	        	<form action="survey_action.php" method="post">
	        		<br>
				  <p>Was the article true or false based on SciPEP’s recommendation?</p>
				  <?php if($answers[0] == 'a') { ?>
				  	<input type="radio" id="q1a" name="q1" value="a" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q1a" name="q1" value="a">
				  <?php } ?>
				  <label for="q1a">True</label><br>
				  <?php if($answers[0] == 'b') { ?>
				  	<input type="radio" id="q1b" name="q1" value="b" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q1b" name="q1" value="b">
				  <?php } ?>
				  <label for="q1b">False</label><br>
				  <?php if($answers[0] == 'c') { ?>
				  	<input type="radio" id="q1c" name="q1" value="c" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q1c" name="q1" value="c">
				  <?php } ?>
				  <label for="q1c">I don't know</label><br>

				  <br>  

				  <p>Did you have any prior beliefs/opinions about this topic?</p>
				  <?php if($answers[1] == 'a') { ?>
				  	<input type="radio" id="q2a" name="q2" value="a" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q2a" name="q2" value="a">
				  <?php } ?>
				  <label for="q2a">Yes</label><br>
				  <?php if($answers[1] == 'b') { ?>
				  	<input type="radio" id="q2b" name="q2" value="b" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q2b" name="q2" value="b">
				  <?php } ?>
				  <label for="q2b">No</label><br>

				  <br>

				  <p>Did your prior beliefs/opinions on this topic align with our recommendation?</p>
				  <?php if($answers[2] == 'a') { ?>
				  	<input type="radio" id="q3a" name="q3" value="a" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q3a" name="q3" value="a">
				  <?php } ?>
				  <label for="q3a">Yes</label><br>
				  <?php if($answers[2] == 'b') { ?>
				  	<input type="radio" id="q3b" name="q3" value="b" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q3b" name="q3" value="b">
				  <?php } ?>
				  <label for="q3b">No</label><br>
				  <?php if($answers[2] == 'c') { ?>
				  	<input type="radio" id="q3c" name="q3" value="c" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q3c" name="q3" value="c">
				  <?php } ?>
				  <label for="q3c">Not applicable</label><br>
				  
				  <br>

				  <p>If you held prior beliefs/opinions that did not align with the system’s recommendation, did the system change your beliefs/opinions on this topic?</p>
				  <?php if($answers[3] == 'a') { ?>
				  	<input type="radio" id="q4a" name="q4" value="a" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q4a" name="q4" value="a">
				  <?php } ?>
				  <label for="q4a">Yes</label><br>
				  <?php if($answers[3] == 'b') { ?>
				  	<input type="radio" id="q4b" name="q4" value="b" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q4b" name="q4" value="b">
				  <?php } ?>
				  <label for="q4b">Somewhat</label><br>
				  <?php if($answers[3] == 'c') { ?>
				  	<input type="radio" id="q4c" name="q4" value="c" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q4c" name="q4" value="c">
				  <?php } ?>
				  <label for="q4c">No</label><br>
				  <?php if($answers[3] == 'd') { ?>
				  	<input type="radio" id="q4d" name="q4" value="d" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q4d" name="q4" value="d">
				  <?php } ?>
				  <label for="q4b">Not applicable</label><br>

				  <br>

				  <p>What is your willingness to adopt the system for checking article credibility?</p>
				  <?php if($answers[4] == 'a') { ?>
				  	<input type="radio" id="q5a" name="q5" value="a" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q5a" name="q5" value="a">
				  <?php } ?>
				  <label for="q5a">Definitely</label><br>
				  <?php if($answers[4] == 'b') { ?>
				  	<input type="radio" id="q5b" name="q5" value="b" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q5b" name="q5" value="b">
				  <?php } ?>
				  <label for="q5b">Probably</label><br>
				  <?php if($answers[4] == 'c') { ?>
				  	<input type="radio" id="q5c" name="q5" value="c" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q5c" name="q5" value="c">
				  <?php } ?>
				  <label for="q5c">Probably not</label><br>
				  <?php if($answers[4] == 'd') { ?>
				  	<input type="radio" id="q5d" name="q5" value="d" checked>
				  <?php } else { ?>
				  	<input type="radio" id="q5d" name="q5" value="d">
				  <?php } ?>
				  <label for="q5b">Definitely not</label>

				  <br>
				  <br>
				  <input type="hidden" name="artid" value=<?php echo $_GET['artid'];?>>
				  <input type="submit" value="Submit" name="Result">
				</form>
	    	</div>
	      </div>
	    </div>
	</div>
</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: grey;
   color: white;
   text-align: center;
}
</style>
</head>
<body>


<div class="footer">
  <p>Copyright reserved 2021.PHP</p>
</div>

</body>
</html> 