<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Snopes</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="../home.php">Home</a></li>
      <?php if ($_SESSION["user_type"] == 0) { ?>
      	<li><a href="../admin/admin_approval.php">Pending Requests</a></li>
      <?php } ?>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Account Settings
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="../profile/view_profile.php">View Profile</a></li>
          <li><a href="../profile/change_account.php">Update Account Details</a></li>
          <li><a href="../security/change_password.php">Change Password</a></li>
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['email']?></a></li>
      <li><a href="../login/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>