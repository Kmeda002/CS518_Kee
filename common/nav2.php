<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Snopes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/home.php">Home</a>
        </li>
        <?php if ($_SESSION["user_type"] == 0) { ?>
          <li class="nav-item"><a class="nav-link" href="/admin/admin_approval.php">Pending Requests</a></li>
        <?php } ?>
        <li class="dropdown">
          <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> Account Settings </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../profile/view_profile.php">View Profile</a></li>
            <li><a class="dropdown-item" href="../profile/change_account.php">Update Account Details</a></li>
            <li><a class="dropdown-item" href="../security/change_password.php">Change Password</a></li>
        </ul>
        </li>
      </ul>
      <!--<form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>