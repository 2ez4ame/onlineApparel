<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customization</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #D9D9D9;
        margin: 0;
    }

    .order-container {
        display: flex;
        background-color: #ffffff;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        padding: 20px;
        width: 1300px;
        height: 600px;
        margin-right: 50px; 
    }

    .form-section {
        flex: 1;
        margin-right: 20px;
    }

    .size-chart-section {
        flex: 1.5;
        border-left: 1px solid #ddd;
        padding-left: 20px;
    }

    h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 15px;
    }

    .form-group label {
        font-size: 14px;
        color: #666;
        margin-bottom: 4px;
    }

    .form-group input,
    .form-group select {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        background-color: #f5f5f5;
        cursor: pointer;
    }

    .quantity-input {
        display: flex;
        align-items: center;
    }

    .quantity-input input {
        width: 60px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 8px;
        margin: 0 5px;
        -moz-appearance: textfield; /* Remove spinner controls in Firefox */
    }

    .quantity-input input::-webkit-outer-spin-button,
    .quantity-input input::-webkit-inner-spin-button {
        -webkit-appearance: none; /* Remove spinner controls in Chrome, Safari, Edge, and Opera */
        margin: 0;
    }

    .quantity-input button {
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
        border-radius: 5px;
        margin: 0 5px;
    }

    .quantity-input button:hover {
        background-color: #45a049;
    }

    .size-inputs {
        display: flex;
        gap: 10px;
    }

    .size-inputs input {
        flex: 1;
    }

    .place-order-btn {
        padding: 12px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .place-order-btn:hover {
        background-color: #45a049;
    }

    .size-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .size-table th,
    .size-table td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: center;
        font-size: 14px;
    }

    .size-table th {
        background-color: #f5f5f5;
        font-weight: bold;
    }

    /* Styles for payment method section */
    .payment-method {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
        margin-bottom: 9px;
        font-weight: bold;
    }

    .payment-method-header {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .payment-method-header label {
        font-size: 16px;
        color: #333;
        margin-right: 10px;
    }

    .payment-arrow {
        font-size: 16px;
        cursor: pointer;
        margin-left: 5px;
    }

    /* Modal background */
    .modal-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none; /* Hidden by default */
        justify-content: center;
        align-items: center;
    }

    /* Modal container */
    .modal-container {
        background-color: #fff;
        border-radius: 8px;
        width: 350px;
        padding: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        position: relative;
    }

    /* Modal header */
    .modal-header {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Close button */
    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    /* Payment option */
    .payment-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        border-top: 1px solid #ddd;
        font-size: 16px;
        cursor: pointer;
    }

    .payment-option i {
        font-size: 20px;
        color: #555;
        margin-right: 10px;
    }

    .dropdown-content {
        display: none;
        flex-direction: column;
        margin-top: 10px;
    }

    .dropdown-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-top: 1px solid #ddd;
        cursor: pointer;
    }

    .dropdown-item:hover {
        background-color: #f5f5f5;
    }

    .checkmark {
        display: none;
        color: green;
        font-weight: bold;
    }

    .confirm-btn {
        width: 100%;
        padding: 10px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
    }

    .confirm-btn:hover {
        background-color: #45a049;
    }

    /* Checkmark circle */
    .checkmark-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 20px;
        height: 20px;
        border: 2px solid green;
        border-radius: 50%;
        margin-left: 10px;
    }

    .checkmark-circle::after {
        content: '✔';
        font-size: 14px;
        color: green;
    }
  </style>
</head>
<body>
    <div class="order-container">
        <!-- Form Section on the Left -->
        <div class="form-section">
            <h2>Order</h2>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <div class="quantity-input">
                    <button type="button" onclick="decrementQuantity()">-</button>
                    <input type="number" id="quantity" value="1" min="1"> <!-- Input for quantity -->
                    <button type="button" onclick="incrementQuantity()">+</button>
                </div>
            </div>

            <div class="form-group">
                <label>Size</label>
                <div class="size-inputs">
                    <input type="text" placeholder="Bust">
                    <input type="text" placeholder="Waist">
                    <input type="text" placeholder="Shoulder">
                </div>
            </div>

            <div class="form-group">
                <label for="fabric">Fabric</label>
                <select id="fabric">
                    <option value="cotton">Cotton</option>
                    <option value="polyester">Polyester</option>
                    <option value="linen">Linen</option>
                </select>
            </div>

            <div class="form-group">
                <label for="total">Total</label>
                <input type="text" id="total" placeholder="Total amount" readonly>
            </div>

            <!-- Payment Method Section -->
            <div class="payment-method">
                <div class="payment-method-header" onclick="toggleModal()" style="cursor: pointer;">
                    <label>Payment Method</label>
                    <span>View All <i class="fas fa-chevron-right payment-arrow"></i></span>
                </div>
                <div id="selectedPaymentMethod" style="margin-top: 10px;"></div>
            </div>

            <button class="place-order-btn">Place Order</button>

            <!-- Payment Method Modal -->
            <div id="paymentModal" class="modal-background" style="display: none;">
                <div class="modal-container">
                    <button class="close-btn" onclick="toggleModal()">&times;</button>
                    <div class="modal-header">Select Payment Method</div>
                    <div class="payment-option" onclick="toggleDropdown('creditCardDropdown')">
                        <i class="fas fa-credit-card"></i> Credit Card/Debit Card <i class="fas fa-chevron-down payment-arrow"></i>
                    </div>
                    <div id="creditCardDropdown" class="dropdown-content" style="display: none;">
                        <div class="dropdown-item" onclick="selectPaymentMethod('Visa')">Visa <span class="checkmark">✔</span></div>
                        <div class="dropdown-item" onclick="selectPaymentMethod('MasterCard')">MasterCard <span class="checkmark">✔</span></div>
                        <div class="dropdown-item" onclick="selectPaymentMethod('American Express')">American Express <span class="checkmark">✔</span></div>
                    </div>
                    <div class="payment-option" onclick="toggleDropdown('ewalletDropdown')">
                        <i class="fas fa-wallet"></i> E-Wallet <i class="fas fa-chevron-down payment-arrow"></i>
                    </div>
                    <div id="ewalletDropdown" class="dropdown-content" style="display: none;">
                        <div class="dropdown-item" onclick="selectPaymentMethod('PayPal')">PayPal <span class="checkmark">✔</span></div>
                        <div class="dropdown-item" onclick="selectPaymentMethod('Google Pay')">Google Pay <span class="checkmark">✔</span></div>
                        <div class="dropdown-item" onclick="selectPaymentMethod('Apple Pay')">Apple Pay <span class="checkmark">✔</span></div>
                    </div>
                    <div class="payment-option" onclick="toggleDropdown('overCounterDropdown')">
                        <i class="fas fa-store"></i> Over the Counter <i class="fas fa-chevron-down payment-arrow"></i>
                    </div>
                    <div id="overCounterDropdown" class="dropdown-content" style="display: none;">
                        <div class="dropdown-item" onclick="selectPaymentMethod('7-Eleven')">7-Eleven <span class="checkmark">✔</span></div>
                        <div class="dropdown-item" onclick="selectPaymentMethod('CVS')">CVS <span class="checkmark">✔</span></div>
                        <div class="dropdown-item" onclick="selectPaymentMethod('Walmart')">Walmart <span class="checkmark">✔</span></div>
                    </div>
                    <div class="payment-option" onclick="toggleDropdown('bankTransferDropdown')">
                        <i class="fas fa-university"></i> Bank Transfer <i class="fas fa-chevron-down payment-arrow"></i>
                    </div>
                    <div id="bankTransferDropdown" class="dropdown-content" style="display: none;">
                        <div class="dropdown-item" onclick="selectPaymentMethod('Bank of America')">Bank of America <span class="checkmark">✔</span></div>
                        <div class="dropdown-item" onclick="selectPaymentMethod('Chase')">Chase <span class="checkmark">✔</span></div>
                        <div class="dropdown-item" onclick="selectPaymentMethod('Wells Fargo')">Wells Fargo <span class="checkmark">✔</span></div>
                    </div>
                    <button class="confirm-btn" onclick="confirmPaymentMethod()">Confirm</button>
                </div>
            </div>
        </div>

        <!-- Size Chart Section on the Right -->
        <div class="size-chart-section">
            <h2>Sizes</h2>
            <table class="size-table">
                <tr>
                    <th>Size</th>
                    <th>Bust (in)</th>
                    <th>Waist (in)</th>
                    <th>Shoulder (in)</th>
                </tr>
                <tr>
                    <td>XS</td>
                    <td>30-32</td>
                    <td>23-25</td>
                    <td>14-15</td>
                </tr>
                <tr>
                    <td>S</td>
                    <td>32-34</td>
                    <td>25-27</td>
                    <td>15-16</td>
                </tr>
                <tr>
                    <td>M</td>
                    <td>34-36</td>
                    <td>27-29</td>
                    <td>16-17</td>
                </tr>
                <tr>
                    <td>L</td>
                    <td>36-38</td>
                    <td>29-31</td>
                    <td>17-18</td>
                </tr>
                <tr>
                    <td>XL</td>
                    <td>38-40</td>
                    <td>31-33</td>
                    <td>18-19</td>
                </tr>
            </table>
        </div>
    </div>

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
    </script>
</body>
</html>