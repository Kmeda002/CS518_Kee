<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Change Account Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php require_once "../common/navbar.php"; ?>
<div class="container">
  <h2>Change Your Account Details</h2>
  <br>
  <form class="form-horizontal" action="change_account_action.php" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="fname">First Name:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="fname" placeholder="John" name="fname">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="lname">Last Name:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="lname" placeholder="Doe" name="lname">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>
</html>
