<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "apparel");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get order details
$sql = "SELECT id, product, quantity, bust, waist, shoulder, order_date FROM orderx"; 
$result = $conn->query($sql);

// Query to get confirmed orders
$confirmedOrdersSql = "SELECT id, product, quantity, bust, waist, shoulder FROM orderx WHERE status = 'Completed'";
$confirmedOrdersResult = $conn->query($confirmedOrdersSql);

// Check for errors in the queries
if ($result === false) {
    die("Error fetching orders: " . $conn->error);
}

if ($confirmedOrdersResult === false) {
    die("Error fetching confirmed orders: " . $conn->error);
}
?>

<style>
    * {
      font-family: "Poppins", sans-serif;
      font-weight: 600;
      font-style: normal;
    }

.container {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 20px;
}

.dashboard {
  display: grid;
  grid-template-columns: 1fr 2fr;
  gap: 20px;
  width: 90%;
  max-width: 1200px;
}

/* Left Section (New Orders) */
.new-orders {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  margin-top: 200px;
  cursor: pointer;
  
}
/* General styles for the order item */
.new-orders .order-list .order-item {
  display: flex;
  justify-content: space-between;
  padding: 10px;
  transition: background-color 0.3s ease;
}

/* Column hover effect */
.new-orders .order-list .order-item span:hover {
  background-color: #f1f1f1;
  cursor: pointer;
  padding: 10px;
}

/* Optional: make sure the header looks distinct */
.new-orders .order-list .order-item.header {
  font-weight: bold;
  background-color: #f9f9f9;
}

/* Add a subtle transition effect for row hover */
.new-orders .order-list .order-item:hover {
  background-color: #f9f9f9;
}

.confirmed-orders table td:hover,
.confirmed-orders table th:hover {
    background-color: #f1f1f1;  /* Change this color to your preferred hover color */
    cursor: pointer;  /* Optional: changes cursor to indicate interaction */
    transition: background-color 0.3s ease;  /* Smooth transition for the background color change */
}

.order-list .order {
  margin-top: 3px;
  font-weight: bold;
}

.order-item {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  
  margin-top: 5px;
}

/* Right Section (Order Details & Confirmed Orders) */
.order-details {
  display: grid;
  grid-template-columns: 1fr;
  gap: 20px;
}

.order-info-container {
  display: flex;
  flex-direction: row; /* Change to row for side-by-side layout */
  gap: 20px;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  align-items: flex-start;
  height:500px;
}

.order-info {
  padding: 5px;
  flex: 1;
  border: 1px solid #ddd;
  border-radius: 8px;
  width: 300px; /* Adjust width to fit content */
  margin: 5px;
  display: flex;
  flex-direction: column;
  gap: 10px; /* Space between each label and value */
  background-color: #eaeaea;

}

.order-info p {
  display: flex;
  justify-content: space-between; 
  padding: -15px;
  margin: 5px 20px 5px 20px;
  
}

.order-image {
  flex: 1;
  background-color: #eaeaea;
  height: 300px; /* Adjust height as needed */
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 10px;
  padding-bottom: 20px;
  height: 300px;
}

.order-image p {
  margin: 0;
  
}

/* Order actions buttons style */


.order-actions button {
  padding: 10px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  width: 250px;
  margin-left: 25px;
  margin-bottom:20px;
  margin-right: 25px;
  
}

.accept {
  background-color: #6DA067; 
  color: black;
}

.accept:hover {
  background-color: #4CAF50;
  transition: 0.3s;
}

.decline {
  background-color: #6DA067;
  color: black;
  margin-bottom:5px;
}

.decline:hover {
  background-color: #4CAF50;
  transition: 0.3s;
}
.confirmed-orders {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  margin-top: 20px;
  width: 1200px;
  margin-left: 420px;
}


.confirmed-orders table {
  width: 100%;
  border-collapse: collapse;
}

.confirmed-orders th, .confirmed-orders td {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  text-align: left;
}

.confirmed-orders th {
  background-color: #f9f9f9;
}
</style>

<div class="container">
  <div class="dashboard">
    <div class="new-orders">
      <div class="order-list"></div>
        <div class="order-item header">
          <span class="order">Product</span>
          <span class="order">ID</span>
          <span class="order">Quantity</span>
        </div>
        
        <?php
        // Loop through the results and display each product's details
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='order-item' onclick='displayOrderDetails(" . $row['id'] . ")'>";
                echo "<span class='product'>" . $row['product'] . "</span>";
                echo "<span class='order-id'>" . $row['id'] . "</span>"; // Ensure ID is visible
                echo "<span class='quantity'>" . $row['quantity'] . "</span>";
                echo "<span class='bust' style='display:none;'>" . $row['bust'] . "</span>";
                echo "<span class='waist' style='display:none;'>" . $row['waist'] . "</span>";
                echo "<span class='shoulder' style='display:none;'>" . $row['shoulder'] . "</span>";
                echo "<span class='order-date' style='display:none;'>" . $row['order_date'] . "</span>";
                echo "</div>";
            }
        } else {
            echo "<div class='order-item'><span>No products found</span></div>";
        }
        ?>
      </div>
    </div>
  </div>
</div>

<?php
// Close the database connection
$conn->close();
?>
<!-- Order Details Section -->
<div class="order-details">
  <div class="order-info-container">
    <div class="order-info">
      <p><strong>Order ID:</strong><span id="orderId"></span></p>
      <p><strong>Product:</strong><span id="orderProduct"></span></p>
      <p><strong>Quantity:</strong><span id="orderQuantity"></span></p>
      <p><strong>Bust:</strong><span id="orderBust"></span></p>
      <p><strong>Waist:</strong><span id="orderWaist"></span></p>
      <p><strong>Shoulder:</strong><span id="orderShoulder"></span></p>
      <p><strong>Date:</strong><span id="orderDate"></span></p>
      <div class="order-actions">
        <button class="accept" onclick="updateOrderStatus('accept', order)">Accept Order</button>
        <br>
        <button class="decline" onclick="updateOrderStatus('decline', order.id)">Decline Order</button>
      </div>
    </div>
  </div>
</div>

<!-- Confirmed Orders Section -->

<div class="confirmed-orders">
  <h2>Confirmed Orders</h2>
  <table>
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Bust</th>
        <th>Waist</th>
        <th>Shoulder</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($confirmedOrdersResult && $confirmedOrdersResult->num_rows > 0): ?>
        <?php while ($row = $confirmedOrdersResult->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['product']); ?></td>
            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
            <td><?php echo htmlspecialchars($row['bust']); ?></td>
            <td><?php echo htmlspecialchars($row['waist']); ?></td>
            <td><?php echo htmlspecialchars($row['shoulder']); ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="6">No confirmed orders found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<script>
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


