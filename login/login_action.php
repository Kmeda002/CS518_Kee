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
        if (strlen($_POST['email']) < 1 || strlen($_POST['password']) < 1){
            displayAlert("Email/Password cannot be blank");
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
