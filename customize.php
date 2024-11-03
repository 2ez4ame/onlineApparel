<?php
include 'includes/header-customer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" />
  <title>Customization</title>
  <style>
    .content {
      margin-left: 250px; /* Adjust content margin to account for sidebar width */
      margin-top: 70px; /* Adjust content margin to account for header height */
      padding: 20px;
    }
    #container3D {
      width: 100%;
      height: 100vh; /* Full viewport height */
    }
  </style>
</head>
<body>
  <?php include 'includes/sidebar-customer.php'; // Include sidebar ?>
  
  <main>
    <!-- Remove the container3D div as it is now included in the header -->
  </main>
  
  <script type="module" src="js/main.js"></script>
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
