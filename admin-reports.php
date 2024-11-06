<link rel="shortcut icon" href="icons/logo.png" type="image/x-icon">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
  .dashboard-container {
    display: grid;
    grid-template-columns: 1fr 1fr; 
    gap: 30px; 
    max-width: 1200px;
    width: 100%;
  }

  .small-box-container, .large-box-container {
    display: flex;
    flex-direction: column;
    gap: 20px; 
  }

  .large-box-container {
    margin-bottom: 10px;
    grid-row: span 2;
    width: 900px;
    position: relative; /* Added for positioning the profit text */
    display: flex;
    flex-direction: column;
  }

  .overall-profit {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 16px;
    color: #4CAF50;
  }

  .dashboard-box {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
  }

  .small-box-container {
    margin-right: 30px; 
    padding: 0; 
    box-sizing: border-box; 
    width: 300px; 
  }

  .small-box-title {
    align-self: flex-start; 
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    color:#31511E;
  }

  .chart-container {
    position: relative;
    height: 400px; /* Increased height */
    width: 100%;
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
  }

  .chart-container canvas {
    width: 100%; /* Ensure the canvas takes full width */
    height: 100%; /* Ensure the canvas takes full height */
  }

  .date-range-selector {
    margin-bottom: 10px;
  }

  .date-range-selector select {
    cursor: pointer; /* Apply cursor pointer to the select element */
  }

  #dateRange option{
    cursor: pointer;
  }

  .progress-bar-container {
    width: 100%;
    height: 10px;
    background-color: #e0e0e0;
    border-radius: 5px;
    overflow: hidden;
    padding: 2px;
  }

  .progress-bar {
    width: 45%;
    height: 100%;
    background-color: #4CAF50;
  }

  .history-box {
    display: flex;
    flex-direction: column;
    width: 100%;
  }

  .history-header {
    display: flex;
    justify-content: space-between;
    width: 100%;
    font-size: 16px;
    font-weight: bold;
    border-bottom: 1px solid #e0e0e0; /* Added separator */
    padding-bottom: 10px; /* Added padding for spacing */
    color:#31511E;
  }

  .history-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    width: 100%; /* Ensure the item takes full width */
  }

  .history-item .item-text {
    display: flex;
    align-items: center; /* Align items vertically */
    flex-grow: 1; /* Allow the text to take available space */
  }

  .history-item .item-time {
    text-align: right; 
    flex-shrink: 0; /* Prevent the time from shrinking */
    margin-left: 20px; /* Add space between text and time */
  }
  
  .icon {
    margin-top: 10px;
  }

  .stat-number{
    font-size: 45px;
    font-weight: bold;
    margin-right: 40px;
    margin-left: 40px; /* Added margin to the left */
  }

  .icons{
    margin-right: 25px;
  }

  .circle-box {
    width: 10px;
    height: 10px;
    background-color: #31511E;
    border-radius: 50%;
    display: inline-block;
    margin-right: 10px; /* Space between circle and text */
    vertical-align: middle; /* Align with text */
  }

  .circle-box span .hours{
    display: flex;
    justify-content: space-between;
  }

  .history-item span {
    display: flex;
    align-items: center; /* Align items vertically */
  }

  .showHistory{
    color: #4CAF50;
    cursor: pointer;
    border: none;
    background-color: transparent;
    padding:7px;
    border-radius: 5px;
    font-weight: bold;
  }
  .showHistory:hover{
    color: white;
    cursor: pointer;
    border: none;
    background-color: #508D4E;
    transition: 0.5s;
  }
  .history-item.hidden {
    display: none;
  }
</style>

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