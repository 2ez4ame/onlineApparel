<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      top: 30px; /* Position below the icon */
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
    .admin{
      display: flex;
      align-items: center;
      gap: 5px;
      

    }

    .admin a{
      color: black;
      text-decoration: none;
      font-size: 20px;
    }

    .admin a:hover{
      color: #556B2F;
      cursor: pointer;
      transition: 0.3s;
    }
    .header a{
      text-decoration: none;
      color:black;
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="logo">
        <button onclick="window.location.href='admin-page.php'">
            <img src="icons/logo.png" alt="Logo">
        </button>
        <a href="admin-page.php">
            <h1>GZEL Digital Design and Printing</h1>
        </a>
    </div>

    <nav class="nav">
      <div class="notification-dropdown">
        <a href="javascript:void(0);" id="notificationButton">
          <i class='bx bx-bell icon' style="font-size:35px">
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
        <i class='bx bx-user icon ' style="font-size:35px"></i>
      </a>
      <div class="admin">
        <a href="#">admin <i class='bx bx-chevron-down' style="font-size:25px;"></i></a>
      </div>
    </nav>
  </header>

  <script>
    // Toggle notification dropdown visibility
    document.getElementById('notificationButton').onclick = function() {
      const notificationContent = document.getElementById('notificationContent');
      notificationContent.style.display = notificationContent.style.display === 'block' ? 'none' : 'block';
    }

    // Close the dropdown if clicked outside
    window.onclick = function(event) {
      if (!event.target.closest('.notification-dropdown')) {
        document.getElementById('notificationContent').style.display = 'none';
      }
    }

    // Update notification count dynamically based on available notifications
    const notificationCount = document.getElementById('notificationContent').children.length;
    document.getElementById('notificationCount').innerText = notificationCount;
  </script>
</body>
</html>
