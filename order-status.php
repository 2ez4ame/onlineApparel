<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'apparel');
if (!$conn) {
    die('Could not connect: ' . mysqli_connect_error());
}

// Check if the request i   s an AJAX request
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

// Debugging: Log whether the request is AJAX or not
error_log("Is AJAX request: " . ($isAjax ? "Yes" : "No"));

// Include header only if it's not an AJAX request
if (!$isAjax) {
    include('includes/header.php');
}

// Fetch order details
$orderId = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0; // Ensure 'order_id' is used
error_log("Order ID: " . $orderId); // Debugging: Log the order ID

if ($orderId > 0) {
    $sql = "SELECT product, bust, waist, shoulder, fabric, amount, quantity, total, delivery_status, 
            DATE_FORMAT(order_date, '%d/%m/%Y') as order_date, 
            DATE_FORMAT(delivery_date, '%d/%m/%Y') as delivery_date 
            FROM orderx WHERE id = $orderId";
    
    error_log("SQL Query: " . $sql); // Debugging: Log the SQL query
    
    $result = $conn->query($sql);
    
    if (!$result) {
        error_log("Database Error: " . $conn->error); // Log database errors
    }

    if ($result && $result->num_rows > 0) {
        $order = $result->fetch_assoc();
        error_log("Order found: " . print_r($order, true)); // Debugging: Log the order details
    } else {
        error_log("No order found for ID: " . $orderId); // Debugging: Log if no order is found
        $order = null;
    }
} else {
    error_log("Invalid order ID: " . $orderId); // Debugging: Log if the order ID is invalid
    $order = null;
}

// Define status timeline
$statuses = [
    'Order Placed' => $order['order_date'] ?? 'N/A',
    'Processing' => $order['order_date'] ?? 'N/A',
    'Ready for Pickup' => $order['delivery_date'] ?? 'N/A',
    'Shipped' => $order['delivery_date'] ?? 'N/A',
    'Out for Delivery' => $order['delivery_date'] ?? 'N/A',
    'Delivered' => $order['delivery_date'] ?? 'N/A'
];
?>


<style>
    .order-container {
        width: 800px;
        max-width: 800px;
        background-color: #fff;
        border-radius: 10px;
        height: 600px;
        padding: 30px;
        display: flex;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border: 1px solid #ccc;
        margin-top: -190px;
        margin-left: -100px;
        
        
    }
    .image-container {
        width: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-right: 30px;
    }
    .image-container img {
        width: 100%;
        max-width: 450px;
        border-radius: 8px;
        border: 1px solid #ccc;
        
    }
    .separator {
        width: 2px;
        background-color: black;
        margin: 0 30px;
    }
    .details-container {
        width: 50%;
        display: flex;
        flex-direction: column;
    }
    .details-container h2 {
        font-size: 2.0em;
        margin-bottom: 10px;
    }
    .details-container p {
        margin: 8px 0;
        color: #555;
        font-size: 1.1em;
    }
    .status-container {
        margin-top: 25px;
        padding-top: 15px;
    }
    .status-item {
        display: flex;
        align-items: center;
        margin: 12px 0;
        position: relative;
    }
    .status-dot {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background-color: #8bc34a; /* Green for completed */
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
        font-weight: bold;
    }
    .status-item.inactive .status-dot {
        background-color: #ccc; /* Gray for inactive */
    }
    .status-item.current .status-dot::before {
        content: "✓"; /* Check mark for current status */
    }
    .status-item span {
        font-size: 1.1em;
        color: #555;
        margin-left: 20px;
    }
    .status-line {
        position: absolute;
        width: 3px;
        background-color: #ccc;
        top: 18px;
        bottom: -10px;
        left: 7px;
        z-index: 0;
    }
    .button-container {
        margin-top: 40px;
        display: flex;
        justify-content: flex-start;
    }
    .button-container button {
        background-color: #8bc34a;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 12px 25px;
        cursor: pointer;
        font-size: 1.1em;
    }
    .button-container button:hover {
        background-color: #7cb342;
    }
</style>

<div class="order-container">
    <?php if ($order): ?>
    <div class="image-container">
        <img src="pimages/gray.jpg" alt="T-shirt">
    </div>

    <div class="separator"></div>

    <div class="details-container">
        <!-- Display product name and size -->
        <h2><?php echo ($order['product'] ?? 'N/A') . ' - ' . ($order['bust'] ?? 'N/A') . '-' . ($order['waist'] ?? 'N/A') . '-' . ($order['shoulder'] ?? 'N/A'); ?></h2>
        <p>Fabric: <?php echo $order['fabric'] ?? 'N/A'; ?></p>
        <p>Quantity: <?php echo $order['quantity'] ?? 'N/A'; ?> pcs</p>
        <p>Total: ₱<?php echo $order['amount'] ?? 'N/A'; ?></p>

        <!-- Status container -->
        <div class="status-container">
            <?php foreach ($statuses as $status => $date): ?>
                <div class="status-item <?php echo ($order['delivery_status'] == $status) ? 'current' : (($date !== 'N/A') ? '' : 'inactive'); ?>">
                    <div class="status-dot"></div>
                    <span><?php echo $date; ?> - <?php echo $status; ?></span>
                    <?php if ($status !== 'Delivered'): ?>
                        <div class="status-line"></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="button-container">
            <button onclick="toTheCustomize();">Buy Again</button>
        </div>
    </div>
    <?php else: ?>
    <div class="details-container">
        <h2>Order not found.</h2>
    </div>
    <?php endif; ?>
</div>

<script>
    function toTheCustomize(){
        window.location.href = "userhome.php";
    }
    function toggleVisibility(elementId, show) {
    const element = document.getElementById(elementId);
    if (element) {
        element.style.display = show ? 'block' : 'none';
    }
}

// Example usage:
toggleVisibility('order-customer-table', false); // Hide
toggleVisibility('order-status-content', true); // Show

</script>