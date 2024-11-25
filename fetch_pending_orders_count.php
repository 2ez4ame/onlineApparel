
<?php
$conn = new mysqli("localhost", "root", "", "apparel");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pendingOrdersSql = "SELECT COUNT(*) as pending_orders FROM orderx WHERE status = 'Pending'";
$pendingOrdersResult = $conn->query($pendingOrdersSql);
$pendingOrders = 0;

if ($pendingOrdersResult->num_rows > 0) {
    $row = $pendingOrdersResult->fetch_assoc();
    $pendingOrders = $row['pending_orders'];
}

echo $pendingOrders;

$conn->close();
?>