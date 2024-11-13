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
if ($_SERVER['REQUEST_URI'] == '/onlineapparel/thispagedoesnotexist') {
  // Display 404 custom error message here
  echo '<h1>404 - Page Not Found</h1>';
  echo '<p>Oops! The page you are looking for does not exist.</p>';
  echo '<p>You can go back to the homepage or browse other pages.</p>';
  echo '<a href="userhome.php">Go to Homepage</a>';
  exit; // Stop further processing if 404 error
}
?>

<?php include('includes/header.php'); ?>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="bootstrap.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

<style>
  .container{
    width: 100%;
    margin: 20px auto;
    align-items: center;
    justify-content: center;
  }

  .images {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 20px;
      cursor: pointer;
    }
 
</style>
<nav class="navbar">
  <div class="container">
    <a class="navbar-brand" href="#">
      <button type="button" class="btn-icon" onclick="backtoHome()">
        <img class="a" src="icons/logo.png" width="60" height="50" alt="GZEL Logo">
      </button>
      <div class="brand-text" onclick="backtoHome()">
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
        <span style="font-weight:bold;font-size: 25px; color: black; margin-right: 5px;">Welcome,</span>
        <span style="font-size: 20px; font-weight: bold; color: green;"><?php echo htmlspecialchars($first_name); ?></span>
        <i class="bx bx-chevron-down" style='font-size: 25px; color: green;'></i>
      </a>
      <ul class="dropdown-menu" aria-labelledby="accountDropdown">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><a class="dropdown-item" href="#" onclick="loadSavedProjects()">Saved Projects</a></li>
        <li><a class="dropdown-item" href="#" onclick="orderPlaced()">My Purchases</a></li>
        
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
<div id="savedProjectsContainer"></div>

<div class="container2">
  <div class="row">
    <div class="col-md-20">
      <h1 class="text-center" style="font-family:Kanit, sans-serif;">Start your Designs now!</h1>
      <p class="text-center" style="font-family:Kanit, sans-serif;">Your one-stop shop for all your digital design and printing needs</p>
    </div>

    <div class="images">
        <div>
        <img onclick= "customizeTshirt()" src="icons/tshirt.png" alt="tshirt">
        </div>
        <div>
        <img onclick= "customizePolo()" src="icons/polo.png" alt="tshirt">
        </div>
        <div>
          <img onclick= "customizeOversize()" src="icons/oversize.png" alt="tshirt">
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
function loadSavedProjects() {
  const container2 = document.querySelector('.container2');
  
  if (container2) {
    // Hide container2 using both display and visibility
    container2.style.display = 'none';
    container2.style.visibility = 'hidden';

    // Apply a hidden CSS class as a fallback
    container2.classList.add('hidden-container2');
  }

  console.log("Container2 visibility set to hidden in loadSavedProjects");

  // Fetch and load saved projects
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "save-projects.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("savedProjectsContainer").innerHTML = xhr.responseText;
    }
  };
  xhr.send();
}


function orderPlaced() {

  document.querySelector('.container2').style.display = 'none'; //this is for the content will be hidden if another content is shown
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "order-customer.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Insert the response content into the placeholder div
            document.getElementById("savedProjectsContainer").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
function loadOrderStatus(event) {
  // If the click event was triggered by the checkbox, return early
  if (event.target.type === 'checkbox') {
    return;
  }

  // Hide the order-customer table
  document.getElementById("order-customer-table").classList.add("hidden");

  // Show the order-status content area
  const orderStatusContent = document.getElementById("order-status-content");
  orderStatusContent.classList.remove("hidden");

  // Fetch and load order-status.php content
  fetch('order-status.php')
    .then(response => response.text())
    .then(data => {
      orderStatusContent.innerHTML = data;
    })
    .catch(error => console.error('Error loading order-status.php:', error));
}

// Function to stop the click event from bubbling when the checkbox is clicked
function checkboxClick(event) {
  event.stopPropagation(); // Prevent the click event on the checkbox from triggering row click
}

function customize(){
  window.location.href = "customize.php";
 
}

function customizePolo(){
  window.location.href = "customize.php";
}
function Oversize(){
  window.location.href = "customize.php";
}

function backtoHome(){
  window.location.href = "userhome.php";
}
</script>

<?php include('css/userhomestyle.php'); ?>
