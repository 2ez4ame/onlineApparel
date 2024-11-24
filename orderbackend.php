<?php
include('databaseconnection.php'); // Ensure this file correctly connects to the database
session_start();

if (isset($_POST['order'])) {
    $amount = floatval($_POST['totalAmount']);
    $quantity = intval($_POST['quantity']);

    // Debugging statements
    error_log("Received order request with amount: $amount and quantity: $quantity");

    // Insert the order details into the database
    $stmt = $conn->prepare("INSERT INTO `orderx` (amount, quantity) VALUES (?, ?)");
    if ($stmt === false) {
        die("Error in SQL preparation: " . $conn->error);
    }

    // Correct parameter types: d (double) for amount, i (integer) for quantity
    $stmt->bind_param("di", $amount, $quantity);

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
            die('Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch));
        }
        curl_close($ch);

        // Decode the JSON response from PayMongo
        $responseData = json_decode($response, true);

        if (isset($responseData['data']['attributes']['checkout_url'])) {
            // Open the PayMongo checkout URL in a new tab using JavaScript
            $checkoutUrl = $responseData['data']['attributes']['checkout_url'];
            echo '<script>
                    window.location.href = "order.php";
                    window.open("' . $checkoutUrl . '", "_blank");  // Open the URL in a new tab
                  </script>';
        } else {
            // If PayMongo did not return a checkout URL, display an error
            echo '<script>
                    alert("Error: Could not generate payment link. Please try again.");
                    window.location.href = "order.php";  
                  </script>';
        }

    } else {
        echo '<script>
                alert("Error: Could not place order. Please try again.");
                window.location.href = "order.php";     
              </script>';
    }

    $stmt->close();
} else {
    echo '<script>
            alert("Invalid request.");
            window.location.href = "order.php";  // Redirect to order page for invalid request
          </script>';
}

$conn->close();
?>