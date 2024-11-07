<link rel="shortcut icon" href="icons/logo.png" type="image/x-icon">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    background-color: #D9D9D9;
  }
  .dashboard-container {
    display: flex;
    flex-direction: row;
    gap: 30px;
    padding: 20px;
  }

  .small-box-container {
    display: flex;
    flex-direction: column;
    padding: 0;
    box-sizing: border-box;
    width: 300px;
    gap: 20px;
    margin: 40px 0 0 20px;
  }
  .large-box-container {
    grid-column: 2; 
    width: 800px;
    height: 300px; 
    position: relative;
    display: flex;
    flex-direction: row;
    margin: -588px 0 0  400px;
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
  .small-box-title {
    align-self: flex-start; 
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    color:#31511E;
  }

  .stat-number{
    font-size: 45px;
    font-weight: bold;
    margin-right: 40px;
    margin-left: 40px; /* Added margin to the left */
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
    border: none;
    cursor: pointer;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 155px; 
    margin: -5px 0 0 670px;
  }

  .dropdown-button i {
    font-size: 20px;
    margin-left: 5px;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 50px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 5px;
    margin: 0 0 0 670px;
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

  .large-box-header {
    display: flex;
    justify-content: space-between;
    width: 100%;
    font-size: 20px;
    font-weight: bold;
    padding: 10px 0;
    border-bottom: 1px solid #e0e0e0; 
    color: #31511E;
  }

  .large-box-content {
    display: flex;
    justify-content: space-between;
    width: 100%;
    font-size: 18px;
    padding: 10px 0;
    color: #31511E;
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

    <div class="dashboard-box small-box" style="display: flex; flex-direction: column; align-items: center;">
      <div class="small-box-title">
        Total Orders
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
  </div>

  <div class="dropdown">
    <button class="dropdown-button" onclick="toggleDropdown()">
      Select
      <i class='bx bx-chevron-down'></i>
    </button>
    <div class="dropdown-content" id="dropdownContent">
      <a href="#">New Orders</a>
      <a href="#">Pending Orders</a>
      <a href="#">Complete Orders</a>
      <a href="#">Total Orders</a>
    </div>
  </div>
</div>
<div class="large-box-container">
  <div class="dashboard-box large-box">
    <div class="large-box-header">
      <span>Product</span>
      <span>Size</span>
      <span>Fabric</span>
      <span>Quality</span>
    </div>
    <div class="large-box-content">
      <span>Jersey</span>
      <span>Small</span>
      <span>Cotton</span>
      <span>200</span>
    </div>
    <div class="large-box-content">
      <span>Shirt</span>
      <span>Medium</span>
      <span>Wool</span>
      <span>300</span>
    </div>
    <!-- Add more content here if needed -->
  </div>
</div>

<script>
  function toggleDropdown() {
    const dropdownContent = document.getElementById('dropdownContent');
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
</script>