<?php
$conn = mysqli_connect('localhost', 'root', '', 'apparel');
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Fetch pending orders
$sql = "SELECT id, product, quantity, bust, waist, shoulder, status, delivery_status FROM orderx WHERE status = 'Pending'"; 
$result = $conn->query($sql);

// Debugging: Check if any rows are fetched
if ($result->num_rows > 0) {
  echo "<script>console.log('Pending orders fetched successfully');</script>";
} else {
  echo "<script>console.log('No pending orders found');</script>";
}

// Fetch confirmed orders
$confirmedOrdersSql = "SELECT id, product, bust, waist, shoulder, quantity, delivery_status FROM orderx WHERE status != 'Pending'";
$confirmedOrdersResult = $conn->query($confirmedOrdersSql);

// Debugging: Check if any rows are fetched
if ($confirmedOrdersResult->num_rows > 0) {
  echo "<script>console.log('Confirmed orders fetched successfully');</script>";
} else {
  echo "<script>console.log('No confirmed orders found');</script>";
}
?>

<link rel="shortcut icon" href="icons/logo.png" type="image/x-icon">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<style>
    * {
  box-sizing: border-box;
}

.dashboard {
  display: grid;
  grid-template-columns: 1fr 2fr;
  gap: 20px;
  width: 90%;
  max-width: 1200px;
}

.new-orders {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 8px;
  padding: 20px;
  margin-top: 200px;
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
  cursor: pointer; /* Add this line */
}

.order-item:hover {
  background-color: #f0f0f0;
}

.order-details {
  display: grid;
  grid-template-columns: 1fr;
  gap: 20px;
}

.order-info-container {
  display: flex;
  flex-direction: row;
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
  width: 300px;
  margin: 5px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  background-color: #eaeaea;
}

.order-info p {
  display: flex;
  justify-content: space-between; 
  padding: -10px;
  margin: 5px 20px 5px 20px;
}

.order-image {
  flex: 1;
  background-color: #eaeaea;
  height: 300px;
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

.order-actions button {
  padding: 10px;
  font-size: 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  width: 230px;
  margin-left: 25px;
  margin-bottom:20px;
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
  width: 790px;
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

.dropdown-menu{
  width: 230px;
}
</style>

<div class="container">
  <div class="dashboard">
    <div class="new-orders">
      <div class="order-list">
        <div class="order-item">
          <span class="order">Product</span>
          <span class="order">ID</span>
          <span class="order">Quantity</span>
        </div>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='order-item' data-order-id='" . $row['id'] . "' data-product='" . htmlspecialchars($row['product']) . "' data-quantity='" . $row['quantity'] . "' data-bust='" . $row['bust'] . "' data-waist='" . $row['waist'] . "' data-shoulder='" . $row['shoulder'] . "' data-status='" . $row['status'] . "' data-delivery-status='" . $row['delivery_status'] . "' onclick='displayOrderDetails(this)'>";
                echo "<span class='product'>" . htmlspecialchars($row['product']) . "</span>";
                echo "<span class='order-id'>" . $row['id'] . "</span>";
                echo "<span class='quantity'>" . $row['quantity'] . "</span>";
                echo "</div>";
            }
        } else {
            echo "<div class='order-item'><span>No products found</span></div>";
        }
        ?>
      </div>
    </div>

    <div class="order-details">
      <div class="order-info-container">
        <div class="order-info">
          <p><strong>Order ID:</strong><span id="orderId"></span></p>
          <p><strong>Product:</strong><span id="orderProduct"></span></p>
          <p><strong>Quantity:</strong><span id="orderQuantity"></span></p>
          <p><strong>Bust:</strong><span id="orderBust"></span></p>
          <p><strong>Waist:</strong><span id="orderWaist"></span></p>
          <p><strong>Shoulder:</strong><span id="orderShoulder"></span></p>
          <p><strong>Delivery Status:</strong><span id="orderDeliveryStatus"></span></p>
          <div class="order-actions dropdown">
            <div class="d-flex justify-content-center my-3">
              <button class="btn btn-success dropdown-toggle w-99 ml-3" style="font-weight:bold" type="button" id="orderStatusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Update Delivery Status
              </button>
              <ul class="dropdown-menu" aria-labelledby="orderStatusDropdown">
                <li><a class="dropdown-item" href="#">Processing</a></li>
                <li><a class="dropdown-item" href="#">Ready for Pickup</a></li>
                <li><a class="dropdown-item" href="#">Shipped</a></li>
                <li><a class="dropdown-item" href="#">Out for Delivery</a></li>
                <li><a class="dropdown-item" href="#">Delivered</a></li>
                <li><a class="dropdown-item" href="#">Cancelled</a></li>
              </ul>
              <button class="btn btn-success mr-4" style="font-weight:bold;" onclick="submitOrderStatus()">Submit</button>
            </div>
          </div>
        </div>
        <div class="order-image">
          <p>Image Placeholder</p>
        </div>
      </div>
    </div>
  </div>

  <div class="confirmed-orders">
    <h3>Completed Orders</h3>
    <table>
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Product</th>
          <th>Bust</th>
          <th>Waist</th>
          <th>Shoulder</th>  
          <th>Quantity</th>
          <th>Delivery Status</th>
        </tr>
      </thead>
      <tbody id="confirmedOrdersTable">
        <?php
        if ($confirmedOrdersResult->num_rows > 0) {
            while ($row = $confirmedOrdersResult->fetch_assoc()) {
                echo "<tr class='confirmed-order-item' data-order-id='" . $row['id'] . "' data-product='" . htmlspecialchars($row['product']) . "' data-quantity='" . $row['quantity'] . "' data-bust='" . $row['bust'] . "' data-waist='" . $row['waist'] . "' data-shoulder='" . $row['shoulder'] . "' data-delivery-status='" . $row['delivery_status'] . "' onclick='displayOrderDetails(this)'>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . htmlspecialchars($row['product']) . "</td>";
                echo "<td>" . $row['bust'] . "</td>";
                echo "<td>" . $row['waist'] . "</td>";
                echo "<td>" . $row['shoulder'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['delivery_status'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No confirmed orders found</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Bootstrap Modal for Alert -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="alertModalLabel">Updated</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="alertModalBody">
        <!-- Alert message will be inserted here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    const orderDeliveryStatusSpan = document.getElementById('orderDeliveryStatus');

    dropdownItems.forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();
            const selectedStatus = this.textContent;
            orderDeliveryStatusSpan.textContent = selectedStatus;
        });
    });
});

function displayOrderDetails(element) {
    const orderId = element.getAttribute('data-order-id');
    const orderProduct = element.getAttribute('data-product');
    const orderQuantity = element.getAttribute('data-quantity');
    const orderBust = element.getAttribute('data-bust');
    const orderWaist = element.getAttribute('data-waist');
    const orderShoulder = element.getAttribute('data-shoulder');
    const orderDeliveryStatus = element.getAttribute('data-delivery-status');

    // Debug values
    console.log({ orderId, orderProduct, orderQuantity, orderBust, orderWaist, orderShoulder, orderDeliveryStatus });

    // Update the order-info section
    document.getElementById('orderId').innerText = orderId;
    document.getElementById('orderProduct').innerText = orderProduct;
    document.getElementById('orderQuantity').innerText = orderQuantity;
    document.getElementById('orderBust').innerText = orderBust;
    document.getElementById('orderWaist').innerText = orderWaist;
    document.getElementById('orderShoulder').innerText = orderShoulder;
    document.getElementById('orderDeliveryStatus').innerText = orderDeliveryStatus;
}

function submitOrderStatus() {
    const orderId = document.getElementById('orderId').innerText;
    const orderDeliveryStatus = document.getElementById('orderDeliveryStatus').innerText;

    if (orderId && orderDeliveryStatus) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `update_order_status.php?id=${orderId}&delivery_status=${encodeURIComponent(orderDeliveryStatus)}`, true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log(xhr.responseText); // Debug server response
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        showAlertModal('Order status updated successfully!');
                        updateConfirmedOrdersTable(response.order);
                        // Update the delivery status in the DOM
                        document.querySelector(`.order-item[data-order-id='${orderId}']`).setAttribute('data-delivery-status', orderDeliveryStatus);
                        document.querySelector(`.confirmed-order-item[data-order-id='${orderId}'] .delivery-status`).innerText = orderDeliveryStatus;
                    } else {
                        showAlertModal('Failed to update order status: ' + response.error);
                    }
                } catch (e) {
                    console.error('Error parsing JSON response:', e);
                    showAlertModal('Status Updated Successfully');
                }
            } else {
                showAlertModal('Failed to update order status. Please try again.');
            }
        };

        xhr.onerror = function() {
            showAlertModal('Network error. Please check your connection.');
        };

        xhr.send();
    } else {
        showAlertModal('Order ID or delivery status is missing.');
    }
}

function showAlertModal(message) {
    document.getElementById('alertModalBody').innerText = message;
    const alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
    alertModal.show();
}

function updateConfirmedOrdersTable(order) {
    // Check if the order already exists in the confirmed orders table
    let existingRow = document.querySelector(`.confirmed-order-item[data-order-id='${order.id}']`);
    
    if (existingRow) {
        // Update the existing row
        existingRow.querySelector('.delivery-status').innerText = order.delivery_status;
    } else {
        // Add a new row to the confirmed orders table
        const table = document.querySelector('.confirmed-orders tbody');
        const row = document.createElement('tr');
        row.classList.add('confirmed-order-item');
        row.setAttribute('data-order-id', order.id);
        row.setAttribute('data-product', order.product);
        row.setAttribute('data-quantity', order.quantity);
        row.setAttribute('data-bust', order.bust);
        row.setAttribute('data-waist', order.waist);
        row.setAttribute('data-shoulder', order.shoulder);
        row.setAttribute('data-delivery-status', order.delivery_status);
        row.innerHTML = `
            <td>${order.id}</td>
            <td>${order.product}</td>
            <td>${order.bust}</td>
            <td>${order.waist}</td>
            <td>${order.shoulder}</td>
            <td>${order.quantity}</td>
            <td class="delivery-status">${order.delivery_status}</td>
        `;
        table.appendChild(row);

        // Add click event listener to the new row
        row.addEventListener('click', function() {
            displayOrderDetails(row);
        });
    }

    // Remove the order from the pending list
    const pendingRow = document.querySelector(`.order-item[data-order-id='${order.id}']`);
    if (pendingRow) {
        pendingRow.remove();
    }
}

// Add click event listeners to existing confirmed order rows
document.querySelectorAll('.confirmed-order-item').forEach(row => {
    row.addEventListener('click', function() {
        displayOrderDetails(row);
    });
});


</script>