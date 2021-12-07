<?php 
    require_once "common/config.php";
	use Elasticsearch\ClientBuilder;
	require 'vendor/autoload.php';
	$hosts = [
	'host' => 'localhost',
	'port' => '9200'
	]; 
	$client = Elasticsearch\ClientBuilder::create()->setHosts($hosts)->build();

	$apikey = getallheaders()['key'];
	$email = getallheaders()['email'];
	$conn = new mysqli($servername, $username, $password, $dbname);
    $query = "SELECT * FROM api_keys WHERE email_id = '$email' and api_key = '$apikey'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result)==0) { 
        echo "API Credentials did not match\n";
        exit();
    }

	if(getallheaders()['key']){
		echo "Search terms - ", $_GET['terms'],"<br>";
		echo "Count requested - ", $_GET['cnt'];
	    $json = '{
	      "size": 50,
	      "query" : {
	          "multi_match" : {
	              "query": "' .$_GET['terms']. '",
	              "fields": ["title", "body"]
	          }
	      }
	    }';

	    $params = [
		    'index' => 'snopesprod',
		    'body'  => $json
		  ];
	  	$results = $client->search($params);

	  	echo "<h4>", $results['hits']['total']['value'], " results", "</h4>";
	  	$result = array();
	  	$rank = 1;
	  	foreach ($results['hits']['hits'] as $hit) {
	  		//echo $hit['_source']['id'], "-> ", $hit['_source']['title'], " -> ", $hit['_source']['date'], " -> ", $rank,"<br>";
	  		array_push($result, ["article_id" => $hit['_source']['id'], "article_title" => $hit['_source']['title'], "article_date" => $hit['_source']['date'], "article_rank" => $rank]);
	  		$rank = $rank + 1;
	  		if ($rank > $_GET['cnt']){
	  			break;
	  		}
	    }
	    print_r($result);
	    echo "\n";
	}
	else {
		echo "No API key given \n";
	}

    #print_r(getallheaders()['key']);
    #print_r(getallheaders()['email']);
?>