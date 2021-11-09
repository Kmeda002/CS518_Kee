<?php 
  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);
  session_start();
  if($_GET) {
    $_SESSION["email"] = $_GET['email'];
    $_SESSION["user_type"] = $_GET['user_type'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Home Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<?php 
  use Elasticsearch\ClientBuilder;
  require_once "common/navbar.php"; 
  require_once "common/config.php";
  require 'vendor/autoload.php';
  $hosts = [
    'host' => 'localhost',
    'port' => '9200'
  ]; 
  $client = Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();
?>
  
<div class="container">
  <h2>Search Articles</h2>
  <?php 
    $email = $_SESSION["email"]; 
    $conn = new mysqli($servername, $username, $password, $dbname);
    $query = "SELECT verified_email FROM users WHERE email_id = '$email'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    if($row['verified_email'] != 1){
      echo "Your email is not Verified, <button type='button' id='verifyemail' class='btn btn-primary'>Click</button> to send Verification Email. <br><br>";
    }
  ?>
  <form class="form-horizontal" action="" method="POST" >
    <div class="col-sm-10">
      <input class="form-control mr-sm-2" type="search" name= "k" value="<?php echo isset($_POST['k']) ? $_POST['k'] : ''; ?>" placeholder="Search" aria-label="Search">
    </div>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    <br>
  </form>
  <div class = "border border-3 rounded-3">
    <?php 
    if(isset($_POST['k'])){
      if (strlen($_POST['k']) < 1) {
        $json = '{
          "size": 50,
          "query" : {
              "match_all" : {}
          }
        }';
      }
      else {
        echo "<h4>Searched for : ", $_POST['k'], "</h4>";
        $json = '{
          "size": 50,
          "query" : {
              "multi_match" : {
                  "query": "' .$_POST['k']. '",
                  "fields": ["title", "body"]
              }
          }
        }';
      }
      //print_r($json);
      $params = [
        'index' => 'snopesprod',
        'body'  => $json
      ];
      $results = $client->search($params);
      echo "<h4>", $results['hits']['total']['value'], " results", "</h4>";
      echo "<br>";
      foreach ($results['hits']['hits'] as $hit) {
        //print_r($hit);
        ?>
        <a class="btn" target="_blank" href="compare2.php?artid=<?php echo $hit['_source']['id']?>" role="button"><?php echo $hit['_source']['title'];?></a><br>
      <?php }
    }
    ?>
  </div>
</div>
<script type="text/javascript">
  $("#verifyemail").click(function(e) {
    $.ajax({
        type: "GET",
        url: "common/send_verifyemail.php",
        data: { 
            email: "<?php echo $email; ?>"
        },
        success: function(result) {
            alert('Email Sent!!');
        },
        error: function(result) {
            alert('error');
        }
    });
});

</script>
</body>
</html>