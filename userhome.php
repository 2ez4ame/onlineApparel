<?php 
// Include the database connection
include('databaseconnection.php');

// Start session
session_start();

// Fetch logged-in user's details if session is set
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT first_name FROM users WHERE user_id = ?";
    
    // Prepare the statement
    if ($stmt = $conn->prepare($query)) {
      $stmt->bind_param("i", $user_id);
      $stmt->execute();
      $stmt->bind_result($first_name);
      $stmt->fetch();
      $stmt->close();
    }
} else {
    // Fetch the first user's first name if no user is logged in
    $query = "SELECT first_name FROM users LIMIT 1";  // Get the first account
    if ($stmt = $conn->prepare($query)) {
        $stmt->execute();
        $stmt->bind_result($first_name);
        $stmt->fetch();
        $stmt->close();
    }
}
?>

<?php include('includes/header.php'); ?>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<nav class="navbar">
  <div class="container">
    <a class="navbar-brand" href="#">
      <button type="button" class="btn-icon">
        <img class="a" src="icons/logo.png" width="60" height="50" alt="GZEL Logo">
      </button>
      <div class="brand-text">
        <span class="gz-text" style="font-weight:bold; color:black;">GZEL<br>Digital Design and Printing</span>
      </div>
    </a>
  </div>

  <div class="notification">
      <button style="border: none; background: transparent; padding-bottom:20px;margin-right:20px;" >
        <i class='bx bx-bell' style='font-size: 30px; margin-top:5px;'></i>
      </button>
  </div>

  <div class="nav-item dropdown">
      <a class="nav-link d-flex align-items-center custom-account" href="#" id="accountDropdown" role="button" aria-expanded="false">
        <i class="bx bx-user" style='font-size: 30px; margin-top:5px;'></i>
        <span style="font-size: 20px; color: black; margin-right: 5px;">Welcome,</span>
        <span style="font-size: 20px; font-weight: bold; color: green;"><?php echo htmlspecialchars($first_name); ?></span>
        <i class="bx bx-chevron-down" style='font-size: 25px; color: green;'></i>
      </a>
      <ul class="dropdown-menu" aria-labelledby="accountDropdown">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
      </ul>
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
        <a href="login2.php" class="btn btn-primary" id="confirmLogout">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
  var accountDropdown = document.getElementById('accountDropdown');
  var dropdownMenu = accountDropdown.nextElementSibling;

  // Initially hide the dropdown menu
  dropdownMenu.classList.remove('show');

  // Toggle the dropdown visibility when clicked
  accountDropdown.addEventListener('click', function (event) {
    if (dropdownMenu.classList.contains('show')) {
      // Close dropdown if it is open
      dropdownMenu.classList.remove('show');
      accountDropdown.setAttribute('aria-expanded', 'false');
    } else {
      // Open dropdown
      dropdownMenu.classList.add('show');
      accountDropdown.setAttribute('aria-expanded', 'true');
    }

    // Prevent the event from bubbling up to document
    event.stopPropagation();
  });

  // Close the dropdown if clicked outside of it
  document.addEventListener('click', function (event) {
    // Check if the click is outside of the dropdown
    if (!accountDropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
      dropdownMenu.classList.remove('show');
      accountDropdown.setAttribute('aria-expanded', 'false');
    }
  });
});

</script>

<?php include('css/userhomestyle.php'); ?>
