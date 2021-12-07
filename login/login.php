
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
  <link rel="icon" href="https://localhost/favicon.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
</head>
<body>
<div class="container h-100 d-flex align-items-center justify-content-center">
  <form action="login_action.php" method="post">
    <div class="mb-3" action="login_action.php" method="post">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="abc123@gmail.com" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
    </div>
    <div class="form-group g-recaptcha" data-sitekey="6LeaHkYdAAAAAKtupHTtlcm9nauSPW4DB7K9fLoj"></div>
    <button type="submit" class="btn btn-primary">Sign In</button>
    <a class="btn btn-primary" href="../security/forgot_password.php" role="button">Forgot Password</a>
    <a class="btn btn-primary" href="../registration/register.php" role="button">Register</a>
  </form>

<!--<form action="login_action.php" method="post">
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
  <div class="form-group g-recaptcha" data-sitekey="6LeaHkYdAAAAAKtupHTtlcm9nauSPW4DB7K9fLoj"></div>
</form> -->


</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
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