<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reset Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Reset Your Password</h2>
  <br>
  <form class="form-horizontal" action="reset_password_action.php" method="post">
    <div class="form-group">
      <div class="col-sm-4">
        <input type="hidden" id="email" name="email" value="<?php echo $_GET['email']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="newpwd">New Password:</label>
      <div class="col-sm-4">
        <input type="password" class="form-control" id="newpwd" placeholder="Current Password" name="newpwd">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="confirmpwd">Confirm Password:</label>
      <div class="col-sm-4">
        <input type="password" class="form-control" id="confirmpwd" placeholder="Confirm Password" name="confirmpwd">
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
