<?php
$conn = new mysqli("localhost", "root", "", "apparel");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$completedOrdersSql = "SELECT COUNT(*) as completed_orders FROM orderx WHERE status = 'Completed'";
$completedOrdersResult = $conn->query($completedOrdersSql);
$completedOrders = 0;

if ($completedOrdersResult->num_rows > 0) {
    $row = $completedOrdersResult->fetch_assoc();
    $completedOrders = $row['completed_orders'];
}

echo $completedOrders;

$conn->close();
?>