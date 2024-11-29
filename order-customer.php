<?php 
$conn = mysqli_connect('localhost', 'root', '','apparel');
if (!$conn) {
    die('Could not connect: ' . mysqli_connect_error());
}

$sql = "SELECT id, product, bust, waist, shoulder, fabric, amount, quantity, total, status, delivery_status, 
        DATE_FORMAT(order_date, '%d/%m/%Y') as order_date, 
        DATE_FORMAT(delivery_date, '%d/%m/%Y') as delivery_date 
        FROM orderx";
$result = $conn->query($sql);

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
  .close-btn {
    background-color: #f44336;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    margin: 10px;
  }
  .close-btn:hover {
    background-color: #d32f2f;
  }
  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
  }
  .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    border-radius: 10px;
    position: relative;
  }
  .close-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
  }
  .close-icon:hover,
  .close-icon:focus {
    color: black;
    text-decoration: none;
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
      <?php while($order = $result->fetch_assoc()): ?>
      <tr onclick="loadOrderStatus(event, <?php echo $order['id']; ?>)">
        <td class="product-info">
          <input type="checkbox" onclick="checkboxClick(event)"> <!-- Prevent row click if checkbox is clicked -->
          <img src="pimages/gray.jpg" alt="T-shirt Small">
          <span><?php echo $order['product'] . ' - ' . $order['bust'] . ' - ' . $order['waist'] . ' - ' . $order['shoulder'] ?></span>
        </td>
        <td> &#8369;200</td>
        <td><?php echo $order['quantity'] ?></td>
        <td><?php echo '₱' . $order['amount']; ?></td>

        <td><?php echo $order['status'] ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

<div id="order-status-modal" class="modal">
  <div class="modal-content">
    <span class="close-icon" onclick="closeOrderStatus()">&times;</span>
    <div id="order-status-content">
      <!-- order-status content will load here dynamically -->
    </div>
  </div>
</div>

<script>
// Function that loads the order status only if the row is clicked (not the checkbox)
function loadOrderStatus(event, orderId) {
  // If the click event was triggered by the checkbox, return early
  if (event.target.type === 'checkbox') {
    return;
  }

  // Show the modal
  const modal = document.getElementById("order-status-modal");
  modal.style.display = "block";

  // Fetch and load order-status.php content
  fetch('order-status.php?order_id=' + orderId)
    .then(response => response.text())
    .then(data => {
      document.getElementById("order-status-content").innerHTML = data;
    })
    .catch(error => console.error('Error loading order-status.php:', error));
}

// Function to stop the click event from bubbling when the checkbox is clicked
function checkboxClick(event) {
  event.stopPropagation(); // Prevent the click event on the checkbox from triggering row click
}

function closeOrderStatus() {
  // Hide the modal
  const modal = document.getElementById("order-status-modal");
  modal.style.display = "none";
}

// Close the modal if the user clicks outside of it
window.onclick = function(event) {
  const modal = document.getElementById("order-status-modal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
