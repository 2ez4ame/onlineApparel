<?php 
include('databaseconnection.php');
session_start();


$first_name = "Admin"; // Default value

if (isset($_SESSION['user_id'])) {
  // Get user ID from session
  $user_id = $_SESSION['user_id'];

  // Debug: Check if user_id exists
  if (empty($user_id)) {
    echo "No user ID in session.";
    exit;
  }

  // Query to fetch the first_name of the logged-in user
  $query = "SELECT first_name FROM users WHERE user_id = ? AND role = 'admin'";
  if ($stmt = $conn->prepare($query)) {
      $stmt->bind_param("i", $user_id);  // Binding the user_id parameter
      $stmt->execute();
      $stmt->bind_result($first_name);
      $stmt->fetch();
      
      if (empty($first_name)) {
        echo "No first name found for user ID: " . $user_id;
      }

      $stmt->close();
  } else {
      echo "Error preparing query: " . $conn->error;
  }
} 
?>



  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="shortcut icon" href="icons/logo.png" type="image/x-icon">
  
  <style>
    /* Rest of your styles */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #D9D9D9;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: white;
      color: black;
      padding:  15px 10px ;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .logo {
      display: flex;
      align-items: center;
    }

    .logo img {
      height: 40px; 
      margin-right: 10px;
    }

    .logo h1 {
      font-size: 18px;
      margin: 0;
      cursor: pointer;
    }

    .logo h1:hover {
      color: #556B2F;
      cursor: pointer;
      transition: 0.3s;
    }

    .nav {
      display: flex;
      align-items: center;
      gap: 20px; 
    }

    .notification-dropdown {
      position: relative;
    }

    .notification-content {
      display: none;
      position: absolute;
      top: 40px; /* Position below the icon */
      right: 5px;
      background-color: white;
      min-width: 200px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      z-index: 1;
      margin-right: 10px;
    }

    .notification-content p {
      margin: 0;
      padding: 10px 15px;
      color: black;
      border-bottom: 1px solid #f1f1f1;
      cursor: pointer;
    }

    .notification-content p:hover {
      background-color: #f1f1f1;
    }

    .badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background-color: red;
      color: white;
      border-radius: 50%;
      padding: 2px 6px;
      font-size: 12px;
    }

    .icon {
      font-size: 25px;
      position: relative;
      color: black;
      
    }
    .icon:hover{
      color: #556B2F;
      cursor: pointer;
      transition: 0.3s;
    }
    .admin {
      position: relative; /* Position it to align the dropdown beneath */
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .admin a {
      color: black;
      text-decoration: none;
      font-size: 20px;
    }

    .admin a:hover {
      color: #556B2F;
      cursor: pointer;
      transition: 0.3s;
    }

    .header a{
      text-decoration: none;
      color:black;
    }

    .dropdown-content {
      display: none; /* Hide by default */
      position: absolute;
      top: 100%; /* Position it directly below */
      left: 0;
      background-color: white;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      min-width: 160px;
      z-index: 1;
      border-radius: 4px;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

    .modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; 
  background-color: rgba(0,0,0,0.4); 
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto; 
  padding: 20px;
  border: 1px solid #888;
  width: 40%; /* Adjusted width to be a little bit smaller */
  max-width: 350px; /* Adjusted max-width to be a little bit smaller */
  text-align: center;
  border-radius: 10px; /* Added border radius */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Added box shadow for a nicer look */
}

.modal-content button {
  margin-top: 10px;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  border-radius: 30px; 
  font-size: 16px;

}

.modal-content p {
  font-size: 18px;
  font-weight: bold;
  margin-top: 10px;
}

.modal-content .confirm {
  background-color: #6B8E23;
  ;
  color: white;
  margin-left: 5px;
}

.modal-content .confirm:hover {
  background-color: #556B2F; /* Added hover effect */
}

.modal-content .cancel {
  background-color: #f44336;
  color: white;
  margin-right: 5px;
}

.modal-content .cancel:hover {
  background-color: #e53935; /* Added hover effect */
}
  </style>

  <header class="header">
    <div class="logo">
        <button onclick="window.location.href='admin-page.php'">
            <img src="icons/logo.png" alt="Logo">
        </button>
        <a href="admin-page.php">
            <h1>GZEL 
              <br>
            Digital Design and Printing</h1>
        </a>
    </div>

    <nav class="nav">
      <div class="notification-dropdown">
        <a href="javascript:void(0);" id="notificationButton">
          <i class='bx bx-bell icon' style="font-size:35px; margin-top:7px;">
            <span class="badge" id="notificationCount">3</span>
          </i>
        </a>
        <div class="notification-content" id="notificationContent">
          <p>New order from user1</p>
          <p>Order status updated</p>
          <p>New order from user2</p>
          <p>New order from user2</p>
        </div>
      </div>
      <a href="#users">
        <i class='bx bx-user icon ' style="font-size:35px; margin-top:7px;"></i>
      </a>
      <div class="admin">
        <a onclick="toggleDropdown()" style="cursor: pointer;">
          Welcome, <?php echo htmlspecialchars($first_name); ?> <i class='bx bx-chevron-down' style="font-size:25px;"></i>
        </a>
        <div id="dropdown" class="dropdown-content" style="display: none;">
          <a href="profile.php">Profile</a>
          <a href="save_projects.php">Save Projects</a>
          <a href="javascript:void(0);" onclick="logout()">Logout</a>

        </div>
      </div>

    </nav>
  </header>

  <div id="logoutModal" class="modal">
    <div class="modal-content">
      <p>Are you sure you want to logout?</p>
      <button class="confirm" onclick="confirmLogout()">Yes</button>
      <button class="cancel" onclick="closeModal()">No</button>
    </div>
  </div>

  <script>
    // Toggle notification dropdown visibility
    document.getElementById('notificationButton').onclick = function() {
      const notificationContent = document.getElementById('notificationContent');
      notificationContent.style.display = notificationContent.style.display === 'block' ? 'none' : 'block';
    }

    // Close the notification dropdown if clicked outside
    window.onclick = function(event) {
      if (!event.target.closest('.notification-dropdown')) {
        document.getElementById('notificationContent').style.display = 'none';
      }
      if (!event.target.closest('.admin')) {
        const dropdown = document.getElementById("dropdown");
        if (dropdown && dropdown.style.display === "block") {
          dropdown.style.display = "none";
        }
      }
      if (!event.target.closest('.modal-content') && !event.target.closest('.admin a[href="#"]')) {
        closeModal();
      }
    }

    // Update notification count dynamically based on available notifications
    const notificationCount = document.getElementById('notificationContent').children.length;
    document.getElementById('notificationCount').innerText = notificationCount;

    function toggleDropdown() {
      const dropdown = document.getElementById("dropdown");
      dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
    }
    function logout() {
      // Show the confirmation modal
      document.getElementById('logoutModal').style.display = 'block';
    }

    function confirmLogout() {
      // Proceed with the logout by redirecting to logout.php
      window.location.href = "logout.php";
    }

    function closeModal() {
      // Hide the confirmation modal if "No" is clicked
      document.getElementById('logoutModal').style.display = 'none';
    }


  </script>
