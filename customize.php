
<?php
include 'includes/header-customer.php';
include 'includes/sidebar-customer.php'; // Add this line to include the sidebar
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css" />
  <title>Customization</title>
  <style>
   
  
    #container3D {
      width: 100%;
      height: calc(100vh - 70px); 
      background-color: transparent; /* Remove background color */
    }
  </style>
</head>
<body>
  <div id="header"><?php include 'includes/header-customer.php'; ?></div>
  <div class="content">
    <main>
      <div id="container3D"></div>
      <div class="controls">
        
      </div>
    </main>
  </div>
  <script type="module" src="js/main.js"></script>
  <script>
         // Function to increment quantity
         function incrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }

        // Function to decrement quantity
        function decrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }

        // Function to toggle modal display
        function toggleModal() {
            const modal = document.getElementById('paymentModal');
            modal.style.display = modal.style.display === 'none' ? 'flex' : 'none';
        }

        // Function to toggle dropdown display
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        }

        // Function to select payment method
        function selectPaymentMethod(method) {
            selectedMethod = method;
            const items = document.querySelectorAll('.dropdown-item');
            items.forEach(item => {
                item.querySelector('.checkmark').style.display = 'none';
            });
            event.target.querySelector('.checkmark').style.display = 'inline';
        }

        // Function to confirm payment method
        function confirmPaymentMethod() {
            const selectedPaymentMethodDiv = document.getElementById('selectedPaymentMethod');
            selectedPaymentMethodDiv.innerHTML = `${selectedMethod} <span class="checkmark-circle"></span>`;
            toggleModal();
        }

        let selectedMethod = '';

        // Ensure the close button is functional
        document.querySelector('.close-btn').addEventListener('click', function() {
            toggleModal();
        });

        function closeOrderContainer() {
            const orderContainer = document.querySelector('.order-container');
            orderContainer.style.display = 'none';
        }
        
        function toggleOrderContainer() {
            const orderContainer = document.querySelector('.order-container');
            const toggleButton = document.querySelector('.order-toggle-btn');
            if (orderContainer.style.display === 'none' || orderContainer.style.display === '') {
                orderContainer.style.display = 'flex';
                toggleButton.textContent = 'Close';
            } else {
                orderContainer.style.display = 'none';
                toggleButton.textContent = 'Open';
            }
        }
        function togglePaymentForm() {
            const paymentForm = document.getElementById('paymentForm');
            paymentForm.style.display = paymentForm.style.display === 'none' ? 'flex' : 'none';
        }

        // Add event listener to confirm payment method button
        document.getElementById('confirmPaymentButton').addEventListener('click', confirmPaymentMethod);
  </script>
</body>
</html>
