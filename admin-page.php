<?php
include 'includes/header-admin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="icons/logo.png" type="image/x-icon">
  <title>Admin</title>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      display: flex;
      flex-direction: column;
      height: 100vh;
      margin: 0;
    }

    .main-content {
      display: flex;
      flex: 1;
    }

    .sidebar {
      width: 250px;
      background-color: #ffffff;
      padding: 20px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      margin-top: 20px;
    }

    .content {
      flex: 1;
      padding: 20px;
      background-color: #D9D9D9;
      display: flex;
      flex-direction: column;
      align-items: center; 
      justify-content: center; 
    }
    
    .h1text, .text {
      text-align: center;
    }
    .h1text {
      font-size: 30px;
      margin-bottom: 20px;
    }
    .text {
      font-size: 20px;
      margin-bottom: 20px;
    }
    .images {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 20px;
    }
    button {
      background-color: #ffffff;
      border: none;
      cursor: pointer;
      border-radius: 150px;
    }
  </style>
</head>
<body>
  <div class="main-content">
    <?php include 'includes/sidebar-admin.php'; ?>
    
    <div class="content" id="content">
      <div class="h1text">
        <h1>Start your Design now!</h1>
      </div>
      <div class="text">
        <p>Select one of our blanks, add your designs, and export</p>
      </div>
      <div class="images">
        <div>
          <button><img src="icons/tshirt.png" alt="tshirt"></button>
        </div>
        <div>
          <button><img src="icons/polo.png" alt="tshirt"></button>
        </div>
        <div>
          <button><img src="icons/polo.png" alt="tshirt"></button>
        </div>
      </div>
    </div>
  </div>
  <script>
    function loadContent(url) {
      const xhr = new XMLHttpRequest();
      xhr.open('GET', url, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          document.getElementById('content').innerHTML = xhr.responseText;
          reinitializeScripts();
        }
      };
      xhr.send();
    }

    function reinitializeScripts() {
      const scripts = document.getElementById('content').getElementsByTagName('script');
      for (let i = 0; i < scripts.length; i++) {
        eval(scripts[i].innerText);
      }
      // Ensure initializeHistory is called after scripts are reinitialized
      if (typeof initializeHistory === 'function') {
        initializeHistory();
      }
    }

    // Reinitialize the DOMContentLoaded event listener
    document.addEventListener('DOMContentLoaded', () => {
      if (typeof initializeHistory === 'function') {
        initializeHistory();
      }
    });
  </script>
</body>
</html>