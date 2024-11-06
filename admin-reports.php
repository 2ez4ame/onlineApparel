<?php include('includes/header.php'); ?>
<?php include('css/adminreportstyle.php') ?>
<link rel="shortcut icon" href="icons/logo.png" type="image/x-icon">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


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
<?php include 'includes/sidebar-admin.php'; ?>
<div class="dashboard-container">
  <div class="small-box-container">
    <div class="dashboard-box small-box" style="display: flex; flex-direction: column; align-items: center;">
      <div class="small-box-title">
        New Orders
      </div>
      <div class="icon-number-wrapper" style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
        <div class="icon" style="padding-left: 20px; padding-bottom:5px;">
          <i class='bx bx-detail' style="font-size:50px; "></i>
        </div>
        <div class="stat-number" style="text-align: center; flex-grow: 1; margin-left: 40px;">
          500
        </div>
        <div class="icons" style="padding-left: -10px; padding-bottom:5px;">
          <i class='bx bx-bar-chart' style="font-size:50px;"></i>
        </div>
      </div>
    </div>

    <div class="dashboard-box small-box" style="display: flex; flex-direction: column; align-items: center;">
      <div class="small-box-title">
        Pending Orders
      </div>
      <div class="icon-number-wrapper" style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
        <div class="icon" style="padding-left: 20px; padding-bottom:5px; ">
          <i class='bx bx-time-five' style="font-size:50px;"></i>
        </div>
        <div class="stat-number" style="text-align: center; flex-grow: 1; margin-left: 40px;">
          405
        </div>
        <div class="icons" style="padding-left: -10px; padding-bottom:5px;">
          <i class='bx bx-bar-chart' style="font-size:50px;"></i>
        </div>
      </div>
    </div>

    <div class="dashboard-box small-box" style="display: flex; flex-direction: column; align-items: center;">
      <div class="small-box-title">
        Completed Orders
      </div>
      <div class="icon-number-wrapper" style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
        <div class="icon" style="padding-left: 20px; padding-bottom:5px; ">
          <i class='bx bx-check' style="font-size:50px;"></i>
        </div>
        <div class="stat-number" style="text-align: center; flex-grow: 1; margin-left: 40px;">
          500
        </div>
        <div class="icons" style="padding-left: -10px; padding-bottom:5px;">
          <i class='bx bx-bar-chart' style="font-size:50px;"></i>
        </div>
      </div>
    </div>

    <div class="dashboard-box small-box">
      <div class="small-box-title">Monthly Progress</div>
      <div class="progress-bar-container">
        <div class="progress-bar"></div>
      </div>
      <div style="margin-top: 10px; font-size: 14px;">45%</div>
    </div>
  </div>

  <div class="large-box-container">
    <div class="dashboard-box large-box">
      <div class="date-range-selector" style="font-weight:bold; color:#31511E;">
        <label for="dateRange">Select Date Range: </label>
        <select id="dateRange">
          <option value="week">Week</option>
          <option value="month">Month</option>
          <option value="year">Year</option>
        </select>
      </div>

      <div class="chart-container">
        <canvas id="profitChart"></canvas>
      </div>
      <div class="overall-profit" style="font-weight:bold;">3.5% Overall Profit</div> <!-- Moved profit text -->
    </div>

    <div class="dashboard-box history-box">
      <div class="history-header">
        <span>History</span>
        <button onclick="toggleHistory()" class="showHistory"><span>Show all history</span> </button>
      </div>
      <div class="history-item">
        <div class="item-text">
          <span class="circle-box"></span> 
          <span>T-shirt Small</span>
        </div>
        <div class="item-time">
          <span>21 hrs ago</span>
        </div>
      </div>
      <div class="history-item hidden">
        <div class="item-text">
          <span class="circle-box"></span> 
          <span>T-shirt Large</span>
        </div>
        <div class="item-time">
          <span>8 hrs ago</span>
        </div>
      </div>
      <div class="history-item hidden">
        <div class="item-text">
          <span class="circle-box"></span> 
          <span>T-shirt Medium</span>
        </div>
        <div class="item-time">
          <span>69 hrs ago</span>
        </div>
      </div>
      <div class="history-item hidden">
        <div class="item-text">
          <span class="circle-box"></span> 
          <span>T-shirt XL</span>
        </div>
        <div class="item-time">
          <span>100 years ago</span>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const ctx = document.getElementById('profitChart').getContext('2d');

  const chartData = {
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    datasets: [{
      label: 'Profit',
      data: [12000, 15000, 8000, 14000, 18000, 13000, 16000],
      backgroundColor: 'rgba(75, 192, 192, 0.2)',
      borderColor: 'rgba(75, 192, 192, 1)',
      borderWidth: 2
    }]
  };

  const profitChart = new Chart(ctx, {
    type: 'line',
    data: chartData,
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  document.getElementById('dateRange').addEventListener('change', function() {
    const selectedRange = this.value;

    if (selectedRange === 'week') {
      profitChart.data.labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
      profitChart.data.datasets[0].data = [12000, 15000, 8000, 14000, 18000, 13000, 16000];
    } else if (selectedRange === 'month') {
      profitChart.data.labels = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];
      profitChart.data.datasets[0].data = [50000, 45000, 60000, 70000];
    } else if (selectedRange === 'year') {
      profitChart.data.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
      profitChart.data.datasets[0].data = [300000, 280000, 320000, 290000, 310000, 330000, 340000, 300000, 320000, 310000, 280000, 350000];
    }

    profitChart.update();
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

  document.addEventListener('DOMContentLoaded', initializeHistory);
</script>