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
$stmt = $conn->prepare("UPDATE orderx SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $order_id);
if ($stmt->execute()) {
    echo json_encode(['success' => true, 'order' => ['id' => $order_id, 'status' => $status]]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}
$stmt->close();

?>

<script>
function displayOrderDetails(orderId) {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Set up the request to fetch the order details
    xhr.open('GET', 'fetch_order_details.php?id=' + orderId, true);

    // Define the callback function for when the request completes
    xhr.onload = function () {
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
            acceptButton.onclick = function () {
                // Send AJAX request to update the order status
                var xhrUpdate = new XMLHttpRequest();
                xhrUpdate.open(
                    'GET',
                    'update_order_status.php?id=' + orderId + '&status=Completed',
                    true
                );

                xhrUpdate.onload = function () {
                    if (xhrUpdate.status === 200) {
                        alert('Order Completed successfully!');
                        // Add the order to the confirmed orders table
                        addToConfirmedOrders(order);
                    } else {
                        alert('Failed to update the order status.');
                    }
                };

                xhrUpdate.send();
            };
        } else {
            alert('Failed to load order details.');
        }
    };

    // Send the request to fetch order details
    xhr.send();
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

    // Optionally, remove the order from the pending list if needed
    var pendingRow = document.querySelector(`#order-row-${order.id}`);
    if (pendingRow) {
        pendingRow.remove();
    }
}
</script>


</script>