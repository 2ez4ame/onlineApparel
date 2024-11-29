<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "apparel");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get order ID and status from the AJAX request
$order_id = $_GET['id'];
$status = $_GET['status']; // 'Completed' or other statuses

// Update the status of the order in the database
$stmt = $conn->prepare("UPDATE orderx SET delivery_status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $order_id);
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'order' => ['id' => $order_id, 'status' => $status]]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}
$stmt->close();
$conn->close();
?>