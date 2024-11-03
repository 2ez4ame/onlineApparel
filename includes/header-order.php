<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>Online Clothing</title>
  
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      background-color: #D9D9D9;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: white;
      color: black;
      padding: 10px 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: 100%;
    }

    .logo {
      display: flex;
      align-items: center;
    }

    .logo img {
      height: 50px; 
      margin-right: 10px;
    }

    .logo h1 {
      font-size: 20px;
      margin: 0;
    }

    .nav {
      display: flex;
      gap: 15px;
      align-items: center;
    }

    .nav a {
      color: black;
      text-decoration: none;
      font-size: 14px;
      display: flex;
      align-items: center;
    }

    .nav a:hover {
      text-decoration: none; 
    }

    .nav i {
      margin-right: 5px;
    }
  
    .nav .icon {
      font-size: 25px; 
      color: black; 
    }

    .dropdown {
      position: relative;
      display: inline-block;
      margin-right: 15px;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 160px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      z-index: 1;
      right: 0; 
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

    .dropdown-button {
      background-color: white;
      border: none;
      cursor: pointer;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .dropdown-button i {
      font-size: 20px;
      transition: transform 0.3s;
    }

    .dropdown-button.active i {
      transform: rotate(180deg); 
    }

    .notification-dropdown {
      position: relative;
      display: inline-block;
    }

    .notification-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 200px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      z-index: 1;
      right: 0; 
    }

    .notification-content p {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      margin: 0;
    }

    .notification-content hr {
      margin: 0;
      border: none;
      border-top: 1px solid #f1f1f1;
    }

    .notification-content p:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>
<body>
  <header class="header">
    <div class="logo">
      <img src="icons/logo.png" alt="Logo">
      <h1>GZEL Digital Design and 
        <br>
        Printing</h1>
    </div>
    <nav class="nav">
      <div class="notification-dropdown">
        <a href="#notifications" id="notificationButton">
          <i class='bx bx-bell icon'></i>
        </a>
        <div class="notification-content" id="notificationContent">
          <p>New order from user1</p>
          <hr>
          <p>Order status updated</p>
          <hr>
          <p>New order from user2</p>
        </div>
      </div>
      <a href="#users">
        <i class='bx bx-user icon'></i>
        <div class="dropdown">
          <button class="dropdown-button" id="dropdownButton">
            <i class='bx bx-chevron-down'></i>
          </button>
          <div class="dropdown-content" id="dropdownContent">
            <a href="#profile">Profile</a>
            <a href="#settings">Settings</a>
            <a href="#logout">Logout</a>
          </div>
      </a>

      </div>
    </nav>
  </header>
</body>
</html>