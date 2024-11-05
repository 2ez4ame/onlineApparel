<?php include('includes/header.php'); ?>
<?php include('css/placeorderstyle.php') ?>

<nav class="navbar">
  <div class="container">
    <a class="navbar-brand" href="#">
      <button type="button" class="btn-icon">
        <img class="a" src="icons/logo.png" width="60" height="50" alt="GZEL Logo">
      </button>
      <div class="brand-text">
        <span class="gz-text">GZEL<br>Digital Design and Printing</span>
      </div>
    </a>
  </div>
  <div class="container-notification">
    <button type="button" class="btn btn-bg-light position-relative">
    <img class="a" src="icons/notification.png" width="40" height="30" alt="notification-logo">
  <span class="position-absolute top-0 start-90 translate-middle badge rounded-pill bg-danger">
    9+
    <span class="visually-hidden">Unread messages</span>
  </span>
</button>
</div>

<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
  <img class="a" src="icons/account.png" width="40" height="30" alt="account-logo"> 
  </a>
  <ul class="dropdown-menu" aria-labelledby="accountDropdown">
    <li><a class="dropdown-item" href="#">Profile</a></li>
    <li><a class="dropdown-item" href="#">Settings</a></li>
    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
  </ul>
</li>
</ul>
</div>
</div>
</nav>
<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to logout?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="login.php" class="btn btn-primary">Logout</a>
      </div>
    </div>
  </div>
</div>
<div class="container-project">
  <div class="create-box">
    
    <div class="box">
    <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Default checkbox
  </label>
</div>
    </div>
  </div>
</div>
<div class="container-order">
  <div class="create-box-2">
    <!-- New container/box -->
    <div class="box-2">
    <div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
</div>
    </div>
    </div>
    </div>
<div class="container-project-1">
  <div class="create-box-3">
    
    <div class="box-3">
      
    </div>
  </div>
