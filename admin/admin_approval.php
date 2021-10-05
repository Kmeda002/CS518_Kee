<?php 
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "admin123db";
    $dbname = "snoops_dev";
?>

 <html>
 <head>
     <meta charset="utf-8">
     <title> Admin_Approval </title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 </head>
 <body>
    <?php require_once "../common/navbar.php"; ?>
    <div class="center">

    <table id = "users">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Action</th>
        </tr>

        <?php
            $conn = new mysqli($servername, $username, $password, $dbname);
            $query = "SELECT * FROM users WHERE admin_approved = 0";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_array($result)) {
        ?>
    <tr>
            <td><?php echo $row['first_name'];?></td>
            <td><?php echo $row['last_name'];?></td>
            <td><?php echo $row['email_id'];?></td>
            <td>
                <form action ="admin_approval.php" method ="POST">
                    <input type = "hidden" name = "email_id" value = "<?php echo $row['email_id'];?>"/>
                    <input type = "submit" name = "approve" value = "Approve"/>
                    <input type = "submit" name = "deny" value = "Deny"/>
                </form>
            </td>
        </tr>
    <?php } ?>
    </table>

<?php 
    if(isset($_POST['approve'])){
        $id = $_POST['email_id'];
        $select = "UPDATE users SET admin_approved = 1 WHERE email_id = '$id'";
        $result = mysqli_query($conn, $select);

        echo '<script type = "text/javascript">';
        echo 'alert("User Approved!");';
        echo 'window.location.href = "admin_approval.php"';
        echo '</script>';
    }

    if(isset($_POST['deny'])){
        $id = $_POST['email_id'];

        $select = "UPDATE users SET admin_approved = -1 WHERE email_id = '$id'";
        $result = mysqli_query($conn, $select);

        echo '<script type = "text/javascript">';
        echo 'alert("User Denied!");';
        echo 'window.location.href = "admin_approval.php"';
        echo '</script>'; }
?>
</div>
</body>
</html>