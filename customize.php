<?php
include 'includes/header-customer.php';
include 'includes/sidebar-customer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

  <title>Customization</title>
  <style>
    .content {
      margin-left: 250px; /* Adjust content margin to account for sidebar width */
      margin-top: 70px; /* Adjust content margin to account for header height */
      padding: 20px;
    }
  </style>
</head>
<body>


  <script>
    function incrementQuantity() {
        var quantityInput = document.getElementById('quantity');
        var currentValue = parseInt(quantityInput.value);
        if (!isNaN(currentValue)) {
            quantityInput.value = currentValue + 1;
        }
    }

    function decrementQuantity() {
        var quantityInput = document.getElementById('quantity');
        var currentValue = parseInt(quantityInput.value);
        if (!isNaN(currentValue) && currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    }
    

  </script>
</body>
</html>