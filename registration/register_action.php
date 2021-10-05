<?php 
if($_POST){
  function displayAlert($alert) { ?>
      <script type = "text/javascript">
          var alert_msg = "<?php echo $alert; ?>";
          alert(alert_msg);
          window.location.href = "../login/login.php";
      </script>
  <?php }

  require_once "../common/emailconfig.php";
  /*echo "Got Post Request<br>";
  echo "First name - " . $_POST["fname"] . "<br>";
  echo "Last name - " . $_POST["lname"] . "<br>";
  echo "Email - " . $_POST["email"] . "<br>";
  echo "password - " . $_POST["password"] . "<br>";*/


    if ($_POST["password"] == $_POST["cpwd"]) {
      //echo "Both passwords match <br>";
      $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
      //echo "Generated hash: ".$hash . "<br>";
    } else {
      //echo "Passwords did not match <br>";
    }

    $servername = "localhost";
    $username = "root";
    $password = "admin123db";
    $dbname = "snoops_dev";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully <br>";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $digits = 4;
    $verfcode = rand(pow(10, $digits-1), pow(10, $digits)-1);
    $sql = "INSERT INTO USERS (first_name, last_name, email_id, password, verified_email, admin_approved, user_type) VALUES ('$fname', '$lname', '$email', '$hash', $verfcode, 0, 1)";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();

    $mail->addAddress($email); //Recipient name is optional

    //Send HTML or Plain Text email
    $mail->isHTML(true);

    $mail->Subject = "Snoopes Verf Email";

    $mail->Body = "<a href='localhost/verify_email?email=$email&code=$verfcode'>Click Here to Verify your Email</a>";
    //$mail->AltBody = "This is the plain text version of the email content";
    //echo "Sending email to ". $email . "<br>";

    try {
        $mail->send();
        echo "Message has been sent successfully<br>";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    displayAlert("Registration Succesfull, Please Verify your email and Login!!");
}
?>