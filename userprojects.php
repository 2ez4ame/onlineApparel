<?php include('includes/header.php'); ?>




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
    <span class="visually-hidden">unread messages</span>
  </span>
</button>
</div>

<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="a" src="icons/account.png" width="40" height="30" alt="account-logo"> My Account
          </a>
          <ul class="dropdown-menu" aria-labelledby="accountDropdown">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>


</div>
</nav>



<div class="container-project">
  <div class="create-box">
    <!-- New container/box -->
    <div class="box">
      <h3>Saved Projects</h3>
      <div class="vertical-line"></div>
      <button type="button" class="btn btn-bg-light position-relative">
        <img class="a" src="icons/add.png" width="40" height="30" alt="add-logo"> 
        <h4 style="display:inline; margin-left: 20px;">Create new project</h4>
      </button>
    </div>
  </div>
</div>

<div class="container-new-box">
  <div class="create-box">
    <h3>Title</h3>
    <p>Description......</p>
    
    <button class="btn-product btn-primary ">  <img src="pimages/gray.jpg" class="d-block w-100" alt="Image 1a"> </button> <!-- Replace with your desired button text -->
  </div>
</div>









<?php include('css/userprojectstyle.php'); ?>