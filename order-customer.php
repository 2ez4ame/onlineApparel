<?php 
include 'databaseconnection.php';
?>
<link rel="shortcut icon" href="icons/logo.png" type="image/x-icon">
<title>Order Placed</title>

<style>
  table {
    width: 90%;
    margin: 20px auto;
    background-color: #fff;
    border-collapse: collapse;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }
  th, td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    vertical-align: middle;
  }
  th {
    background-color: #f9f9f9;
    font-weight: bold;
    text-align: center;
  }
  th.product-header {
    text-align: left;
    padding-left: 10px;
  }
  td {
    text-align: center;
  }
  .product-info {
    display: flex;
    align-items: center;
    padding-left: 10px;
  }
  .product-info input[type="checkbox"] {
    margin-right: 12px;
    cursor: pointer;
  }
  .product-info img {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    margin-right: 10px;
    object-fit: cover;
  }
  .footer-row td {
    font-weight: bold;
  }
  .align-left {
    text-align: left;
  }
  .footer-actions {
    display: flex;
    align-items: center;
  }
  .footer-actions span {
    margin-left: 10px;
    color: black;
  }
  .separator {
    margin: 0 5px;
    color: #888;
  }
  .cancel {
    text-decoration: none;
    color: black;
  }
  .cancel:hover {
    color: gray;
  }
  .hidden {
    display: none;
  }
  /* Add cursor pointer for clickable rows */
  tbody tr {
    cursor: pointer;
  }
</style>

<div id="order-customer-table">
  <table>
    <thead>
      <tr>
        <th class="product-header">Product</th>
        <th>Unit Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr onclick="loadOrderStatus(event)">
        <td class="product-info">
          <input type="checkbox" onclick="checkboxClick(event)"> <!-- Prevent row click if checkbox is clicked -->
          <img src="pimages/gray.jpg" alt="T-shirt Small">
          <span>T-shirt Small</span>
        </td>
        <td>P 100</td>
        <td>2</td>
        <td>200</td>
        <td>Pending</td>
      </tr>
    </tbody>
  </table>
</div>

<div id="order-status-content" class="hidden">
  <!-- order-status content will load here dynamically -->
</div>

<script>
// Function that loads the order status only if the row is clicked (not the checkbox)
function loadOrderStatus(event) {
  // If the click event was triggered by the checkbox, return early
  if (event.target.type === 'checkbox') {
    return;
  }

  // Hide the order-customer table
  document.getElementById("order-customer-table").classList.add("hidden");

  // Show the order-status content area
  const orderStatusContent = document.getElementById("order-status-content");
  orderStatusContent.classList.remove("hidden");

  // Fetch and load order-status.php content
  fetch('order-status.php')
    .then(response => response.text())
    .then(data => {
      orderStatusContent.innerHTML = data;
    })
    .catch(error => console.error('Error loading order-status.php:', error));
}

// Function to stop the click event from bubbling when the checkbox is clicked
function checkboxClick(event) {
  event.stopPropagation(); // Prevent the click event on the checkbox from triggering row click
}
</script>
