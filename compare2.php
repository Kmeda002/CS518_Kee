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
	        	Survey Content
	    	</div>
	      </div>
	    </div>
	</div>
</div>
</body>
</html>