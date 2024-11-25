<?php
$conn = new mysqli("localhost", "root", "", "apparel");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' parameter is provided
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']); // Sanitize input

    // Prepare the SQL statement to fetch order details by ID
    $stmt = $conn->prepare("SELECT * FROM orderx WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the order details
        $order = $result->fetch_assoc();
        echo json_encode($order);
    } else {
        echo json_encode(["error" => "Order not found"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "ID parameter is missing"]);
}

$conn->close();
?>
