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
      // Reinitialize Chart.js if necessary
      if (typeof Chart !== 'undefined') {
        const charts = document.querySelectorAll('.chart');
        charts.forEach(chart => {
          const ctx = chart.getContext('2d');
          new Chart(ctx, {
            type: 'bar', // or 'line', 'pie', etc.
            data: {
              labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
              datasets: [{
                label: 'Dataset 1',
                data: [65, 59, 80, 81, 56, 55, 40],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        });
      }
      // Reinitialize dropdown functionality
      document.querySelectorAll('.dropdown-button').forEach(button => {
        button.addEventListener('click', toggleDropdown);
      });
      window.addEventListener('click', function(event) {
        if (!event.target.matches('.dropdown-button') && !event.target.closest('.dropdown')) {
          const dropdowns = document.getElementsByClassName('dropdown-content');
          for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.style.display === 'block') {
              openDropdown.style.display = 'none';
            }
          }
        }
      });
    }

    function toggleDropdown() {
      const dropdownContent = this.nextElementSibling;
      console.log('Dropdown button clicked');
      console.log('Dropdown content:', dropdownContent);
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
      if (!event.target.matches('.admin a')) {
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
  </script>
</body>
</html>
