<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "apparel");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT bust, waist, shoulder, fabric, amount, quantity FROM orderx";
$result = $conn->query($sql);

$totalOrdersSql = "SELECT COUNT(*) as total_orders FROM orderx";
$totalOrdersResult = $conn->query($totalOrdersSql);
$totalOrders = 0;

if ($totalOrdersResult->num_rows > 0) {
    $row = $totalOrdersResult->fetch_assoc();
    $totalOrders = $row['total_orders'];
}

$pendingOrdersSql = "SELECT COUNT(*) as pending_orders FROM orderx WHERE status = 'Pending'";
$pendingOrdersResult = $conn->query($pendingOrdersSql);
$pendingOrders = 0;

if ($pendingOrdersResult->num_rows > 0) {
    $row = $pendingOrdersResult->fetch_assoc();
    $pendingOrders = $row['pending_orders'];
}

$completedOrdersSql = "SELECT COUNT(*) as completed_orders FROM orderx WHERE status = 'Completed'";
$completedOrdersResult = $conn->query($completedOrdersSql);
$completedOrders = 0;

if ($completedOrdersResult->num_rows > 0) {
    $row = $completedOrdersResult->fetch_assoc();
    $completedOrders = $row['completed_orders'];
}

$confirmedOrdersSql = "SELECT id, product, quantity, bust, waist, shoulder FROM orderx WHERE status = 'Completed'";
$confirmedOrdersResult = $conn->query($confirmedOrdersSql);
?>




<link rel="shortcut icon" href="icons/logo.png" type="image/x-icon">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>

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
    width: 1300px;
    height: 300px; 
    position: relative;
    display: flex;
    flex-direction: row;
    margin: -670px 0 0  400px;
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
    border: 1px solid #31511E;
    cursor: pointer;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 155px; 
    margin: -10px 0 -70px 1544px;
  }
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 140px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 5px;
    top: 100%;
    left: 0; 
    margin: 45px 0 0 1544px;
    width: 155px;
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
  .large-box-container {
      width: 1300px;
      position: relative;
      margin: -670px 0 0 400px;
    }

    .large-box-header {
      display: flex;
      justify-content: space-between;
      width: 100%;
      font-size: 20px;
      font-weight: bold;
      padding: 10px 0;
      border-bottom: 1px solid #e0e0e0;
      color: black;
    }

    .large-box-content {
      display: flex;
      justify-content: space-between;
      width: 100%;
      font-size: 18px;
      padding: 6px 0;
      color: #31511E;
    }

    .large-box-content span {
      text-align: justify;
      
      flex-grow: 1;
      flex-basis: 0; 
    }
    .product1{
      margin-left: 50px;
      flex-grow: 1;
      flex-basis: 0;
    }

</style>
<div class="dropdown">
  <button onClick="toggleDropdown()" class="dropdown-button">
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


<div class="dashboard-container">
  <div class="small-box-container">
    <!-- New Orders Box -->
    <a href="#" id="new-orders" class="dashboard-box small-box" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; color: inherit;">
      <div class="small-box-title">
        New Orders
      </div>
      <div class="icon-number-wrapper" style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
        <div class="icon" style="padding-left: 20px; padding-bottom:5px;">
          <i class='bx bx-detail' style="font-size:50px;"></i>
        </div>
        <div class="stat-number" style="text-align: center; flex-grow: 1; margin-left: 40px;">
          <?php echo $totalOrders; ?>
        </div>
        <div class="icons" style="padding-left: -10px; padding-bottom:5px;">
          <i class='bx bx-bar-chart' style="font-size:50px;"></i>
        </div>
      </div>
    </a>

    <!-- Other Boxes (Pending Orders, Completed Orders, Total Orders) -->
    <a href="#" id="pending-orders" class="dashboard-box small-box" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; color: inherit;">
      <div class="small-box-title">
        Pending Orders
      </div>
      <div class="icon-number-wrapper" style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
        <div class="icon" style="padding-left: 20px; padding-bottom:5px;">
          <i class='bx bx-time-five' style="font-size:50px;"></i>
        </div>
        <div class="stat-number" style="text-align: center; flex-grow: 1; margin-left: 40px;">
          <?php echo $pendingOrders; ?>
        </div>
        <div class="icons" style="padding-left: -10px; padding-bottom:5px;">
          <i class='bx bx-bar-chart' style="font-size:50px;"></i>
        </div>
      </div>
    </a>

    <a href="#" id="completed-orders" class="dashboard-box small-box" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; color: inherit;">
      <div class="small-box-title">
        Completed Orders
      </div>
      <div class="icon-number-wrapper" style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
        <div class="icon" style="padding-left: 20px; padding-bottom:5px;">
          <i class='bx bx-check-circle' style="font-size:50px;"></i>
        </div>
        <div class="stat-number" style="text-align: center; flex-grow: 1; margin-left: 40px;">
          <?php echo $completedOrders; ?>
        </div>
        <div class="icons" style="padding-left: -10px; padding-bottom:5px;">
          <i class='bx bx-bar-chart' style="font-size:50px;"></i>
        </div>
      </div>
    </a>

    <a href="#" id="total-orders" class="dashboard-box small-box" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; color: inherit;">
      <div class="small-box-title">
        Total Orders
      </div>
      <div class="icon-number-wrapper" style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
        <div class="icon" style="padding-left: 20px; padding-bottom:5px;">
          <i class='bx bx-time-five' style="font-size:50px;"></i>
        </div>
        <div class="stat-number" style="text-align: center; flex-grow: 1; margin-left: 40px;">
          <?php echo $totalOrders; ?>
        </div>
        <div class="icons" style="padding-left: -10px; padding-bottom:5px;">
          <i class='bx bx-bar-chart' style="font-size:50px;"></i>
        </div>
      </div>
    </a>
  </div>
</div>

<!-- Container to load the dynamic content from admin-accepting.php -->
<div id="admin-accepting-container">
  <!-- admin-accepting.php content will be loaded here -->
</div>


<div class="large-box-container">
  <div class="dashboard-box large-box">
    <div class="large-box-header">
      <span>Product</span>
      <span>Bust</span>
      <span>Waist</span>
      <span>Shoulder</span>
      <span>Fabric</span>
      <span>Quantity</span>
    </div>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="large-box-content">
              <span class="product1">Jersey</span> <!-- Replace with dynamic product name if available -->
              <span class="bust1"><?php echo htmlspecialchars($row['bust']); ?></span>
              <span class="waist1"><?php echo htmlspecialchars($row['waist']); ?></span>
              <span class="shoulder1"><?php echo htmlspecialchars($row['shoulder']); ?></span>
              <span class="fabric1"><?php echo htmlspecialchars($row['fabric']); ?></span>
              <span class="quantity1"><?php echo htmlspecialchars($row['quantity']); ?></span>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="large-box-content">
          <span colspan="6">No orders found.</span>
        </div>
    <?php endif; ?>
  </div>
</div>




<?php $conn->close(); ?>

<script>
function toggleDropdown() {
    const dropdownContent = document.getElementById('dropdownContent');
    const dropdownButton = document.querySelector('.dropdown-button');

    if (dropdownContent.style.display === 'block') {
        dropdownContent.style.display = 'none';
        dropdownButton.style.display = 'block'; // Show the button again when the dropdown is hidden
    } else {
        dropdownContent.style.display = 'block';
        dropdownButton.style.display = 'none'; // Hide the button when the dropdown is shown
    }
}

  document.getElementById('new-orders').addEventListener('click', function(e) {
  e.preventDefault(); // Prevent the default link action
  
  // Hide other sections
  document.getElementById('pending-orders').style.display = 'none';
  document.getElementById('completed-orders').style.display = 'none';
  document.getElementById('total-orders').style.display = 'none';
  document.querySelector('.large-box-container').style.display = 'none';
  document.querySelector('.dropdown-button').style.display = 'none';

  
  // Show the "New Orders" section
  document.getElementById('new-orders').style.display = 'block';

  // Use AJAX to load the admin-accepting.php content into the container
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'admin-accepting.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
      document.getElementById('admin-accepting-container').innerHTML = xhr.responseText;
    }
  };
  xhr.send();
});


</script>