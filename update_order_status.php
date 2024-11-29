<?php
$conn = mysqli_connect('localhost', 'root', '', 'apparel');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$orderId = $_GET['id'];
$deliveryStatus = $_GET['delivery_status'];

// Update order status and delivery status
$sql = "UPDATE orderx SET delivery_status = ?, status = 'Confirmed' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('si', $deliveryStatus, $orderId);
if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'order' => [
            'id' => $orderId,
            'product' => $row['product'], // Fetch from DB if needed
            'bust' => $row['bust'],       // Fetch from DB if needed
            'waist' => $row['waist'],     // Fetch from DB if needed
            'shoulder' => $row['shoulder'], // Fetch from DB if needed
            'quantity' => $row['quantity'], // Fetch from DB if needed
            'delivery_status' => $deliveryStatus
        ]
    ]);
} else {
    echo json_encode(['success' => false, 'error' => 'Failed to update order']);
}
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
            document.getElementById('orderStatus').textContent = order.status;


            // Set up the Accept button click handler
            var acceptButton = document.querySelector('.accept');
            acceptButton.onclick = function () {
                // Send AJAX request to update the order status
                var xhrUpdate = new XMLHttpRequest();
                xhrUpdate.open(
                    'GET',
                    'update_order_status.php?id=' + orderId + '&delivery_status=Completed',
                    true
                );
                xhrUpdate.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhrUpdate.onload = function () {
                    if (xhrUpdate.status === 200) {
                        var response = JSON.parse(xhrUpdate.responseText);
                        if (response.success) {
                            alert('Order Completed successfully!');
                            // Add the order to the confirmed orders table
                            addToConfirmedOrders(response.order);
                        } else {
                            alert('Failed to update the order status: ' + response.error);
                        }
                    } else {
                        alert('Failed to update the order status. Invalid server response.');
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