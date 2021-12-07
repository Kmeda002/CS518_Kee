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
  <link rel="icon" href="https://localhost/favicon.png">
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
  <form class="form-horizontal" id="labnol" action="" method="POST" >
    <div class="col-sm-10">
      <input class="form-control mr-sm-2" type="search" id = "homesearchbar" name= "k" spellcheck="true" value="<?php echo isset($_POST['k']) ? $_POST['k'] : ''; ?>" placeholder="Search" aria-label="Search">
    </div>
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    <img onclick="startDictation()" src="//i.imgur.com/cHidSVu.gif" />
    <br>
  </form>
  <div class = "border border-3 rounded-3">
    <?php 
    if(isset($_POST['k'])){
      $search_terms = strip_tags($_POST['k']);
      if (strlen($search_terms) < 1) {
        $json = '{
          "size": 50,
          "query" : {
              "match_all" : {}
          }
        }';
      }
      else {
        echo "<h4>Searched for : ", $search_terms, "</h4>";
        $json = '{
          "size": 50,
          "query" : {
              "multi_match" : {
                  "query": "' .$search_terms. '",
                  "fuzziness": 2,
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
      function highlightKeywords($text, $keyword) {
        $wordsAry = explode(" ", $keyword);
        $wordsCount = count($wordsAry);
        
        for($i=0;$i<$wordsCount;$i++) {
          $highlighted_text = "<span style='font-weight:bold;color:green;'>$wordsAry[$i]</span>";
          $text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
        }

        return $text;
      }
      foreach ($results['hits']['hits'] as $hit) {
        //print_r($hit);
        ?>
        <a class="btn" target="_blank" href="compare2.php?artid=<?php echo $hit['_source']['id']?>" role="button"><?php echo highlightKeywords($hit['_source']['title'], $search_terms);?></a><br>
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
  function startDictation() {

    if (window.hasOwnProperty('webkitSpeechRecognition')) {

      var recognition = new webkitSpeechRecognition();

      recognition.continuous = false;
      recognition.interimResults = false;

      recognition.lang = "en-US";
      recognition.start();

      recognition.onresult = function(e) {
        document.getElementById('homesearchbar').value
                                 = e.results[0][0].transcript;
        recognition.stop();
        document.getElementById('labnol').submit();
      };

      recognition.onerror = function(e) {
        recognition.stop();
      }

    }
  }

</script>
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