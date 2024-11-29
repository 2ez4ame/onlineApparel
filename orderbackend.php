<?php
include('databaseconnection.php'); // Ensure this file correctly connects to the database
session_start();

// Check if the order is placed
if (isset($_POST['order'])) {
    $product = isset($_POST['product']) ? $_POST['product'] : ''; // Product is now treated as a string
    $bust = isset($_POST['bust']) ? floatval($_POST['bust']) : 0;
    $waist = isset($_POST['waist']) ? floatval($_POST['waist']) : 0;
    $shoulder = isset($_POST['shoulder']) ? floatval($_POST['shoulder']) : 0;
    $fabric = isset($_POST['fabric']) ? $_POST['fabric'] : ''; // Fabric is now treated as a string
    $amount = isset($_POST['totalAmount']) ? floatval($_POST['totalAmount']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    if ($amount <= 0 || $quantity <= 0) {
        echo '<script>
                alert("Invalid amount or quantity.");
                window.location.href = "order.php";     
              </script>';
        exit();
    }

    // Debugging statement
    error_log("Received order request with product:$product, amount: $amount, quantity: $quantity, bust: $bust, waist: $waist, shoulder: $shoulder, fabric: $fabric");

    // Prepare the SQL statement to insert the order into the database
    $stmt = $conn->prepare("INSERT INTO `orderx` (product, amount, quantity, bust, waist, shoulder, fabric, total, status, delivery_status, order_date, delivery_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error in SQL preparation: " . $conn->error);
    }

    // Bind the parameters to prevent SQL injection
    $total = $amount * $quantity; // Calculate the total amount
    $product = 'T-Shirt'; // Hardcoded product name
    $status = 'Pending';
    $delivery_status = 'Processing';
    $order_date = date('Y-m-d H:i:s'); // Current date and time
    $delivery_date = date('Y-m-d H:i:s', strtotime('+3 days')); // Delivery date 3 days from now

    $stmt->bind_param('sdiddssissss', $product, $amount, $quantity, $bust, $waist, $shoulder, $fabric, $total, $status, $delivery_status, $order_date, $delivery_date);

    if ($stmt->execute()) {
        // Generate the PayMongo payment link after the order is placed
        $orderId = $stmt->insert_id;  // Get the inserted order ID
        $description = "T-Shirt";  // Description of the order

        // Prepare PayMongo API request
        $paymongoUrl = "https://api.paymongo.com/v1/links";
        $apiKey = "c2tfdGVzdF9NV3JGMlB2U2FGZng2eHVqQ052elJmaXA6";  // Replace with your actual API key

        $data = [
            "data" => [
                "attributes" => [
                    "amount" => $amount * 100, // Convert to cents (PayMongo accepts amounts in cents)
                    "description" => $description,
                    "remarks" => "Order payment",
                ]
            ]
        ];

        // Initialize cURL session to make the PayMongo API request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $paymongoUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Authorization: Basic ' . $apiKey,
            'Content-Type: application/json'
        ]);

        // Execute cURL request and get the response
        $response = curl_exec($ch);
        if ($response === false) {
            error_log('cURL Error: ' . curl_error($ch));
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);

        // Decode the JSON response from PayMongo
        $responseData = json_decode($response, true);

        // Debugging statement to log the response
        error_log("PayMongo response: " . print_r($responseData, true));

        // Check if PayMongo returned a valid checkout URL
        if (isset($responseData['data']['attributes']['checkout_url'])) {
            $checkoutUrl = $responseData['data']['attributes']['checkout_url'];
            echo '<script>
                    // Open the PayMongo checkout URL in a new tab
                    window.open("' . $checkoutUrl . '", "_blank");
                    
                    // Use setTimeout to delay the redirection to "customize.php" after 1 second
                    setTimeout(function() {
                        window.location.href = "customize.php";  // Redirect to customize.php
                    }, 1000); // 1000ms delay to ensure the new tab opens first
                  </script>';
        } else {
            // If PayMongo did not return a checkout URL, display an error
            error_log("PayMongo API failed: " . print_r($responseData, true));
            echo '<script>
                    alert("Error: Could not generate payment link. Please try again.");
                    window.location.href = "customize.php";  
                  </script>';
        }
    } else {
        // If database insertion fails, show an error
        echo '<script>
                alert("Error: Could not place order. Please try again.");
                window.location.href = "customize.php";     
              </script>';
    }

    // Close the statement
    $stmt->close();
} else {
    // If the order is not placed, show an invalid request alert
    echo '<script>
            alert("Invalid request.");
            window.location.href = "customize.php";  // Redirect to order page for invalid request
          </script>';
}

// Close the database connection
$conn->close();
?>
