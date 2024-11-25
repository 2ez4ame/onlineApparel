<?php

include 'includes/header-admin.php';
include('databaseconnection.php');




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
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Faculty+Glyphic&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Faculty+Glyphic&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap');
    *{
      font-family: "Poppins", sans-serif;
      font-weight: 600;
      font-style: normal;
    }
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
    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-button {
      background-color: white;
      color: black;
      padding: 10px 20px;
      font-size: 20px;
      color: #31511E;
      border: 1px solid #31511E;
      cursor: pointer;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 155px; 
      margin: -20px 0 0 670px;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: white;
      min-width: 50px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      z-index: 1;
      border-radius: 5px;
      margin: 0; /* Adjusted margin */
    }

    .dropdown-content a {
      color: #31511E;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

    .dropdown.open .dropdown-content {
      display: block;
    }
  </style>
</head>
<body>
  <div class="main-content">
    <?php include 'includes/sidebar-admin.php'; ?>
    
    <div class="content" id="content">
      <!-- Initial content or placeholder -->
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
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('expanded');
    }
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
        const script = document.createElement('script');
        script.text = scripts[i].innerText;
        document.body.appendChild(script).parentNode.removeChild(script);
      }
    }

    function toggleDropdown(event) {
      event.stopPropagation(); // Prevent the click from propagating to the window click event
      const dropdownContent = event.target.closest('.dropdown').querySelector('.dropdown-content');
      dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    }

    // Close the dropdown if clicked outside
    window.onclick = function(event) {
      if (!event.target.matches('.dropdown-button') && !event.target.closest('.dropdown')) {
        const dropdowns = document.getElementsByClassName('dropdown-content');
        for (let i = 0; i < dropdowns.length; i++) {
          const openDropdown = dropdowns[i];
          if (openDropdown.style.display === 'block') {
            openDropdown.style.display = 'none';
          }
        }
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll('.dropdown-button').forEach(button => {
        button.addEventListener('click', toggleDropdown);
      });
    });

    function toggleHistory() {
      const historyItems = document.querySelectorAll('.history-box .history-item');
      const button = document.querySelector('.showHistory span');
      const isHidden = button.textContent === 'Show all history';

      historyItems.forEach((item, index) => {
        if (index !== 0) {
          item.classList.toggle('hidden', !isHidden);
        }
      });

      button.textContent = isHidden ? 'Hide history' : 'Show all history';
    }

    // Ensure only the first history item is visible on page load
    function initializeHistory() {
      const historyItems = document.querySelectorAll('.history-box .history-item');
      const button = document.querySelector('.showHistory span');

      historyItems.forEach((item, index) => {
        if (index !== 0) {
          item.classList.add('hidden');
        }
      });

      button.textContent = 'Show all history';
    }

    // Reinitialize the DOMContentLoaded event listener
    document.addEventListener('DOMContentLoaded', () => {
      if (typeof initializeHistory === 'function') {
        initializeHistory();
      }
      document.querySelectorAll('.dropdown-button').forEach(button => {
        button.addEventListener('click', toggleDropdown);
      });
    });

    
    function toggleDropdown() {
      const dropdown = document.getElementById("dropdown");
      dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
    }

    function logout() {
      // Add PHP code to destroy session and redirect
      window.location.href = "login2.php";
    }

    // Optional: Close dropdown if clicked outside
    window.onclick = function(event) {
      if (!event.target.matches('#firstName')) {
        const dropdown = document.getElementById("dropdown");
        if (dropdown && dropdown.style.display === "block") {
          dropdown.style.display = "none";
        }
      }
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
    function displayOrderDetails(orderId) {
      // Create a new XMLHttpRequest object
      var xhr = new XMLHttpRequest();
      
      // Set up the request
      xhr.open('GET', 'fetch_order_details.php?id=' + orderId, true);
      
      // Define the callback function for when the request completes
      xhr.onload = function() {
        if (xhr.status === 200) {
          var order = JSON.parse(xhr.responseText);
          
          // Populate the order details section with the fetched data
          document.getElementById('orderId').textContent = order.id;
          document.getElementById('orderProduct').textContent = order.product;
          document.getElementById('orderQuantity').textContent = order.quantity;
          document.getElementById('orderBust').textContent = order.bust;
          document.getElementById('orderWaist').textContent = order.waist;
          document.getElementById('orderShoulder').textContent = order.shoulder;
          document.getElementById('orderDate').textContent = order.order_date;
          
          // Set up the Accept button click handler
          var acceptButton = document.querySelector('.accept');
          acceptButton.onclick = function() {
            updateOrderStatus('accept', order);
          };
          
          // Set up the Decline button click handler
          var declineButton = document.querySelector('.decline');
          declineButton.onclick = function() {
            updateOrderStatus('decline', order.id);
          };
        }
      };

      // Send the request
      xhr.send();
    }

    function updateOrderStatus(action, order) {
      var xhrUpdate = new XMLHttpRequest();
      var status = action === 'accept' ? 'Completed' : 'Declined'; // Set status based on action

      xhrUpdate.open('GET', 'update_order_status.php?id=' + order.id + '&status=' + status, true);

      xhrUpdate.onload = function() {
        if (xhrUpdate.status === 200) {
          alert('Order ' + status + ' successfully!');
          if (status === 'Completed') {
            addToConfirmedOrders(order); // Ensure order data is passed correctly
          }
        } else {
          alert('Error: ' + xhrUpdate.responseText);
        }
      };

      xhrUpdate.send();
    }

    function addToConfirmedOrders(order) {
      // Get the confirmed orders table
      var table = document.querySelector('.confirmed-orders tbody');
      
      // Create a new row with the confirmed order details
      var row = document.createElement('tr');
      row.innerHTML = `
        <td>${order.id}</td>
        <td>${order.product}</td>
        <td>${order.quantity}</td>
        <td>${order.bust}</td>
        <td>${order.waist}</td>
        <td>${order.shoulder}</td>
      `;
      
      // Append the new row to the table
      table.appendChild(row);
    }
  </script>
</body>
</html>
