
<!--form action="login_action.php" method="post">
  <label for="email"> Email: </label>
  <input type="text" id="email" name="email"><br><br>
  <label for="password"> Password:</label>
  <input type="password" id="password" name="password"><br><br>
  <input type="submit" value="Sign In">
  <p><div><a href="register.php"> Register Here </a></div></p>
</form -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Snopes Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container h-100 d-flex align-items-center justify-content-center">
<form action="login_action.php" method="post">
  <div class="form-group">
    <div class="col-sm-4">
      <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  </div>
  <div class="form-group">
    <div class="col-sm-4">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign In</button>
  <a class="btn btn-primary" href="../security/forgot_password.php" role="button">Forgot Password</a>
  <a class="btn btn-primary" href="../registration/register.php" role="button">Register</a>
</form>
</div>
</body>
</html>