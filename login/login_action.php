<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="https://localhost/favicon.png">
</head>
<body>

</body>
</html>

<?php 
    require_once "../common/config.php";

    function displayAlert($alert) { ?>
        <script type = "text/javascript">
            var alert_msg = "<?php echo $alert; ?>";
            alert(alert_msg);
            window.location.href = "login.php";
        </script>
    <?php }

    if($_POST){
        //print_r($_POST);
        //exit();
        if (strlen($_POST['email']) < 1 || strlen($_POST['password']) < 1){
            displayAlert("Email/Password cannot be blank");
        }
        
        if (strlen($_POST['g-recaptcha-response']) < 1) {
            displayAlert("Please Solve ReCaptcha");
        }
        if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            $secret="6LeaHkYdAAAAAD9Rq-B2TmCEjhFgUeESD15TgqGy";

            $response=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
            
            $data=json_decode($response);

            if ($data->success) 
            {
              echo "<h2>Data Sent";
            }
            else
            {
              displayAlert("ReCaptcha failed, please try again");
            }   
        }

        $email = $_POST['email'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        $query = "SELECT password, admin_approved, user_type FROM users WHERE email_id = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result)==0) { 
            displayAlert("Email not registered");
        }
        else {
            $row = mysqli_fetch_array($result);
            echo $row;
            if ($row['admin_approved'] == 0){
                displayAlert("Admin still has not approved your account, Please Try Again Later!!");
            }
            else if ($row['admin_approved'] == -1){
                displayAlert("Admin has denied your account registeration request!!");
            }
            else {
                echo "Email found and Admin approved, Checking for password <br>";

                $verify = password_verify($_POST["password"], $row['password']);
                if ($verify) {
                    echo 'Password Verified! Redirect to 2FA page';
                    $user_type = $row['user_type'];
                    header("location: login2fa.php?email=$email&user_type=$user_type");
                } else {
                    displayAlert("Incorrect Password");
                }
            }
        }
    }

?>


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
